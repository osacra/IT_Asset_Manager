# IT Asset Manager

IT Asset Manager is a Laravel application for controlling IT assets, loans, returns and movement history. It was designed to replace fragmented spreadsheet-based workflows with a system that provides traceability, role-based access and explicit business rules.

## What the system solves

The application centralizes the lifecycle of notebooks, monitors and other IT assets. It records who is responsible for an asset, when it was borrowed, when it was returned and which actions changed its state.

## Main capabilities

- Asset, category and employee management.
- Loan and return workflows with automatic status changes.
- Role-based access control for administrators and technicians.
- Authentication and protected application routes.
- Movement history and audit records through Eloquent Observers.
- Seeded local data for a reproducible demonstration environment.
- MVC organization following Laravel conventions.

## Business rules

| Domain rule | Expected behavior |
|---|---|
| Asset ownership | Every asset belongs to an asset category. |
| Active loan | An asset cannot have more than one active loan. |
| New loan | The asset status changes to **In use**. |
| Return | The return date is recorded and the asset becomes **Available**. |
| Audit | Asset movements are recorded in the history. |
| Technician role | Technicians can consult records and operate loans and returns. |
| Administrator role | Administrators have full CRUD and user-management access. |

## Technology stack

| Area | Technologies |
|---|---|
| Backend | PHP 8.3+, Laravel 13 |
| Database | MySQL or the local database configured in `.env` |
| Views and UI | Blade, Bootstrap 5, Font Awesome |
| ORM and architecture | Eloquent ORM, MVC, Eloquent Observers |
| Tooling | Composer, Vite, Laravel Boost, PHPUnit |

## Run locally

### Requirements

- PHP 8.3 or newer.
- Composer.
- Node.js and npm.
- MySQL, or another database configured in the local `.env` file.

### Install

```bash
git clone https://github.com/osacra/IT_Asset_Manager.git
cd IT_Asset_Manager
composer install
cp .env.example .env
php artisan key:generate
```

Configure the database connection in `.env`, then run the migrations and local seeders:

```bash
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Open `http://127.0.0.1:8000` in the browser.

The seeders create local demonstration users. Their credentials are intentionally not reproduced in this README; inspect or customize the seeders in a local environment before sharing a demo instance. Never reuse development passwords in production.

## Project structure

```text
app/                  Application models, controllers and domain logic
database/             Migrations and local seeders
resources/             Blade views and frontend assets
routes/                Web and authentication routes
tests/                 Automated tests
README.md              Setup and architecture documentation
PLANO_IMPLEMENTACAO.md Implementation plan
RELATORIO.md           Development report
```

## Engineering notes

The application keeps domain behavior close to the Laravel model and service boundaries. Eloquent Observers provide an audit trail for asset movements, while authorization rules separate administrator capabilities from technician workflows. The project also documents the implementation plan and the reasoning behind the MVP scope.

## Roadmap

- Expand feature and authorization test coverage.
- Add searchable and exportable audit reports.
- Improve validation and user feedback for edge cases.
- Add CI for PHP tests and frontend build verification.
- Publish a controlled demo environment with isolated credentials.
