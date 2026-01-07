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

## Small gotchas / tips for agents
- Default credentials exist only after running migrations+seeders: `admin@material.com` / `secret`.
- When adding DB fixtures in seeders, remember `User` mutator will hash plain passwords automatically.
- For tests relying on DB, prefer enabling sqlite in-memory or configuring a test DB; phpunit.xml includes commented DB lines.
- Use Livewire classes as single-page entry points: modifying the class or its view affects the route directly.

---
If you'd like, I can merge this with an existing `.github/copilot-instructions.md` template (if present) or expand sections (e.g., common refactor patterns, code style conventions, or more code examples). Please tell me what to add or clarify. ✅
