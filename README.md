# Civic Volunteer Platform

## Overview

The Civic Volunteer Platform is a web application designed to connect organizations with volunteers for civic engagement opportunities. This platform allows organizations to create, manage, and promote volunteer opportunities, while enabling volunteers to discover and participate in meaningful community service activities.

## Features

### For Organizations
- **Opportunity Management**: Create, edit, view, and delete volunteer opportunities
- **Dashboard**: Manage all your volunteer opportunities in one place
- **Profile Management**: Update organization information and contact details

### For Volunteers (Coming Soon)
- **Opportunity Discovery**: Browse and search for volunteer opportunities
- **Application System**: Apply for volunteer positions
- **Profile Management**: Track volunteer history and interests

## Technology Stack

- **Backend**: Laravel 10.x (PHP 8.2+)
- **Frontend**: Blade templates with Tailwind CSS and Alpine.js
- **Database**: MySQL
- **Build Tools**: Vite

## Project Structure

```
├── app/                  # Application code
│   ├── Http/             # Controllers and middleware
│   ├── Models/           # Eloquent models
│   └── Providers/        # Service providers
├── bootstrap/            # Framework bootstrap files
├── config/               # Configuration files
├── database/             # Database migrations and seeders
├── public/               # Publicly accessible files
├── resources/            # Views, assets, and language files
│   ├── css/              # CSS files
│   ├── js/               # JavaScript files
│   └── views/            # Blade templates
├── routes/               # Route definitions
├── storage/              # Application storage
└── tests/                # Automated tests
```

## Database Schema

### Users Table
- id (primary key)
- name
- email
- password
- email_verified_at
- remember_token
- timestamps

### Opportunities Table
- id (primary key)
- title
- description
- location
- start_date
- end_date
- organization_id (foreign key to users table)
- timestamps

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL or compatible database

### Setup Instructions

1. Clone the repository
   ```bash
   git clone https://github.com/yourusername/civic-volunteer-platform.git
   cd civic-volunteer-platform
   ```

2. Install PHP dependencies
   ```bash
   composer install
   ```

3. Install JavaScript dependencies
   ```bash
   npm install
   ```

4. Create and configure environment file
   ```bash
   cp .env.example .env
   ```
   Then edit the `.env` file to set your database credentials and other configuration options.

5. Generate application key
   ```bash
   php artisan key:generate
   ```

6. Run database migrations
   ```bash
   php artisan migrate
   ```

7. Build frontend assets
   ```bash
   npm run build
   ```

8. Start the development server
   ```bash
   php artisan serve
   ```

9. Visit `http://localhost:8000` in your browser

## Development

### Running the Development Server

```bash
# Start the Laravel development server
php artisan serve

# In a separate terminal, start Vite for frontend asset compilation
npm run dev
```

### Running Tests

```bash
php artisan test
```

## Roadmap

- User role management (Admin, Organization, Volunteer)
- Volunteer application and tracking system
- Search and filter functionality for opportunities
- Notifications system
- Reporting and analytics dashboard
- Mobile-responsive design improvements

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.
