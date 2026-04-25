# E-commerce Laravel Application

## Project Overview

This repository implements a full e-commerce application using Laravel 12 and PHP 8.2. It is built with a clean modular architecture that separates feature areas into modules for `Category`, `SubCategory`, `Product`, `Cart`, and `Frontend`.

The application implements a clean **modular architecture**, separating business domains into independent modules: Category, SubCategory, Product and Cart. The frontend leverages **Livewire** for reactive UI, while **Filament** provides an admin dashboard for product management.

---

## What This Application Does

### User Perspective

- User registration, login, logout, and email verification
- Profile management including name/email update, password change, and account deletion
- Browse product categories, subcategories, and products
- Search/filter categories, subcategories, and products in real time
- View product details and product images
- Add products to the shopping cart
- Update product quantity inside the cart
- Remove single cart items or clear the entire cart
- Checkout and create orders
- View order history and order details
- Switch language between English and Arabic

### Technical / Programmer Perspective

- Modular code organization using `nwidart/laravel-modules`
- Livewire components for reactive UI behavior
- Filament admin resource for product CRUD management
- PSR-4 autoloading for core app code and module code
- Session-based cart management with calculated totals
- Eloquent relationships linking categories, subcategories, products, images, orders, and order items
- Middleware-protected routes for authenticated and verified users
- Laravel Breeze-style authentication scaffolding with Livewire profile updates
- Composer scripts for setup, development, and testing
  
---

## Data Model and Relationships

### Core Models

- `App\Models\User` - built-in user authentication model
- `App\Models\Order` - order header data, belongs to a user
- `App\Models\OrderItem` - order item entries, belongs to order and product
- `Modules\Category\App\Models\Category` - category data
- `Modules\SubCategory\App\Models\SubCategory` - subcategory data
- `Modules\Product\App\Models\Product` - product catalog entries
- `Modules\Product\App\Models\Image` - product image records

---

## Routes Summary

- `/` - welcome page
- `/lang/{locale}` - language switcher for `en` and `ar`
- `/dashboard` - authenticated dashboard page
- `/profile` - profile edit page
- `/categories` - category browser
- `/categories/{category}/subcategories` - subcategory view
- `/subcategories/{subCategory}/products` - products under subcategory
- `/products/{product}` - product detail page
- `/shop` - shopping cart page
- `/shop/checkout` - checkout page
- `/shop/orders` - order history page
- Filament admin panel routes (standard Filament admin routes for product management)

---

## Installation and Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/abdulrahmanelnory1/E-commerce.git
   cd E-commerce
   ```
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Copy environment variables and generate app key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Update `.env` with database credentials.
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Install frontend dependencies and build assets:
   ```bash
   npm install
   npm run build
   ```
7. Run locally:
   ```bash
   php artisan serve
   ```

---

## Technical Stack

- PHP 8.2
- Laravel 12
- Livewire 4.2
- Filament
- Laravel Modules (`nwidart/laravel-modules`)
- Laravel Modules Livewire
- Tailwind CSS
- Vite
- Alpine.js
- Axios

