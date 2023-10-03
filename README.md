# EZV Test

create and assign task to user, update and delete the todo list

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

## Prerequisites

Before you begin, ensure you have met the following requirements:

- [Laravel Requirements](https://laravel.com/docs/9.x/installation#server-requirements)
- [Composer](https://getcomposer.org/download/)

## Installation

1. Clone the repository:

  ```bash
  git clone  https://github.com/Elfends/EZV_Test.git
  ```

2. Change to the Project Directory:

  ```bash
  cd project-name
  ```

3. Install Composer Dependencies:

  ```bash
  composer install
  ```

4. Create a Copy of the .env File:

  ```bash
  cp .env.example .env
  ```

5. Generate the Application Key:

  ```bash
  php artisan key:generate
  ```

## Configuration
Edit the .env file to configure your application:

* Set the database connection details (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
* Configure other environment-specific settings (e.g., mail, caching, queues).

## Usage
Run Database Migrations and Seed the Database (if applicable):

  ```bash
  php artisan migrate --seed
  ```

## Start the Development Server:

  ```bash
  php artisan serve
  ```

## Access Your API:
You can access your API at http://localhost:8000.

##Testing
To run the PHPUnit tests, use the following command:

  ```bash
  php artisan test
  ```