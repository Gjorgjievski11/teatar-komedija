# Teatar Komedija

A full-stack content management platform built for a theater, covering both the public-facing website and an internal admin panel for staff to manage everything shown on it.

> **Status:** Development project. Built during a client engagement that did not proceed to launch; included here as a portfolio reference for the scope of a full Laravel build.

## What it does

**Public site**
- Homepage, repertoire listing, and individual play pages
- Archive of past plays and repertoires
- Activities/events listing with categorized detail pages
- About section (collective, documents)
- Contact page
- Site-wide search
- Calendar view of upcoming shows/activities

**Admin panel** (authenticated)
- Manage plays, including crew assignments, performance dates, and image galleries
- Manage employees and job positions
- Manage activities and activity images
- Manage categories, contributions, and documents
- Google Calendar sync for scheduling
- Newsletter management
- Excel export support

## Tech stack

- **Backend:** Laravel 12 (PHP 8.2), Livewire 3
- **Frontend:** Tailwind CSS 4, Flowbite, Swiper, Vite
- **Integrations:** Google Calendar API (via `spatie/laravel-google-calendar`), ImageKit for image handling, Maatwebsite Excel for exports
- **Tooling:** Docker (`phpdocker/`, `docker-compose.yml`), PHPUnit, Laravel Pint

## Local setup

\`\`\`bash
composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate

npm run dev
\`\`\`

In a separate terminal:

\`\`\`bash
php artisan serve
\`\`\`

Or run everything (server, queue listener, and Vite) together:

\`\`\`bash
composer run dev
\`\`\`

### Docker

A Docker setup is included under \`phpdocker/\`. Bring the stack up with:

\`\`\`bash
docker-compose up -d
\`\`\`

## Testing

\`\`\`bash
composer test
\`\`\`

## Notes

\`.env\`, \`vendor/\`, and \`node_modules/\` are excluded from version control — run the setup steps above after cloning.
