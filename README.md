# FreeAds

FreeAds is a simple yet functional classified ads platform built with Laravel. It allows users to post, browse, search, and manage advertisements for various items.

## Features

### Authentication & User Management
- **User Registration & Login**: Secure authentication system.
- **Email Verification**: Mandatory email verification flow (using Mailtrap/Log driver for development).
- **Profile Management**: Users can update their username, email, phone number, and password.

### Ads Management
- **Create Ads**: Registered users can post new ads with title, description, price, category, condition, location, and image URL.
- **Browse Ads**: Publicly accessible list of all ads.
- **View Details**: Detailed view for each ad showing seller information and contact details.
- **Edit/Delete**: Users can manage their own ads.
- **Search & Filter**:
  - Search by keywords (title/description).
  - Filter by Category (Electronics, Vehicles, Furniture, etc.).
  - Filter by Price Range (Min/Max).

## Requirements

- PHP >= 8.2
- Composer
- MySQL

## Installation

1.  **Clone the repository** (if applicable) or navigate to the project directory:
    ```bash
    cd freeads
    ```

2.  **Install Dependencies**:
    ```bash
    composer install
    ```

3.  **Environment Configuration**:
    - Copy the example environment file:
      ```bash
      cp .env.example .env
      ```
    - Update the `.env` file with your database credentials:
      ```dotenv
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=freeads
      DB_USERNAME=root
      DB_PASSWORD=root
      ```
    - Configure Mail settings for testing (e.g., using Mailtrap or Log):
      ```dotenv
      MAIL_MAILER=smtp
      MAIL_HOST=sandbox.smtp.mailtrap.io
      MAIL_PORT=2525
      MAIL_USERNAME=your_username
      MAIL_PASSWORD=your_password
      ```

4.  **Generate Application Key**:
    ```bash
    php artisan key:generate
    ```

5.  **Run Migrations**:
    Create the database first if it doesn't exist, then run:
    ```bash
    php artisan migrate
    ```

6.  **Serve the Application**:
    ```bash
    php artisan serve
    ```
    Access the app at [http://localhost:8000](http://localhost:8000).

## Usage

1.  **Register**: Create a new account.
2.  **Verify Email**: Check your configured mail driver (or `storage/logs/laravel.log` if using `log` driver) for the verification link.
3.  **Post an Ad**: Click "Post an Ad" in the navigation bar.
4.  **Manage Profile**: Click "Profile" to edit your details or change your password.

## Project Structure

- **Controllers**: `app/Http/Controllers`
  - `AdController`: Handles CRUD and search for ads.
  - `ProfileController`: Handles user profile updates.
  - `Auth/`: Handles registration, login, and verification.
- **Models**: `app/Models`
  - `User`: User entity with relationships.
  - `Ad`: Ad entity belonging to a User.
- **Views**: `resources/views`
  - `ads/`: Views for listing, creating, and editing ads.
  - `auth/`: Authentication forms.
  - `profile/`: Profile editing form.
  - `layouts/`: Main application layout.
