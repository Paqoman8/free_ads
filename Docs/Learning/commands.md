# Here are the commands to create your Laravel project and set up the database.

## 1. Create a new Laravel project
```bash
composer create-project laravel/laravel freeads
```
OR
```bash
composer create-project --prefer-dist laravel/laravel free_ads
```
This command uses Composer to download and install a fresh Laravel installation into a directory named freeads


## 2. Navigate to the Project Directory
```bash
cd freeads
```
Moves your terminal session into the newly created project folder.

## 3.Create the MySQL Database
```bash
mysql -u root -e "CREATE DATABASE freeads;"
```
Creates a new empty database named freeads. If your MySQL root user has a password, add -p to the command (e.g., mysql -u root -p -e ...) and enter it when prompted.

## 4. Start the Development Server (Optional check)
```bash
php artisan serve
```
Starts a local development server at http://localhost:8000 to verify the installation works.