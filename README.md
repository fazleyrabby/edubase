# EduBase

**National Education Discovery, Comparison & Fee Intelligence Platform**

A modular monolith built with Laravel 13 for discovering, comparing, and analyzing educational institutions across Bangladesh.

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 13, PHP 8.4 |
| Database | MySQL / PostgreSQL |
| Cache / Queue | Redis + Horizon |
| Search | Meilisearch via Laravel Scout |
| Frontend | Blade, Alpine.js, Tailwind CSS v4 |
| Admin UI | Flowbite |
| Storage | S3-compatible (MinIO / AWS S3) |
| Auth | Laravel Sanctum (SPA + API) |

## Module Architecture

```
app/Modules/
├── Institute    — Institute CRUD, profile, aggregation
├── Location     — Geographic hierarchy (country → area)
├── Taxonomy     — Categories, curriculums, boards, programs
├── Fee          — Fee structures, history, calculators
├── Admission    — Admission circulars, sessions
├── Comparison   — Side-by-side institute comparison
├── Search       — Meilisearch indexing, search services
├── Media        — Upload, optimization, S3 storage
├── SEO          — Metadata, sitemaps, redirects
├── Scraper      — Data collection adapters, pipeline
├── Audit        — Activity logging
└── User         — Auth, roles, permissions
```

## Getting Started

```bash
cp .env.example .env
# Configure DB, Redis, Meilisearch in .env

composer install
npm install && npm run build
php artisan key:generate
php artisan migrate --seed

# Start development
composer run dev
```

## Default Admin

- **Email:** admin@edubase.com
- **Password:** password

## Phase 0 — Foundation

- [x] Laravel 13 scaffolding + module structure
- [x] 52 database tables (all migration schemas)
- [x] Bangladesh administrative hierarchy (8 divisions, 64 districts)
- [x] Taxonomies: institute types, categories, curriculums, boards, programs
- [x] RBAC: 6 roles, 47 permissions (Spatie)
- [x] Admin authentication (Sanctum SPA)
- [x] Horizon queue supervisors (7 queues)
- [x] Meilisearch/Scout integration
- [x] Tailwind v4 + Flowbite admin UI

## License

MIT
