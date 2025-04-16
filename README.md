# ✈️ Flight Booking API

A RESTful API for managing a complete airline booking system. Built using **Laravel 12 (latest version)**, this API handles everything from flights and passengers to promo codes and facilities. Designed with scalability, security, and clean architecture in mind.

---

## 🚀 Features

- 🔐 User Authentication using Laravel Sanctum
- ✈️ Flight Management (CRUD for Admins)
- 🏢 Airlines & Airports
- 💺 Flight Classes, Seats, and Segments
- 🎟️ Promo Code Validation
- 🧾 Transactions & Passengers
- 🛠️ Facilities Management
- 🧑‍💼 Admin-only routes with middleware protection
- 📦 Well-structured and RESTful endpoints

---

## 🛠 Tech Stack

- PHP 8+
- **Laravel 12**
- MySQL
- Laravel Sanctum (Auth)
- Composer
- Postman (for API testing)

---

## 📦 Installation

```bash
git clone https://github.com/your-username/flight-booking-api.git
cd flight-booking-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
