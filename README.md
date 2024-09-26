# User and Role Management System

This Laravel application provides a comprehensive system for managing users and roles with full CRUD functionality. It's built using Laravel 8+ and follows the MVC architecture.

## Features

1. User Management
   - Create, Read, Update, and Delete users
   - Assign multiple roles to users

2. Role Management
   - Create, Read, Update, and Delete roles

3. Authentication
   - Login and Registration functionality
   - Protected routes accessible only to authenticated users

4. Multilingual Support
   - Supports English and Greek languages
   - Easy language switching

5. Responsive Design
   - Built with Bootstrap for a mobile-friendly interface

6. Security
   - CSRF protection
   - Password hashing

## Requirements and Implementation

1. MVC Architecture
   - Models: `app/Models/User.php` and `app/Models/Role.php`
   - Views: `resources/views/users/` and `resources/views/roles/`
   - Controllers: `app/Http/Controllers/UserController.php` and `app/Http/Controllers/RoleController.php`

2. Laravel Tools
   - Form creation: Blade templates in `resources/views/users/form.blade.php` and `resources/views/roles/form.blade.php`
   - Database Interaction: Eloquent ORM used in controllers
   - Migrations: `database/migrations/`
   - Validation: Server-side validation in controllers

3. Client-side Validation
   - Implemented in `resources/js/app.js`

4. AJAX Requests
   - Example implementation in `resources/js/app.js`

5. Bootstrap Frontend
   - Used throughout the views

6. Error Handling
   - Flash messages implemented in controllers and displayed in views

7. Database Transactions
   - Implemented in UserController and RoleController for critical operations

8. Multilingual Support
   - Language files: `resources/lang/en.json` and `resources/lang/el.json`
   - Language switcher in `resources/views/layouts/app.blade.php`

9. Authentication
   - Laravel's built-in authentication system
   - Protected routes in `routes/web.php`

10. Password Security
    - Hashing implemented in `app/Models/User.php`

11. Middleware
    - Custom SetLocale middleware in `app/Http/Middleware/SetLocale.php`

## Installation

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure your database
4. Run `php artisan key:generate`
5. Run `php artisan migrate`
6. Run `php artisan db:seed` (if seeders are provided)
7. Run `npm install && npm run dev`

## Usage

1. Register a new user or login with existing credentials
2. Navigate through the dashboard to manage users and roles
3. Use the language switcher in the navbar to change the interface language