# Laravel Login Project

This is a basic Laravel project that implements user authentication with a login and registration page.

## Project Structure

- **app/**: Contains the core application code.
  - **Console/**: Console commands for the application.
  - **Exceptions/**: Custom exception classes.
  - **Http/**: Contains controllers, middleware, and requests.
    - **Controllers/**: 
      - `AuthController.php`: Handles user authentication.
      - `Controller.php`: Base controller class.
    - **Middleware/**: HTTP request filtering classes.
    - **Requests/**: Form request classes for validation.
  - **Models/**: 
    - `User.php`: Represents users in the application.

- **bootstrap/**: Files for bootstrapping the application.

- **config/**: Configuration files for various services.

- **database/**: Contains migrations, factories, and seeders.
  - **migrations/**: 
    - `2023_01_01_000000_create_users_table.php`: Migration for users table.
  
- **public/**: Publicly accessible files (CSS, JS, images).

- **resources/**: Contains views and assets.
  - **views/**: 
    - **auth/**: 
      - `login.blade.php`: Blade template for the login page.
      - `register.blade.php`: Blade template for the registration page.
    - **layouts/**: 
      - `app.blade.php`: Main layout template.

- **routes/**: Contains web routes for the application.
  - `web.php`: Defines routes including authentication.

- **storage/**: Generated files (logs, cached files).

- **tests/**: Contains feature and unit tests.

- **artisan**: Command-line interface for the application.

- **composer.json**: Composer dependencies configuration.

- **package.json**: NPM dependencies and scripts configuration.

- **phpunit.xml**: PHPUnit configuration for running tests.

- **webpack.mix.js**: Configuration for Laravel Mix.

## Installation

1. Clone the repository.
2. Run `composer install` to install PHP dependencies.
3. Run `npm install` to install JavaScript dependencies.
4. Set up your `.env` file and configure your database.
5. Run migrations with `php artisan migrate`.
6. Start the server with `php artisan serve`.

## Usage

Visit the login page at `/login` to authenticate users. Users can also register at `/register`. 

## License

This project is open-source and available under the MIT License.