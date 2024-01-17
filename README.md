# Laravel Custom Authentication Project

This Laravel project demonstrates custom authentication, API integration. The project allows users to view Kanye West quotes on a web page and through an API route.

## Table of Contents

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
  - [Web Page](#web-page)
  - [API Route](#api-route)
- [Authentication](#authentication)
- [Tests](#tests)
- [Contributing](#contributing)
- [License](#license)

## Getting Started

### Prerequisites

Make sure you have the following installed:

- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/)

### Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/amanshr72/laravel-custom-auth.git
    ```

2. **Change into the project directory:**

    ```bash
    cd laravel-custom-auth
    ```

3. **Install dependencies:**

    ```bash
    composer install
    ```

4. **Copy the `.env.example` file to `.env`:**

    ```bash
    cp .env.example .env
    ```

5. **Generate application key:**

    ```bash
    php artisan key:generate
    ```

6. **Set up your database in the `.env` file:**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=your-database-host
    DB_DATABASE=your-database-name
    DB_USERNAME=your-database-username
    DB_PASSWORD=your-database-password
    ```

7. **Run database migrations:**

    ```bash
    php artisan migrate
    ```

8. **Serve the application:**

    ```bash
    php artisan serve
    ```

The application should now be running at `http://localhost:8000`.

## Usage

### Web Page

Access the web page by navigating to [http://localhost:8000](http://localhost:8000) in your browser. You'll be prompted to log in. Use the custom authentication credentials or register a new account.

### API Route

Retrieve random Kanye West quotes using the API route:

- Endpoint: [http://localhost:8000/api/quotes](http://localhost:8000/api/quotes)

**Note:** Ensure you are authenticated to access the API route.

## Authentication

This project uses custom authentication. Users can log in or register to access the web page and API route.

- **Login:**
  - Endpoint: [http://localhost:8000/login](http://localhost:8000/login)

- **Registration:**
  - Endpoint: [http://localhost:8000/register](http://localhost:8000/register)

## Tests

Run tests using the following command:

```bash
php artisan test
