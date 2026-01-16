# Ticketing System (Laravel)

A role-based ticketing system built with Laravel. It provides a web interface for end users to open and manage support tickets, for agents to work on assigned tickets, and for administrators to manage categories, tickets and users.

---

## Non-technical summary (for managers / stakeholders)

- What it does: Lets customers (users) open support tickets, agents process tickets assigned to them, and administrators manage categories, users and ticket assignment/status.
- Who uses it:
  - User — submits and tracks tickets.
  - Agent — processes assigned tickets.
  - Admin — manages categories, assigns tickets to agents, updates ticket status, and manages users.
- Why it matters: Centralizes support requests, adds accountability (assignment/status), and makes reporting by category/status possible.
- How it’s delivered: Web application built on the Laravel framework (PHP), uses standard web technologies for the front-end (Tailwind, Vite).

---

## Technical summary (for developers)

- Framework: Laravel (PHP)
- Frontend tooling: Vite, Tailwind CSS (tailwind.config.js, vite.config.js present)
- Auth scaffolding: Laravel authentication controllers/routes are present (RegisteredUserController, AuthenticatedSessionController, password reset, email verification).
- Key models:
  - `app/Models/User.php` — users with roles (`user`, `agent`, `admin`).
  - `app/Models/Ticket.php` — tickets (fields: user_id, category_id, title, description, status, assigned_to).
  - `app/Models/Categories.php` — categories with ticket relationships and convenience counts.
- Key controllers:
  - `app/Http/Controllers/TicketController.php` (core user/agent ticket flows — some endpoints referenced in routes).
  - `app/Http/Controllers/AdminTicketController.php` — admin ticket listing, assign/update status and assignment forms.
  - Auth controllers in `app/Http/Controllers/Auth/*` — registration, login, password reset, email verification.
  - `app/Http/Controllers/ProfileController.php` — user profile management.
- Middleware / Access control:
  - `app/Http/Middleware/CheckRole.php` — enforces role-based access (`role` middleware alias in Kernel).
  - Routes grouped with middleware (see `routes/web.php`) for `role:user`, `role:agent`, `role:admin`.
- Routes:
  - `routes/web.php` contains web routes for users, agents and admins (dashboards, tickets, categories, user management).
  - `routes/auth.php` contains auth-related routes.
  - `routes/api.php`, `channels.php`, and `console.php` are present for API, broadcasting channels, and console routes respectively.
- Tests: `phpunit.xml` is present — PHPUnit can be used to run tests.
- Tooling/config: `composer.json`, `package.json`, `vite.config.js`, `tailwind.config.js`, `postcss.config.js`

---

## Features (at-a-glance)

- Multi-role support: user, agent, admin
- Ticket lifecycle: create, view, edit (agent/admin), close
- Assignment: admins can assign tickets to agents
- Category management (create/edit/delete)
- Role-based protected routes and UI flows
- Standard Laravel auth (registration, login, password reset, email verification)
- Frontend using Tailwind + Vite

---

## Project structure (important files & what they do)

- `app/Models/`
  - `User.php` — user model with role constants and relationships to tickets.
  - `Ticket.php` — ticket model with relationships (creator, agent, category) and helper methods (`canBeModified`, `canBeProcessed`).
  - `Categories.php` — category model with ticket counts (active/resolved).
- `app/Http/Controllers/`
  - `AdminTicketController.php` — admin ticket listing, assignment and status updates.
  - `ProfileController.php` — profile edit/update/destroy.
  - `Auth/*` — authentication flow controllers.
  - `TicketController.php` — user/agent ticket actions (referenced by routes).
- `app/Http/Middleware/CheckRole.php` — rejects requests where user role does not match the required role (abort 403).
- `routes/web.php` — main web routes with middleware groups:
  - User routes (dashboard, tickets, profile)
  - Admin routes (`/admin/` prefix) for categories, tickets, and user management
  - Agent routes under `/agent` for agent dashboard and ticket management
- `resources/` — frontend views (not enumerated here).
- `public/` — assets and compiled files served to clients.
- `composer.json` / `package.json` — project dependencies.

---

## Setup / Installation

Prerequisites:
- PHP 8.x (check project composer requirement)
- Composer
- Node.js (16+ recommended) and npm or yarn
- A database (MySQL, PostgreSQL, SQLite, etc.)

Typical local setup:

```bash
# clone repo
git clone https://github.com/nolongeraregistereduser/Ticketing-System-Laravel.git
cd Ticketing-System-Laravel

# install PHP dependencies
composer install

# copy env file and generate app key
cp .env.example .env
php artisan key:generate

# edit .env and add DB and mail credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# run migrations (and seed if you have seeders)
php artisan migrate
# optionally:
# php artisan db:seed

# install JS dependencies and build assets
npm install
npm run dev

# create storage link if the project needs it
php artisan storage:link

# run the app
php artisan serve
# app will typically be available at http://127.0.0.1:8000
```

Running tests:

```bash
# run Laravel test runner (or vendor's phpunit)
php artisan test
# or
./vendor/bin/phpunit
```

Environment variables:
- Use `.env.example` as the reference. Typical values you need to set:
  - APP_NAME, APP_URL
  - DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
  - MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_FROM_ADDRESS
  - VITE_* or other environment variables if present

---

## Common tasks & tips

- Create an admin user (example using tinker):
  ```bash
  php artisan tinker
  >>> $u = new \App\Models\User();
  >>> $u->name = 'Admin';
  >>> $u->email = 'admin@example.com';
  >>> $u->password = bcrypt('secret');
  >>> $u->role = 'admin';
  >>> $u->save();
  ```
  Or create a seeder for initial admin and run `php artisan db:seed`.

- Assign a ticket in the admin UI:
  - Admin -> Tickets -> Assign -> choose agent -> Submit (handled by AdminTicketController).

- If you get a 403 on a page, verify the logged-in user has the correct role and email is verified (some routes require `verified`).

- Clear caches:
  ```bash
  php artisan route:clear
  php artisan config:clear
  php artisan cache:clear
  composer dump-autoload
  ```

- If file uploads or storage fails, ensure `storage/` and `bootstrap/cache/` have correct permissions and `php artisan storage:link` has been run.

---

## Security notes

- Do not commit your `.env` file or secrets to source control.
- Passwords are hashed (see `User.php` cast for password).
- Role checks are enforced by `CheckRole` middleware — ensure new sensitive endpoints are behind appropriate checks.
- Keep dependencies up to date (run `composer update` and `npm update` in a controlled manner and test after changes).

---

## Extending the app

- Policies & gates: For fine-grained authorization, add policy classes and register them with AuthServiceProvider.
- Notifications & emails: Laravel notifications can be used for notifying agents/users on ticket events.
- Background jobs: If you plan heavy tasks (attachments processing, bulk emails), use Laravel queues.
- API: `routes/api.php` exists — consider exposing RESTful endpoints and protecting them with tokens (Sanctum) if needed.

---

## Where to look in the code (quick links & descriptions)

- Models:
  - `app/Models/User.php` — roles, relationships, helper methods.
  - `app/Models/Ticket.php` — ticket data, relationships, helper methods.
  - `app/Models/Categories.php` — categories and ticket counts.

- Controllers:
  - `app/Http/Controllers/AdminTicketController.php` — admin ticket flows (index, assign, update status).
  - `app/Http/Controllers/ProfileController.php` — profile management.
  - `app/Http/Controllers/Auth/*` — auth controllers for registration, login, password reset, email verification.

- Routes:
  - `routes/web.php` — groups and endpoints for users, admins and agents.

- Middleware:
  - `app/Http/Middleware/CheckRole.php` — role-based access check.

(Refer to the repository codebase for exact implementations and additional controllers or views.)

---

## Contributing & development workflow

- Follow PSR-12 / Laravel coding style.
- Create feature branches, open PRs with clear descriptions and testing steps.
- Add or update migrations and seeders for database changes.
- Write tests for new features and bug fixes; run the test suite before opening PRs.

---

## Troubleshooting common issues

- "500 / 403 errors" — check storage/logs/laravel.log, verify middleware and roles.
- "Database errors" — ensure `.env` DB credentials are correct and migrations have run.
- "Assets not loading" — run `npm run dev` (development) or `npm run build` (production) and ensure Vite is configured correctly.

---

## License

This repository uses the MIT license (the project is based on Laravel). See LICENSE file for details if present.

---

If you want, I can:
- produce a condensed one-page README for non-technical stakeholders,
- generate developer onboarding checklist (exact commands + environment checklist),
- add example seeders or an artisan command to create admin/agents automatically,
- or draft contribution guidelines and a CODE_OF_CONDUCT file.
