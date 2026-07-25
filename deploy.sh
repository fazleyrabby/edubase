#!/bin/bash
set -e

echo "=== Committing and pushing local changes ==="
git add .
git commit -m "Deploy automatic update" || true
git push origin main || true

echo "=== Deploying to homelab VPS ==="
ssh homelab << 'EOF'
  set -e
  mkdir -p ~/apps

  if [ ! -d "/home/fazley/apps/edubase" ]; then
    echo "Cloning repository on VPS..."
    git clone https://github.com/fazleyrabby/edubase.git /home/fazley/apps/edubase
  fi

  cd /home/fazley/apps/edubase

  # Fix permissions so git can update storage/bootstrap-cache files owned by www-data
  if docker ps --format "{{.Names}}" | grep -q edubase_app; then
    echo "Fixing permissions from inside container..."
    docker exec edubase_app sh -c 'chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache' || true
  fi

  echo "Pulling latest changes from main branch..."
  git pull origin main

  # Backup .env for restoring after potential fresh clone
  [ -f .env ] && cp .env .env.backup

  echo "Starting docker services..."
  docker compose -f docker-compose.prod.yml down || true
  docker compose -f docker-compose.prod.yml up -d --build

  echo "Waiting for database to be healthy..."
  for i in $(seq 1 30); do
    if docker exec edubase_mysql mysqladmin ping -u root -p"${DB_ROOT_PASSWORD:-rootpass1234}" --silent 2>/dev/null; then
      break
    fi
    sleep 2
  done

  echo "Running post-deploy tasks inside container..."
  # Use .env.prod template (now included in build image, not excluded by .dockerignore)
  docker exec edubase_app sh -c 'if [ ! -f .env ]; then cp .env.prod .env; fi'

  # If a backup exists on the host, copy it into the container
  if [ -f .env.backup ]; then
    docker cp .env.backup edubase_app:/var/www/html/.env
  fi

  docker exec edubase_app php artisan key:generate --force
  docker exec edubase_app php artisan migrate --force
  docker exec edubase_app php artisan db:seed --class=DatabaseSeeder --force

  echo "Fixing storage permissions..."
  docker exec edubase_app sh -c 'chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache'

  echo "Restarting cloudflared tunnel..."
  sudo systemctl restart cloudflared || true

  echo "=== VPS Deployment Completed Successfully! ==="
EOF
