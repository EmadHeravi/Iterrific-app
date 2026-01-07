# GitHub Copilot / AI Agent Instructions for Material Dashboard (Laravel Livewire)

Purpose: Short, actionable guidance to help an AI agent be productive immediately in this repository.

## Quick setup (development)
- System: PHP >= 8.1, Composer, Node & npm (for Laravel Mix). Laravel framework ^11, Livewire ^3.
- Install PHP deps: `composer install`
- Copy env and keys: `copy .env.example .env` then `php artisan key:generate`
- DB & seed: `php artisan migrate --seed` (creates a default user `admin@material.com` / `secret`)
- Storage (if needed): `php artisan storage:link`
- Frontend build: `npm install` then `npm run dev` (or `npm run production` for prod)
- Run app (development): `php artisan serve` (or use your preferred local environment)

## Environment / secrets to know
- `TURNSTILE_SITE_KEY` and `TURNSTILE_SECRET_KEY` (used by `config/services.php` → `turnstile`) are required for the contact form (`app/Http/Controllers/ContactController.php`).
- Tests use `MAIL_MAILER=array` and `SESSION_DRIVER=array` (configured in `phpunit.xml`). To use in-memory sqlite tests enable the commented DB env lines in `phpunit.xml`.

## Tests & CI
- Run tests: `php artisan test` or `vendor/bin/phpunit`
- Note: `phpunit.xml` sets test environment variables (e.g., `SESSION_DRIVER=array`, `MAIL_MAILER=array`). If you want in-memory DB testing, enable the commented `DB_CONNECTION=sqlite` and `DB_DATABASE=:memory:` lines in `phpunit.xml`.
- Coverage includes `./app` by default.

## High-level architecture / how things are wired
- Laravel app (backend) with Livewire components for most UI logic; minimal controllers.
- Livewire component classes: `app/Http/Livewire/*` and their Blade views: `resources/views/livewire/*`.
- Routes map directly to Livewire classes in `routes/web.php`, e.g.:

```php
// Livewire page route example
Route::get('sign-in', App\Http\Livewire\Auth\Login::class)->middleware('guest')->name('login');
```

- Static pages are often `Route::view('/about', 'about')`.
- Assets: `resources/js/app.js` and `resources/css/app.css` → compiled by `webpack.mix.js` (Laravel Mix).

## Key project-specific patterns & conventions
- Authentication and validation: Livewire components declare `$rules` and `store()` methods that validate and perform actions, e.g. `App/Http/Livewire/Auth/Login.php`:
  - `auth()->attempt($attributes)`, `session()->regenerate()`, `return redirect('/dashboard')`.
- Password hashing: `App\Models\User` defines `setPasswordAttribute()` which bcrypts plain passwords. Seeders create users by passing plain `password => 'secret'` (the mutator hashes it automatically).
- Reset password flow uses a custom notification: `App\Notifications\ResetPassword` creates a 12-hour signed URL using `URL::temporarySignedRoute('reset-password', now()->addHours(12), ['id' => $token])`. Route `reset-password` uses `signed` middleware.

- Contact form anti-bot: the site uses Cloudflare Turnstile. `app/Http/Controllers/ContactController.php` posts to Cloudflare's verify endpoint (`https://challenges.cloudflare.com/turnstile/v0/siteverify`) with `services.turnstile.secret_key` and checks `success` in the response. If verification fails it returns a validation error.


## Developer workflows & helpful file references
- Add a new page:
  1. Create Livewire class in `app/Http/Livewire` (or subdir).
  2. Create Blade view in `resources/views/livewire`.
  3. Add route in `routes/web.php` using the Livewire class.
- Fix or extend auth behavior: check `app/Http/Livewire/Auth/*` and `app/Models/User.php`.
- Component UI lives in `resources/views/livewire/...` and uses Bootstrap 5 markup consistent with the theme.

## Integration points & external deps
- Livewire (v3): interactive components are server-driven (no SPA router).
- Laravel Mix: front-end bundling, `npm run dev/watch/hot/production`.
- Notifications & mail are used for password reset (`App\Notifications\ResetPassword`). Tests default to mailer `array`.

## Helpful files to inspect when making changes
- Routing & pages: `routes/web.php` (Livewire routes + static `Route::view` pages)
- Livewire pages: `app/Http/Livewire/*` and `resources/views/livewire/*`
- Auth & model logic: `app/Models/User.php`, `app/Http/Livewire/Auth/*`
- Password reset: `app/Notifications/ResetPassword.php`
- Contact/Turnstile: `app/Http/Controllers/ContactController.php`, `config/services.php`
- Assets/build: `webpack.mix.js`, `package.json` (npm scripts)
- Tests config: `phpunit.xml`
- Database seed: `database/seeders/DatabaseSeeder.php`

## Small gotchas / tips for agents
- Default admin user is created only by running `php artisan migrate --seed` (email: `admin@material.com`, password: `secret`).
- The `User` model's `setPasswordAttribute()` will bcrypt any password set on the model — seeders and factories pass plain text intentionally.
- The contact form will return a validation error if Turnstile verification fails; ensure `TURNSTILE_*` env vars are set.
- Tests default to using `array` mailer and `array` session driver; adjust `phpunit.xml` if you need integration-level mail/session behavior.

---
If you'd like, I can expand any section with concrete code examples, a short PR checklist, or a set of targeted tests to validate common changes. Tell me which areas to expand. ✅
