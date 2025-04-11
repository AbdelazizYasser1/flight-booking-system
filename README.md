# ✈️ Flight Booking System (Laravel)

A backend-focused **flight reservation system** built with **Laravel 12**.  
This project provides essential APIs for booking flights, managing reservations, and processing payments.

## 🌐 Overview

This project offers a backend API for a **flight reservation system**, where users can:
- Search for available flights
- Reserve tickets
- Manage their bookings

Admins can:
- Add/edit/delete flights
- View and manage all reservations
- Manage users

---

## 🔧 Features

### 👤 Users
- User registration and login
- Search flights by destination, date, and time
- Reserve flights and manage seat selection
- View, edit, or cancel reservations
- Payment gateway integration (Stripe, PayPal, etc.)

### 🛫 Admin Panel (API-based)
- Manage flight schedules (Create, Update, Delete)
- View and manage all bookings
- Manage registered users

---

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.x)
- **Database**: MySQL
- **Authentication**: Sanctum
- 
---

## 🚀 Getting Started

To run this project locally, follow these steps:

```bash
# 1. Clone the repo
git clone https://github.com/AbdelazizYasser1/flight-booking-system.git

# 2. Move to project directory
cd flight-booking-system

# 3. Install dependencies
composer install

# 4. Create environment file
cp .env.example .env

# 5. Generate app key
php artisan key:generate

# 6. Set your DB credentials inside .env file

# 7. Run migrations and seeders (if any)
php artisan migrate --seed

# 8. Serve the API
php artisan serve
