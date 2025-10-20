# Laravel Blade Admin Panel - Starter Template

A ready-to-use Laravel admin panel with pre-built CRUD operations. Clone and start building your next project in minutes!

## Features

- **Dashboard** - Overview with statistics and quick access
- **Location Management** - Countries, States, and Cities with relationships
- **User Management** - Complete user CRUD with authentication
- **Role Management** - Role-based access control using Spatie Permissions
- **Media Library** - File and image upload management
- **Settings** - Application configuration

## Tech Stack

- Laravel (PHP Framework)
- Blade Templates
- Bootstrap 5
- MySQL Database
- Spatie Laravel Permission

## Installation

### 1. Clone the Repository

```bash
git clone <your-repository-url>
cd <project-folder>
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with database credentials:
```
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Database Migration

```bash
php artisan migrate
```

### 5. Storage Link (Important)

Create symbolic link for file uploads:
```bash
php artisan storage:link
```

### 6. Seed Database (Optional)

```bash
php artisan db:seed
```

### 7. Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Default Credentials

After seeding (if applicable):
- **Email:** superadmin@example.com
- **Password:** password

## Included Modules

| Module | Description |
|--------|-------------|
| Dashboard | Main overview page |
| Countries | Country management |
| States | State management (linked to countries) |
| Cities | City management (linked to states) |
| Users | User CRUD with authentication |
| Roles | Role-based permissions (Spatie) |
| Media | File upload and management |
| Settings | Application settings |

## Usage

This template is designed to be cloned for new projects. Simply:

1. Clone the repository
2. Follow installation steps
3. Start building your custom features
4. Modify or remove existing modules as needed

## Important Notes

- **Storage Link:** Always run `php artisan storage:link` after cloning
- **File Uploads:** Ensure `storage/app/public` directory has proper write permissions

## License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues or questions, please open an issue in the repository.
