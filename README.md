# E-commerce Laravel Application

## Project Overview

This repository implements a full e-commerce application using Laravel 12 and PHP 8.2. It is built with a clean modular architecture that separates feature areas into modules for `Category`, `SubCategory`, `Product`, and `Cart`.

The application supports an interactive shopping experience using Livewire, a Filament admin product management dashboard, and user account management, including localization support for English and Arabic.

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
- Vite frontend build with Tailwind CSS and Alpine.js
- Laravel Breeze-style authentication scaffolding with Livewire profile updates
- Composer scripts for setup, development, and testing

---

## Main Features by Module

### Category Module

- Route: `/categories`
- Livewire component: `Modules\Category\App\Livewire\CategoryList`
- Category search and list display
- Uses `Modules\Category\App\Models\Category`

### SubCategory Module

- Route: `/categories/{category}/subcategories`
- Livewire component: `Modules\SubCategory\App\Livewire\SubCategoryList`
- Lists subcategories for a selected category
- Search filtering for subcategories
- Uses `Modules\SubCategory\App\Models\SubCategory`

### Product Module

- Routes:
  - `/subcategories/{subCategory}/products`
  - `/products/{product}`
- Livewire components:
  - `Modules\Product\App\Livewire\ProductList`
  - `Modules\Product\App\Livewire\ProductShow`
- Product search and add-to-cart functionality
- Quantity controls for product ordering
- Product detail view with related category/subcategory display
- Uses `Modules\Product\App\Models\Product` and `Modules\Product\App\Models\Image`

### Cart Module

- Routes:
  - `/shop`
  - `/shop/checkout`
  - `/shop/orders`
- Livewire components:
  - `Modules\Cart\App\Livewire\Shop`
  - `Modules\Cart\App\Livewire\Checkout`
  - `Modules\Cart\App\Livewire\Orders`
- Cart persistence in session
- Total price calculation for cart contents
- Quantity update, item removal, and cart clearing
- Checkout process that writes `Order` and `OrderItem` records
- Order history retrieval for the authenticated user

### Filament Admin

- Product admin resource: `App\Filament\Resources\ProductResource`
- Admin pages for listing, creating, editing, and bulk deleting products
- Form controls for product name, price, description, quantity, subcategory selection, and image URL
- Table columns for product name, price, quantity, and subcategory name

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

### Relationships

- `Category` has many `SubCategory`
- `SubCategory` belongs to `Category`
- `Product` belongs to `SubCategory`
- `Product` has many `Image`
- `Order` belongs to `User`
- `Order` has many `OrderItem`
- `OrderItem` belongs to `Product`

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

## Development Scripts

- `composer setup` - full install, environment file creation, migration, and frontend build
- `npm run dev` - start Vite development server
- `composer test` - run application tests

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

---

## Developer Notes

- The cart is stored in session and synchronized across Livewire components.
- Checkout uses `Order` and `OrderItem` models and persists orders for authenticated users.
- Product data is maintained via Filament admin CRUD for easy backend management.
- Module-based structure isolates features and makes scaling easier.
- Search is implemented at the category, subcategory, and product levels.

---

## License

This project is released under the MIT License.
