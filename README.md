# Student Service Bay


## Pre-requisites

- PHP
- Composer
- Node.js
- NPM
- MariaDB [MySQL]

## Installation

Change directory to the project folder

```bash
cd [project folder]
```

Install composer dependencies

```bash
composer install
```

Install npm dependencies

```bash
npm install
```

Create a copy of your .env file

```bash
cp .env.example .env
```

Configure your .env file
Set the application key

```bash
php artisan key:generate
```

Run the database migrations

```bash
php artisan migrate
```

Serve the application

```bash
npm run start
```

Navigate to [http://localhost:8000](http://localhost:8000) in your browser

## Database

MariaDB is used as the database for this project. Create a database and update the .env file with the database name,
username and password.

```env
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## Dummy Data

You can run the following command to seed the database with dummy data.

```bash
php artisan db:seed
```

## Testing
We use PHPUnit for testing. You can run the following command to run the tests.

```bash
php artisan test
```
