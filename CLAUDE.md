# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 11 conference event website built from the Bootstrap "TheEvent" theme. It features a public-facing conference website and a complete admin panel for content management. The admin panel was generated using QuickAdminPanel and allows managing all sections of the conference homepage.

## Development Commands

### Setup
```bash
composer install                    # Install PHP dependencies
npm install                        # Install Node.js dependencies
cp .env.example .env               # Copy environment file
php artisan key:generate           # Generate application key
php artisan migrate --seed         # Run migrations and seed database
```

### Development
```bash
php artisan serve                  # Start development server
npm run dev                        # Build assets for development
npm run watch                      # Watch for asset changes
npm run hot                        # Hot reload for development
```

### Testing
```bash
./vendor/bin/phpunit               # Run PHPUnit tests
./vendor/bin/phpunit tests/Unit    # Run unit tests only
./vendor/bin/phpunit tests/Feature # Run feature tests only
```

### Production
```bash
npm run production                 # Build assets for production
php artisan config:cache           # Cache configuration
php artisan route:cache            # Cache routes
php artisan view:cache             # Cache views
```

## Architecture Overview

### Core Structure
- **Public Frontend**: Single-page conference website displaying event information
- **Admin Panel**: Complete CRUD interface at `/admin` for managing all content
- **API**: RESTful API endpoints at `/api/v1` with Passport authentication

### Key Models and Relationships
- **Settings**: Key-value pairs for site configuration (event name, dates, descriptions)
- **Speakers**: Event speakers with photos and bios
- **Schedule**: Event schedule linked to speakers with day grouping
- **Venues**: Event locations with photos and descriptions  
- **Hotels**: Partner hotels with photos and amenities
- **Galleries**: Event photo galleries
- **Sponsors**: Event sponsors with logos
- **FAQs**: Frequently asked questions
- **Prices**: Ticket pricing with many-to-many relationship to amenities
- **Users/Roles/Permissions**: Standard role-based access control

### Authentication & Authorization
- Admin login at `/login` (default: admin@admin.com / password)
- Role-based permissions system
- Laravel Passport for API authentication
- Registration disabled by default

### Frontend Architecture
- Public pages use `layouts/main.blade.php` with Bootstrap
- Admin pages use `layouts/admin.blade.php` with AdminLTE
- Asset compilation via Laravel Mix (webpack.mix.js)
- Responsive design with FontAwesome icons

### Data Management
- Eloquent models with standardized naming (Speaker, Schedule, etc.)
- Form request validation for all CRUD operations
- Media library integration (Spatie MediaLibrary) for file uploads
- Database seeders with sample data in `storage/seeders/`

### API Design
- All admin controllers have corresponding API controllers
- Resource-based endpoints following REST conventions
- Consistent JSON response format via API Resources
- Media upload endpoints for entities requiring file uploads

## Development Notes

- Uses Laravel 11 with PHP 8.2+
- Database agnostic (configured in .env)
- Media uploads handled by Spatie MediaLibrary package
- DataTables integration for admin list views
- Blade components for reusable UI elements