# Lem3alam.ma

A comprehensive platform connecting clients with skilled taskers for various services. Built with Laravel 12 and Vue.js/Vite.

## 📋 Prerequisites

- **PHP**: ^8.2
- **Composer**: Latest version
- **Node.js**: LTS version
- **MySQL**: 5.7+ or 8.0+

## 🚀 Installation & Setup

1.  **Clone the repository**
    ```bash
    git clone https://github.com/your-username/m3alam.git
    cd m3alam
    ```

2.  **Install PHP dependencies**
    ```bash
    composer install
    ```

3.  **Install Node.js dependencies**
    ```bash
    npm install
    ```

4.  **Environment Configuration**
    ```bash
    cp .env.example .env
    ```
    - Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`.
    - Ensure `MESSAGING_JWT_SECRET` is set (it should be generated automatically or you can generate a random string).

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Database Setup**
    Run migrations and seed the database with initial data (categories, admin user, test user).
    ```bash
    php artisan migrate --seed
    ```

7.  **Build Frontend Assets**
    ```bash
    npm run build
    ```

8.  **Run the Application**
    ```bash
    php artisan serve
    ```
    Access the application at `http://localhost:8000`.

## 🔑 Default Credentials

### Admin Panel
- **URL**: `/admin/login`
- **Email**: `admin@m3alam.com`
- **Password**: `admin123`

### Test Client User
- **Email**: `test@example.com`
- **Password**: `password`

## 🧪 Running Tests

To run the feature and unit tests:

```bash
php artisan test
```

To run static code analysis (PHPStan):

```bash
composer analyse
```

## 📚 API Documentation

The API documentation is generated using Scribe and can be accessed at `/docs`.

To regenerate the documentation after changes:

```bash
php artisan scribe:generate
```

To view the documentation, start the server (`php artisan serve`) and navigate to:
`http://localhost:8000/docs`

The Postman collection is also generated in `storage/app/private/scribe/collection.json`.

## 🛠 Features

- **User Roles**: Client, Tasker, Admin.
- **Task Management**: Create, browse, and apply for tasks.
- **Real-time Messaging**: Chat between clients and taskers (requires `MESSAGING_JWT_SECRET`).
- **Reviews & Ratings**: Rate taskers and clients.
- **Admin Dashboard**: Manage users, tasks, disputes, and view reports.
- **Localization**: Support for Arabic (ar), French (fr), and English (en).

## 🔒 Security

- **Vulnerabilities**: Run `composer audit` and `npm audit` regularly.
- **Production**: Ensure `APP_DEBUG=false` and `APP_ENV=production` in live environments.
