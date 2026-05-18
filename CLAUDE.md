# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project context

Despite the working-directory name `hospital-app`, the application is a Laravel 8 CMS/blog (`APP_NAME="Archiplus"`) built on top of an Active IT Zone ("Aiz") e‑commerce starter. `README.md` still advertises the original "E‑commerce Business" solution and `composer.json` pulls in many payment-gateway SDKs (Stripe, PayPal, Razorpay, Paystack, Mpesa, Paytm, CinetPay, Iyzico, Instamojo, Flutterwave, etc.) — but the live controllers, routes, and views only cover content (Blog, Pages, Sliders, Banners, About, Contact, Subscribers, Staff, Roles). Treat the e‑commerce packages as inherited weight; do not assume any of it is wired up. Confirm before extending in those directions.

The repo also ships three large `.sql` dumps at the root (`archiplus_blog.sql`, `demo.sql`, `shop.sql`) and a `How to update.pdf` — these are vendor/seed artifacts, not application code.

## Common commands

PHP / Laravel:
- `composer install` — install PHP deps
- `php artisan serve` — local dev server
- `php artisan migrate` / `php artisan migrate:fresh --seed` — run migrations (33 migrations under `database/migrations/`, single `DatabaseSeeder.php`)
- `php artisan key:generate` — required after first clone (runs automatically via `post-create-project-cmd`)
- `php artisan tinker` — REPL
- `php artisan ide-helper:generate` — regenerate `_ide_helper.php` (barryvdh/laravel-ide-helper is installed)

Frontend assets (Laravel Mix, webpack):
- `npm install`
- `npm run dev` / `npm run watch` — development build
- `npm run prod` — production build
- Mix only compiles `resources/js/app.js` → `public/js` and `resources/sass/app.scss` → `public/css` (see `webpack.mix.js`). Most frontend assets are pre-built and committed under `public/`.

Tests (PHPUnit 9):
- `./vendor/bin/phpunit` — run all suites
- `./vendor/bin/phpunit --testsuite=Unit` / `--testsuite=Feature`
- `./vendor/bin/phpunit tests/Feature/ExampleTest.php` — single file
- `./vendor/bin/phpunit --filter testMethodName` — single test
- Note: only stub `ExampleTest.php` files exist; there is no real test coverage to rely on.

## Architecture

**Three separate route files**, all loaded by `app/Providers/RouteServiceProvider.php` and all under the `web` middleware group (despite the naming):
- `routes/web.php` — public storefront pages (`/`, `/blog`, `/about-us`, `/contact`, `/category/{slug}`, `/{slug}` catch-all for custom pages). Also hosts `Auth::routes(['verify' => true])` and the AizUploader endpoints (`/aiz-uploader/*`).
- `routes/admin.php` — entire admin panel, gated by `['auth','admin']`. All admin URLs live under `/admin/...`. The `admin` middleware (`App\Http\Middleware\IsAdmin`) admits both `user_type == 'admin'` and `user_type == 'staff'`.
- `routes/api.php` — **empty** despite being mapped under `/api` with the `api` middleware group (`throttle:100,1`, `bindings`). Do not assume any API exists.

**User model** (`app/User.php`, table `users`) uses a string `user_type` column with values `admin`, `staff`, `customer`. Custom middleware keys registered in `app/Http/Kernel.php`: `admin`, `seller`, `user`, `unbanned`, `checkout`. Note: `EncryptCookies` is intentionally commented out of the `web` middleware group.

**Eloquent models live flat under `app/`** (not `app/Models/`) — this is Laravel pre-8 layout retained in this project: `Blog.php`, `Page.php`, `PageTranslation.php`, `Slider.php`, `Banner.php`, `BusinessSetting.php`, `Currency.php`, `Language.php`, `Customer.php`, `Role.php`, `Translation.php`, `Upload.php`, etc.

**Global helpers** in `app/Http/Helpers.php` are autoloaded via `composer.json` `"files"`. ~28 helpers (e.g. `areActiveRoutes`, `default_language`, currency/format helpers, translation helpers). Prefer reusing these over reimplementing — they are referenced throughout Blade views and controllers.

**Multi-language / multi-currency / business-settings** is a first-class concern:
- `App\Http\Middleware\Language` runs on every web request.
- `BusinessSetting` is a key/value table read constantly from views.
- Translation tables exist for pages, roles, and generic strings (`page_translations`, `role_translations`, `translations`).
- Routes `/language` and `/currency` switch the active locale/currency.

**Views** (`resources/views/`):
- `frontend/` — public-facing Blade templates.
- `backend/` — admin panel, organized by feature (`blog_system/`, `about_us/`, `contact/`, `slider_banner/`, `website_settings/`, `staff/`, `marketing/`, `notification/`, `setup_configurations/`, `system/`, `uploaded_files/`, `dashboard.blade.php`).
- `auth/`, `emails/`, `errors/`, `modals/`, `partials/`, `uploader/` are shared.

**File uploads** go through `AizUploadController` (`/aiz-uploader/*` and `/admin/uploaded-files/*`) and the `Upload` model — admin UIs select images via this picker rather than direct `<input type="file">`. When adding a feature that takes images, integrate with the AizUploader rather than rolling a new uploader.

## Environment & data

- `.env` and `.env.example` are both committed to the repo and **contain real-looking credentials** (DB password, Stripe test keys, etc.). Treat any keys here as already-leaked; do not echo them into commits, PRs, or chat output, and rotate before any deploy.
- Default DB connection is MySQL (`arc35205_archiplus_blog`).
- `_ide_helper.php` at repo root is a 760KB generated file — never edit by hand; regenerate with `php artisan ide-helper:generate`.
