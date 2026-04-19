# Percetakan - Print Shop Management System

A comprehensive Laravel-based management system for print shop businesses (Percetakan) with point-of-sale, inventory, employee management, and financial tracking capabilities.

## Features

### Authentication & Authorization
- Role-based login system (Admin & Kasir)
- Login role selection at authentication
- Automatic redirect based on user role

### Admin Features
- **Dashboard**: Overview with total transactions, revenue, expenses, and active employees
- **User Management**: Create, edit, delete, and assign roles to users
- **Employee Management**: Full CRUD operations for employee records (name, position, phone, email, hire date, salary, status)
- **Product/Inventory Management**: 
  - Product catalog with SKU, category, stock, pricing
  - Stock In tracking (supplier, reference number)
  - Stock Out tracking (reason, date)
  - Low stock alerts
- **Finance Module**:
  - Income tracking (category, description, amount, status)
  - Expense tracking (category, description, amount, status)
  - Monthly reports
- **Audit Logs**: Complete activity tracking for all database changes

### Kasir Features
- **Dashboard**: Today's transaction count and revenue
- **Transaction Processing**:
  - Create new transactions with multiple items
  - Service type selection (print, photocopy, design, other)
  - Payment method (cash/transfer)
  - Automatic receipt generation

### General Features
- Profile management
- Responsive design
- Transaction receipts with print functionality

## Tech Stack

- **Framework**: Laravel 11
- **Database**: MySQL (phpMyAdmin)
- **Authentication**: Laravel Breeze
- **Role & Permission**: Spatie Permission
- **Frontend**: Tailwind CSS + Blade Templates
- **PHP Version**: 8.3+

## Installation Guide

### Prerequisites
- PHP 8.3+
- Composer
- MySQL
- Node.js (for Tailwind/Vite)

### Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd percetakan
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   ```

4. **Configure database** (in `.env` file)
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=percetakan
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Create database**
   - Open phpMyAdmin
   - Create a new database named `percetakan`

6. **Run migrations & seeders**
   ```bash
   php artisan migrate
   php artisan db:seed --class=UserSeeder
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start the server**
   ```bash
   php artisan serve
   ```

## Default Users

After running the seeder, the following users are available:

| Role  | Email                   | Password   |
|-------|-------------------------|------------|
| Admin | admin@percetakan.com    | 12345678   |
| Kasir | kasir1@percetakan.com   | 12345678   |
| Kasir | kasir2@percetakan.com  | 12345678   |

## System Modules

### Admin Routes
- `/dashboard` - Admin dashboard
- `/dashboard/users` - User management (CRUD)
- `/dashboard/employees` - Employee management (CRUD)
- `/dashboard/products` - Product/inventory management (CRUD + stock operations)
- `/dashboard/finance` - Income/expense tracking & reports
- `/dashboard/audit-logs` - System activity logs

### Kasir Routes
- `/kasir` - Kasir dashboard
- `/kasir/transactions` - Transaction list
- `/kasir/transactions/create` - New transaction
- `/kasir/transactions/{id}/receipt` - Print receipt

## Database Overview

### Core Tables
- `users` - System users with Spatie roles
- `roles` / `permissions` - Role-based access control
- `employees` - Employee records
- `products` - Inventory items
- `stock_ins` / `stock_outs` - Stock movement tracking
- `transactions` - Sales transactions
- `transaction_details` - Transaction line items
- `incomes` / `expenses` - Financial records
- `audit_logs` - Activity logging

## Folder Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── Admin/          # Admin controllers (Dashboard, Users, Employees, Products, Finance, Audit)
│       ├── Auth/            # Authentication controllers
│       └── Kasir/           # Kasir controllers (Transaction)
├── Models/                  # Eloquent models
├── Observers/               # Event observers (Audit logging)
└── Providers/               # Service providers
resources/
└── views/
    ├── admin/              # Admin views
    ├── kasir/              # Kasir views
    └── layouts/            # Layout templates
database/
├── migrations/             # Database migrations
└── seeders/                # Database seeders
routes/
├── web.php                # Main web routes
└── auth.php               # Authentication routes
```

## Screenshots

> Placeholder for system screenshots:
> - Login Page with Role Selection
> - Admin Dashboard
> - Product Management
> - Transaction Form
> - Receipt Preview

## Future Improvements

1. **Payroll System** - Monthly salary calculation and payment tracking
2. **Reports Module** - Advanced analytics and export features
3. **Customer Management** - Customer database and loyalty programs
4. **API Integration** - RESTful API for mobile apps
5. **Notifications** - Low stock alerts and daily reports via email
6. **Multi-branch Support** - Centralized management for multiple locations

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Acknowledgments

- Laravel Framework
- Laravel Breeze for authentication
- Spatie for role-permission management
- Tailwind CSS for styling