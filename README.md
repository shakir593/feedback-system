# Feedback System

A Laravel application for collecting and managing product feedback. Signed-in users can submit feedback, organize it by category, and discuss it in comments with @mentions.

## Key features

- **Authentication.** Register and sign in. Registration requires accepting the terms and conditions.
- **Dashboard.** A signed-in home for feedback management.
- **Feedback CRUD.** Create, view, edit, and delete feedback with a title, description, and category.
- **Categories.** Feedback is grouped as bug report, feature request, or improvement.
- **Comments.** Add a comment to any feedback, including a date and description.
- **User mentions.** Mention other users in a comment with `@`. Matching users are suggested as you type.
- **Ownership rules.** Only the author can edit or delete a piece of feedback, and only the author can delete a comment.
- **Sidebar navigation.** Feedback Management stays active on list, detail, edit, and comment pages.

## Prerequisites

- PHP 8.2 or newer
- Composer
- MySQL
- Git

## Installation

### 1. Clone the repository

```bash
git clone <repository-url>
cd feedback-system
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Configure the environment

```bash
cp .env.example .env
```

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Open `.env` and set the application URL and MySQL connection:

```env
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=feedback_system
DB_USERNAME=root
DB_PASSWORD=
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Create the database

Create an empty MySQL database named `feedback_system` (the name in `DB_DATABASE`).

### 5. Run migrations

```bash
php artisan migrate
```

This creates the users, sessions, feedback categories, feedback, comments, and comment-mention tables.

### 6. Seed categories and users

Seed everything:

```bash
php artisan db:seed
```

Or seed each set on its own:

```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=FeedbackCategorySeeder
```

`FeedbackCategorySeeder` creates:

- bug report
- feature request
- improvement

`UserSeeder` creates these accounts:

| Name | Email | Password |
| --- | --- | --- |
| Admin | admin@example.com | admin_123 |
| John Doe | john@example.com | john_123 |
| Jane Smith | jane@example.com | jane_123 |
| Selena Gomez | selena.gomez@example.com | selena_123 |
| Taylor Swifth | taylor.swifth@example.com | selena_123 |

### 7. Start the application

```bash
php artisan serve
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000) and sign in with one of the seeded accounts.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
