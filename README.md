# Laravel 12 with Vite and Tailwind Project

A modern web application built with Laravel 12 framework and Vite for asset bundling. This project uses TailwindCSS for styling and includes a robust development environment setup.

## Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL or compatible database

## Installation

1. Clone the repository

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run database migrations:
```bash
php artisan migrate
```

## Development

1. Start the Laravel development server:
```bash
php artisan serve
```

2. Start Vite development server:
```bash
npm run dev
```

## Building for Production

1. Compile and minify assets:
```bash
npm run build
```

2. Configure production environment variables in `.env`

## Project Structure

- `app/` - Contains core application code
- `resources/` - Contains views, assets (JS, CSS, images)
  - `js/` - JavaScript files
  - `css/` - CSS files
  - `img/` - IMG files
  - `audio/` - AUDIO files
  - `json/` - JSON files
  - `views/` - Blade templates
- `routes/` - Application routes
- `config/` - Configuration files
- `database/` - Database migrations and seeders

## Features

- Laravel 12 framework
- Vite for asset bundling
- TailwindCSS for styling
- Modern JavaScript with module support
- Organized resource structure
- Development hot-reloading

## Testing

Run tests using PHPUnit:
```bash
php artisan test
```
