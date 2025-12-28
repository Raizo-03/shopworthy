# 🛒 ShopWorthy

A modern, full-stack ecommerce application built with Laravel and Vue. js. 

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-3.5-4FC08D?style=flat&logo=vue.js)](https://vuejs.org)
[![Inertia.js](https://img.shields.io/badge/Inertia.js-2.2-9553E9?style=flat)](https://inertiajs.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.0-38B2AC?style=flat&logo=tailwind-css)](https://tailwindcss.com)

## 📋 Overview

ShopWorthy is a production-ready ecommerce platform that combines the power of Laravel's robust backend with Vue.js's reactive frontend, connected seamlessly through Inertia.js. The application delivers a smooth, single-page application experience with server-side routing. 

## ✨ Features

- 🛍️ **Complete Ecommerce Functionality**
  - Product catalog with search and filtering
  - Shopping cart and checkout process
  - Order management
  - User authentication and profiles

- 🎨 **Modern Frontend**
  - Vue.js 3 with Composition API
  - Inertia.js for seamless SPA experience
  - TailwindCSS 4.0 for responsive design
  - Vite for lightning-fast builds

- 🔧 **Robust Backend**
  - Laravel 12 framework
  - RESTful API architecture
  - MySQL database
  - Queue processing support

## 🛠️ Tech Stack

### Backend
- **Framework:** Laravel 12.x
- **Language:** PHP 8.2+
- **Database:** MySQL
- **Queue:** Laravel Queue
- **Testing:** PHPUnit

### Frontend
- **Framework:** Vue.js 3.5
- **Bridge:** Inertia.js 2.2
- **Styling:** TailwindCSS 4.0
- **Build Tool:** Vite 7.0
- **HTTP Client:** Axios

## 📦 Prerequisites

Before you begin, ensure you have the following installed:

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- npm or yarn
- MySQL >= 8.0
- Git

## 🚀 Getting Started

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Raizo-03/shopworthy.git
   cd shopworthy
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure your database**
   
   Edit your `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=shopworthy
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Build frontend assets**
   ```bash
   npm run build
   ```

### Quick Setup

Alternatively, use the automated setup script:
```bash
composer setup
```

This will:
- Install PHP dependencies
- Copy environment file
- Generate application key
- Run database migrations
- Install Node dependencies
- Build frontend assets

## 🏃 Running the Application

### Development Mode

Start all development services concurrently:
```bash
composer dev
```

This starts:
- Laravel development server (http://localhost:8000)
- Queue worker
- Laravel Pail (log viewer)
- Vite dev server (HMR)

### Individual Services

You can also run services individually: 

```bash
# Backend server
php artisan serve

# Frontend dev server (with HMR)
npm run dev

# Queue worker
php artisan queue:listen

# Log viewer
php artisan pail
```

## 🧪 Testing

Run the test suite: 
```bash
composer test
```

Or directly with PHPUnit: 
```bash
php artisan test
```

## 📁 Project Structure

```
shopworthy/
├── app/                    # Application core
│   ├── Http/              # Controllers, Middleware
│   ├── Models/            # Eloquent models
│   └── Services/          # Business logic
├── bootstrap/             # Framework bootstrap
├── config/                # Configuration files
├── database/              # Migrations, seeders, factories
├── public/                # Public assets
├── resources/             # Views, Vue components, CSS
│   ├── js/               # Vue. js components
│   └── views/            # Blade templates
├── routes/                # Route definitions
├── storage/               # Logs, cache, uploads
├── tests/                 # Test suites
├── . env. example          # Environment template
├── composer.json         # PHP dependencies
├── package.json          # Node dependencies
├── vite.config.js        # Vite configuration
└── artisan               # Laravel CLI
```

## 🔐 Environment Variables

Key environment variables to configure:

```env
APP_NAME=ShopWorthy
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shopworthy
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=sync
```

## 📚 Documentation

- [Laravel Documentation](https://laravel.com/docs/12.x)
- [Vue.js Documentation](https://vuejs.org/guide/)
- [Inertia. js Documentation](https://inertiajs.com/)
- [TailwindCSS Documentation](https://tailwindcss.com/docs)

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request. 

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

## 👤 Author

**Raizo-03**

- GitHub: [@Raizo-03](https://github.com/Raizo-03)
