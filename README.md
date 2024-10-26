<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# SHAMORIES

## Overview

SHAMORIES is a Laravel-based social media platform where users can post updates, follow other users, and interact in a similar fashion to traditional social media applications. It currently excludes a chat feature, focusing instead on streamlined posting and following functionality.

<p align="center">
  <img src="storage/app/public/profile/interface.png" alt="SHAMORIES Interface" width="600">
</p>

## Tech Stack

- **Backend:** Laravel 
- **Database:** MySQL
- **Frontend:** Tailwind CSS, Toastify, Flowbite

## Features

- User registration and authentication
- Profile management
- Posting updates
- Follow/unfollow functionality
- Real-time notifications using Toastify

## Installation

To set up SHAMORIES locally, follow these Laravel standard commands:

1. Clone the repository:
   ```bash
   git clone https://github.com/username/shamories.git
   cd shamories

2. Install dependencies:
composer install
npm install

3. Set up the environment:
cp .env.example .env
php artisan key:generate

Update .env with your MySQL database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

4. Run migrations:
php artisan migrate

5. Start the development server:
php artisan serve
Usage
Register a new account or log in with existing credentials.
Post updates, follow other users, and engage with content on your feed.
Contributing
Contributions are welcome! Please follow these guidelines:

Fork the repository and create a new branch for each feature or bug fix.
Submit pull requests with a clear description of the updates.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
