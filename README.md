# Feedback System

A comprehensive feedback management system built with Laravel that allows users to create, manage, and comment on feedback with user authorization controls.

## Features

- **User Authentication**: Secure login and registration system
- **Feedback Management**: Create, edit, delete, and view feedback
- **Comment System**: Add comments to feedback with user mentions
- **Authorization Controls**: Users can only edit/delete their own feedback and comments
- **User Mentions**: Mention other users in comments
- **Responsive Design**: Modern dashboard interface

## Prerequisites

Before you begin, ensure you have the following installed on your computer:

- **MySQL Server** with PHP 8.2 or greater
- **Composer** (PHP package manager)
- **Git** (version control)

## Installation

Follow these step-by-step instructions to set up the Feedback System:

### Step 1: Clone the Repository
```bash
git clone <repository-url>
cd feedback-system
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Environment Configuration
1. Create a `.env` file in the root directory
2. Copy all environment variables from `.env.example` file to `.env`
3. Update the database configuration in `.env` file

### Step 4: Database Setup
1. Create a MySQL database named `feedback_system` (same as in your `.env` file)
2. Run database migrations:
```bash
php artisan migrate
```

### Step 5: Seed the Database
```bash
php artisan db:seed
```

### Step 6: Start the Application
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Testing User Authentication

You can test the user authentication with the created users from `database/seeders/UserSeeder.php`. The seeder creates sample users with the following credentials:

- **User 1**: Check the UserSeeder.php file for credentials
- **User 2**: Check the UserSeeder.php file for credentials

## Authorization Testing

To test the authorization features:

1. **Use two different browsers** or incognito windows
2. **Login with different users** in each browser
3. **Test the following features**:
   - **Feedback Management**: Only the feedback creator can edit/delete their feedback
   - **Comment Management**: Only the comment creator can delete their comments
   - **User Mentions**: Users can mention other users in comments

## Project Structure

```
feedback-system/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── Http/Requests/       # Form request validation
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   └── views/              # Blade templates
└── routes/
    └── web.php             # Web routes
```

## Key Features Explained

### Authorization System
- Users can only edit/delete their own feedback
- Users can only delete their own comments
- Proper server-side validation prevents unauthorized access

### Comment System
- Users can add comments to any feedback
- Support for mentioning other users in comments
- Mentioned users are displayed as badges

### User Interface
- Modern, responsive dashboard design
- Clean and intuitive user experience
- Consistent styling throughout the application

## Support

If you encounter any issues during installation or have questions about the system, please refer to the Laravel documentation or create an issue in the repository.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
