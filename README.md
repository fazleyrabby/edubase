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

## Project Roadmap & Status

- **Phase 0 — Foundation** ✅ COMPLETE (Scaffolding, geographic seeders, taxonomies, RBAC)
- **Phase 1 — Core Models & Admin Panel** ✅ COMPLETE (Institute, contacts, shifts management screens)
- **Phase 2 — Admissions & Fees** ✅ COMPLETE (Fee types, fee structures, application deadlines, circulars dashboards)
- **Phase 3 — Scrapers & Pipeline** ✅ COMPLETE (Scraper adapters, run logs, CSV/JSON parser engine)
- **Phase 4 — Fee & Admission Moderation** ✅ COMPLETE (Approval pipelines, verified status, moderator actions)
- **Phase 5 — Public Front-end Listing** ✅ COMPLETE (Faceted search, side-by-side comparison tray, location landing pages)
- **Phase 6 — Public API & Security** ✅ COMPLETE (19 API endpoints, rate limiting, SecurityHeaders CSP Nonces, Redis caching)
- **Phase 7 — SEO Metadata Engine** ✅ COMPLETE (Dynamic meta tags mapping, XML sitemaps cron generator)
- **Phase 8 — User Accounts** ✅ COMPLETE (Profiles dashboard, favorites bookmarks, email watchlists)
- **Phase 9 — Reviews & Community** ✅ COMPLETE (Star ratings, review moderation, community fee submissions)
- **Phase 10 — School Portal** ✅ COMPLETE (Ownership claiming, manager editing portal, traffic analytics dashboard)

## Cron / Scheduled Commands

Set the standard system cron to run Laravel schedule (`php artisan schedule:run`) every minute. The following commands are registered:

- **Generate Public XML Sitemaps**: Runs daily at 4:00 AM (`php artisan seo:generate-sitemaps`).
- **Optimize SEO Metadata Indexes**: Runs weekly on Mondays at 4:30 AM (`php artisan seo:optimize-indexes`).

## Tests Suite

Run all Pest feature tests to verify the integrity of the platform:
```bash
php artisan test
```

## License

MIT

