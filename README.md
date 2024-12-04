<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://i.ibb.co.com/4MqS4xK/Laravel-Jarvis.png" width="800" alt="Laravel Jarvis"></a></p>

# Screenshots

<p align="center">
<img src="https://i.ibb.co.com/XJ5HL2h/Screenshot-2024-12-04-at-08-01-41.png" alt="Screenshot-2024-12-04-at-08-01-41" width="45%">
<img src="https://i.ibb.co.com/dQzhpk1/Screenshot-2024-12-04-at-08-01-51.png" alt="Screenshot-2024-12-04-at-08-01-51" width="45%">
<img src="https://i.ibb.co.com/WPYTbJJ/Screenshot-2024-12-04-at-08-17-03.png" alt="Screenshot-2024-12-04-at-08-17-03" width="45%">
<img src="https://i.ibb.co.com/gDW1mZ4/Screenshot-2024-12-04-at-08-17-11.png" alt="Screenshot-2024-12-04-at-08-17-11" width="45%">
<img src="https://i.ibb.co.com/kHypgmj/Screenshot-2024-12-04-at-08-17-35.png" alt="Screenshot-2024-12-04-at-08-17-35" width="45%">
<img src="https://i.ibb.co.com/M1LzvYj/Screenshot-2024-12-04-at-08-17-44.png" alt="Screenshot-2024-12-04-at-08-17-44" width="45%">
<img src="https://i.ibb.co.com/zV53sZr/Screenshot-2024-12-04-at-08-17-56.png" alt="Screenshot-2024-12-04-at-08-17-56" width="45%">
<img src="https://i.ibb.co.com/BPw9xdt/Screenshot-2024-12-04-at-08-18-03.png" alt="Screenshot-2024-12-04-at-08-18-03" width="45%">
<img src="https://i.ibb.co.com/QfKXzZW/Screenshot-2024-12-04-at-08-18-11.png" alt="Screenshot-2024-12-04-at-08-18-11" width="45%">
<img src="https://i.ibb.co.com/WtZnr4n/Screenshot-2024-12-04-at-08-18-23.png" alt="Screenshot-2024-12-04-at-08-18-23" width="45%">
<img src="https://i.ibb.co.com/h2ykpjj/Screenshot-2024-12-04-at-08-18-28.png" alt="Screenshot-2024-12-04-at-08-18-28" width="45%">
<img src="https://i.ibb.co.com/mRTt0M6/Screenshot-2024-12-04-at-08-18-36.png" alt="Screenshot-2024-12-04-at-08-18-36" width="45%">
<img src="https://i.ibb.co.com/XxckPzH/Screenshot-2024-12-04-at-08-18-51.png" alt="Screenshot-2024-12-04-at-08-18-51" width="45%">
<img src="https://i.ibb.co.com/tZ4PT3x/Screenshot-2024-12-04-at-08-18-55.png" alt="Screenshot-2024-12-04-at-08-18-55" width="45%">
<img src="https://i.ibb.co.com/W3NJ2rQ/Screenshot-2024-12-04-at-08-19-31.png" alt="Screenshot-2024-12-04-at-08-19-31" width="45%">
<img src="https://i.ibb.co.com/TR0TrJv/Screenshot-2024-12-04-at-08-19-36.png" alt="Screenshot-2024-12-04-at-08-19-36" width="45%">
</p>

## About Jarvis

Laravel Jarvis is a starter project made with Laravel Jetstream Inertia Vue and add more additional feature like User, Role & Permission management, Responsive design, Light/Dark Mode, Rich Table with many features. Check the documentation for more details.

## Features

-   User Authentication.
-   Role and Permission Management.
-   Localization (Currently, English, Bahasa Indonesia).
-   Dark/Light Mode Support.
-   Appliation Settings.
-   Acitivity Log
-   Responsive Design
-   Modal Form
-   Bulk Action
-   Toast Notification
-   Toooltip
-   SSR (Server Side Rendering)
-   Rich Feature Server Side Datatable

# Requirements

-   Php 8
-   Composer
-   Mysql
-   Apache/Nginx

## Installation and Usage

Clone the git repository

```bash
git clone https://github.com/erikwibowo/Laravel-Jarvis.git
```

Go to the folder

```bash
cd Laravel-Jarvis
```

Install and Update composer dependencies

```bash
composer update
```

Install npm dependencies

```bash
npm install
```

Copy .env.example and raname it to .env

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Link storage

```bash
php artisan storage:link
```

SETTING UP DB CONNECTION IN .env

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jarvis
DB_USERNAME=root
DB_PASSWORD=
```

SETTING UP EMAIL for Email Verification
 Or disable verification email. <a target="_blank" href="https://laravel.com/docs/10.x/verification">Read more</a>

```bash
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

Migrate Database with fresh seed

```bash
php artisan migrate:fresh --seed
```

Start the NPM server

```bash
npm run dev
```

Start the Laravel Developement Server

```bash
php artisan serve
```

## Login With

### Superadmin

```bash
email : superadmin@superadmin.com
password : superadmin
```

### Admin

```bash
email : admin@admin.com
password : admin
```

### Operator

```bash
email : operator@operator.com
password : operator
```

# Packages

-   [Vue](https://vuejs.org/)
-   [Inertia](https://inertiajs.com/)
-   [Tailwind](https://tailwindcss.com/)
-   [Spatie](https://spatie.be/docs/laravel-permission/v5/introduction)
-   [Floating Vue](https://floating-vue.starpad.dev/)
-   [VueUse](https://vueuse.org/)
-   [Hero Icons](https://heroicons.com/)
-   [HeadlessUI](https://headlessui.com/)


# License

Laravel Jarvis is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Built With

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
