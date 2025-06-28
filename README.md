# Task Manager

A task management web application built with Laravel 12, Inertia.js, Vue.js 3, and Tailwind CSS.

## Features

- **Task Management**: Create, edit, update, and delete tasks
- **Categories**: Organize tasks with custom categories
- **Task Status**: Track progress (Pending, In Progress, Completed)
- **Authentication**: User system with Laravel Breeze
- **Modern Interface**: Responsive design with Tailwind CSS
- **SPA Experience**: Smooth navigation with Inertia.js and Vue.js

## Technologies Used

### Backend
- **Laravel 12** - PHP Framework
- **PHP 8.2+** - Programming Language
- **SQLite** - Database
- **Laravel Sanctum** - API Authentication
- **Inertia.js Laravel** - Server-side adapter

### Frontend
- **Vue.js 3** - JavaScript Framework
- **Inertia.js Vue** - Client-side adapter
- **Tailwind CSS** - Styling Framework
- **Vite** - Build Tool

### Testing
- **Pest PHP** - Testing Framework
- **PHPUnit** - Unit Testing

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- SQLite (included with PHP)

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd task-manager
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Configure environment file**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Configure database**
   
   The project uses SQLite by default. Make sure your `.env` file contains:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

7. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

8. **Build assets**
   ```bash
   npm run build
   ```

## Usage

### Development

1. **Start Laravel server**
   ```bash
   php artisan serve
   ```

2. **Start Vite development server (in another terminal)**
   ```bash
   npm run dev
   ```

3. **Access the application**
   
   Visit `http://localhost:8000` in your browser

### Production

```bash
npm run build
php artisan serve --env=production
```

## Database Structure

### Main Tables

#### Users
- `id` - Unique identifier
- `name` - User name
- `email` - Email address
- `password` - Encrypted password
- `timestamps` - Creation and update dates

#### Categories
- `id` - Unique identifier
- `name` - Category name
- `timestamps` - Creation and update dates

#### Tasks
- `id` - Unique identifier
- `user_id` - Reference to the owner user
- `category_id` - Reference to category (optional)
- `title` - Task title
- `description` - Detailed description (optional)
- `status` - Task status (pending, in_progress, completed)
- `timestamps` - Creation and update dates

## Functionality

### User Management
- New user registration
- User login
- Editable user profile
- User logout

### Category Management
- Create new categories
- Edit existing categories
- Delete categories
- List all categories

### Task Management
- Create tasks with title and description
- Assign categories to tasks
- Change task status:
  - **Pending**
  - **In Progress**
  - **Completed**
- Edit existing tasks
- Delete tasks
- Filter tasks by status and category

## Testing

Run all tests:
```bash
php artisan test
```

Run specific tests:
```bash
php artisan test --filter TaskTest
php artisan test --filter CategoryTest
```

Run tests with coverage:
```bash
php artisan test --coverage
```

## Project Structure

```
task-manager/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Eloquent Models
│   └── ...
├── database/
│   ├── migrations/          # Database migrations
│   ├── seeders/            # Test data
│   └── database.sqlite     # SQLite database
├── resources/
│   ├── js/
│   │   ├── Components/     # Reusable Vue components
│   │   ├── Layouts/        # Application layouts
│   │   └── Pages/          # Vue pages
│   ├── css/               # CSS styles
│   └── views/             # Blade templates
├── routes/
│   ├── web.php            # Web routes
│   └── auth.php           # Authentication routes
├── tests/
│   ├── Feature/           # Feature tests
│   └── Unit/              # Unit tests
└── ...
```

## Security

- Session-based authentication with Laravel Breeze
- CSRF protection on all forms
- Server-side data validation
- User-level authorization for tasks and categories

## License

This project is licensed under the MIT License. See the `LICENSE` file for more details.

## Author

Developed by Jose Aponte

---

**Thank you for using Task Manager!** 🎉
