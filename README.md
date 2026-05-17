# ITerrific Workforce & Time Registration App

ITerrific is a Laravel and Livewire application for managing employees, projects, time registration, approvals, billing visibility, and public website contact flows.

The app started from Material Dashboard 2 Laravel Livewire, but the current codebase has been extended into an ITerrific-specific internal operations tool with role permissions, project assignment, external employee billing, email verification, Microsoft Graph mail delivery, and PDF exports.

## What The Software Does

The application supports two main areas:

- Public website pages for visitors: home, services, about, references, contact, privacy, login, and signup.
- Authenticated dashboard modules for employees, managers, and administrators.

Main dashboard features:

- User Management: create, edit, delete, filter, and manage users.
- Roles & Permissions: define read/write access per dashboard module.
- Permission Preview: administrators can preview the app as another user.
- Projects: define client projects, external contacts, approval manager details, and assigned users.
- Calendars: define country-specific non-working holidays.
- Time Entry: employees register hours per assigned project and month.
- Approvals: managers/admins review, approve, decline, and export employee hours.
- Billing: external employees see their own approved-hour billing analytics; administrators can review all external users.
- User Profile: users maintain profile, company, address, banking, VAT, avatar, and password data.
- Email Verification: registered and admin-created users must verify email before dashboard access.
- Microsoft Graph Mail: contact forms, verification emails, and password reset emails are sent through Microsoft Graph.
- PDF Export: time entry/approval exports use DomPDF.

## Technology Stack

- Laravel 11
- Livewire 3
- Blade
- Laravel Mix
- Bootstrap 5 / Material Dashboard 2
- Chart.js
- intl-tel-input
- DomPDF
- Microsoft Graph mail integration
- MySQL/MariaDB

## Requirements

Use PHP 8.2 or newer. Laravel 11 and the installed lock file require PHP 8.2-compatible runtime behavior.

Required server components:

- PHP 8.2+
- Composer 2.2+
- MySQL or MariaDB
- Node.js and npm, for local frontend builds
- Web server such as Nginx, Apache, or OpenLiteSpeed

Required PHP extensions include:

- `curl`
- `dom`
- `fileinfo`
- `gd`
- `mbstring`
- `openssl`
- `pdo_mysql`
- `tokenizer`
- `xml`
- `zip`

`gd` is required for PDF/logo/image handling through DomPDF.

## Local Installation

Clone the repository:

```bash
git clone https://github.com/EmadHeravi/Iterrific-app.git
cd Iterrific-app
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the app key:

```bash
php artisan key:generate
```

Configure `.env`:

```env
APP_NAME=ITerrific
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=iterrific
DB_USERNAME=root
DB_PASSWORD=

MS_TENANT_ID=
MS_CLIENT_ID=
MS_CLIENT_SECRET=
MS_MAIL_FROM=info@iterrific.nl
```

Run migrations:

```bash
php artisan migrate
```

Optional seeders:

```bash
php artisan db:seed
php artisan db:seed --class=NetherlandsCalendarSeeder
```

Create the storage symlink:

```bash
php artisan storage:link
```

Build frontend assets:

```bash
npm run dev
```

For production assets:

```bash
npm run prod
```

Start the local server:

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## Production Deployment

The production server used for this app runs PHP 8.2 from:

```bash
/www/server/php/82/bin/php
```

Use that PHP binary for Artisan commands.

From the production project directory:

```bash
cd /www/wwwroot/iterrific.nl
```

Pull the latest code:

```bash
git pull origin master
```

Install/update Composer dependencies:

```bash
COMPOSER_ALLOW_SUPERUSER=1 composer2 install --no-dev --optimize-autoloader --no-scripts --ignore-platform-req=php --ignore-platform-req=ext-curl --ignore-platform-req=ext-dom
```

Then run package discovery with PHP 8.2:

```bash
/www/server/php/82/bin/php artisan package:discover --ansi
```

Run migrations:

```bash
/www/server/php/82/bin/php artisan migrate --force
```

Seed Netherlands holidays when needed:

```bash
/www/server/php/82/bin/php artisan db:seed --class=NetherlandsCalendarSeeder --force
```

Create storage symlink if not already present:

```bash
/www/server/php/82/bin/php artisan storage:link
```

Publish Livewire assets:

```bash
/www/server/php/82/bin/php artisan livewire:publish --assets
```

Clear and rebuild caches:

```bash
/www/server/php/82/bin/php artisan optimize:clear
/www/server/php/82/bin/php artisan optimize
```

Verify migrations:

```bash
/www/server/php/82/bin/php artisan migrate:status
```

Production `.env` must include:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://iterrific.nl

MS_TENANT_ID=...
MS_CLIENT_ID=...
MS_CLIENT_SECRET=...
MS_MAIL_FROM=info@iterrific.nl
```

## Microsoft Graph Mail

The app sends mail through `App\Services\MicrosoftGraphMailer`.

Used for:

- Contact form notifications
- Email verification
- Password reset

Required environment variables:

```env
MS_TENANT_ID=
MS_CLIENT_ID=
MS_CLIENT_SECRET=
MS_MAIL_FROM=
```

After changing these values on production, clear and rebuild config cache:

```bash
/www/server/php/82/bin/php artisan optimize:clear
/www/server/php/82/bin/php artisan optimize
```

## User Roles

The app supports role-based permissions:

- Administrator: full system access and access to all external billing data.
- Manager: can manage assigned employee hours according to permissions.
- Member: can register and manage own time entries before approval.

Permissions are configurable in:

```text
Settings -> User Management -> Roles
```

Each role can be given read/write access per dashboard module.

## Time Entry Rules

Employees register hours against assigned projects.

Time entries include:

- User
- Project
- Entry date
- Hours
- Description
- Status
- Weekend/holiday flags
- Calendar relation
- Review data

Statuses:

- Draft
- Submitted
- Approved
- Declined

Members can create and edit their own entries until approval. Approved entries require manager/admin permission to change.

## Approval Rules

Managers can review hours for assigned employees.

Assignments are managed in User Management when editing a manager user. Administrators can access broader approval views depending on permissions.

## Billing Rules

Billing is designed for external employees.

Calculations use:

```text
approved hours * hourly fee = amount excluding VAT
amount excluding VAT * user VAT rate = VAT amount
amount excluding VAT + VAT amount = amount including VAT
```

Hourly fee, currency, and VAT rate are stored per user.

Visibility:

- External user: can only view their own billing data.
- Administrator: can view all external users.
- Permission preview: restricted to the previewed user's own billing data.

## Calendars And Holidays

The Calendars module stores national/non-working days per country.

The Netherlands seeder can be run with:

```bash
php artisan db:seed --class=NetherlandsCalendarSeeder
```

Production:

```bash
/www/server/php/82/bin/php artisan db:seed --class=NetherlandsCalendarSeeder --force
```

## Useful Artisan Commands

Clear views:

```bash
php artisan view:clear
```

Clear all caches:

```bash
php artisan optimize:clear
```

Build caches:

```bash
php artisan optimize
```

Run tests:

```bash
php artisan test
```

List routes:

```bash
php artisan route:list
```

Check migrations:

```bash
php artisan migrate:status
```

## Frontend Assets

Development build:

```bash
npm run dev
```

Production build:

```bash
npm run prod
```

The build uses:

```text
scripts/mix-build.js
webpack.mix.js
```

Compiled assets are written to `public/css`, `public/js`, and `public/mix-manifest.json`.

## Important Paths

Livewire components:

```text
app/Http/Livewire
```

Dashboard views:

```text
resources/views/livewire
```

Settings modules:

```text
resources/views/livewire/example-laravel
```

Routes:

```text
routes/web.php
```

Models:

```text
app/Models
```

Migrations:

```text
database/migrations
```

Seeders:

```text
database/seeders
```

Custom dashboard CSS:

```text
public/assets/css/iterrific-dashboard.css
```

## Troubleshooting

Composer uses PHP 8.1 instead of PHP 8.2:

Use the full PHP 8.2 path for Artisan commands and ensure Composer is compatible with the deployed PHP version.

Missing `curl` or `dom`:

Enable/install the PHP extensions for the CLI and web PHP version.

PDF export says GD is missing:

Install/enable the PHP `gd` extension for PHP 8.2.

Livewire assets missing:

```bash
/www/server/php/82/bin/php artisan livewire:publish --assets
```

Environment variables changed but app still reads old values:

```bash
/www/server/php/82/bin/php artisan optimize:clear
/www/server/php/82/bin/php artisan optimize
```

## License And Credits

The dashboard UI is based on Material Dashboard 2 Laravel Livewire by Creative Tim and UPDIVISION. The ITerrific-specific application logic, modules, styling, and workflows extend that base for ITerrific operations.
