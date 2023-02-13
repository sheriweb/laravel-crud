# Larave Crud

## Setup

All environments expects the following dependencies to be installed:
-   [Composer](https://getcomposer.org/), a PHP package manager

Once all the above dependencies are installed, you can proceed with the rest of the setup:

```bash
git clone https://github.com/sheriweb/laravel-crud

composer install
```

You'll then need to setup your environment variables

```bash
cp .env.example .env
```


Run This Commands for Database Tables

```bash
# insert all table into datbase 
php artisan migrate --seed
