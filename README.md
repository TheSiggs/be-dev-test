# Backend Test

## Overview
This is a Laravel-based web application designed to provide a robust and scalable backend for web and API-driven applications.
The project follows best practices in Laravel development, making use of MVC architecture, Eloquent ORM, and artisan commands for efficient workflow management.

## Features
- Authentication & Authorization
- RESTful API endpoints
- Database migrations & seeders
- Easy setup with Make
- Postman and HTTP collection to document API endpoints

## Prerequisites
To run this project locally, ensure you have the following installed:

- PHP >= 8.2
- Composer
- Laravel >= 11
- MySQL 
- Node.js & npm 
- CMake

## Installation
### With Makefile
1. Clone the repository:
   ```sh
   git clone git@github.com:TheSiggs/be-dev-test.git
   cd be-dev-test
   ```
2. Run `make start` - this will build the docker containers and run the migrations

3. Run `make import-data` to import the customer data into the db 

You can also run `make` to get the list of make targets you can run and what they do
### With PHP
1. Clone the repository:
   ```sh
   git clone git@github.com:TheSiggs/be-dev-test.git
   cd be-dev-test
   ```

2. Install dependencies:
   ```sh
   composer install
   npm install
   ```

3. Copy the environment file and configure your settings:
   ```sh
   cp .env.sample .env
   ```
   Update `.env` with database and other required credentials.

4. Generate application key:
   ```sh
   php artisan key:generate
   ```

5. Run migrations and seed the database:
   ```sh
   php artisan migrate --seed
   ```

6. Start the development server:
   ```sh
   php artisan serve
   ```

### With Nix Flakes
If you have nixos and nix flakes enabled you can do the following to set up a 
dev environment

With direnv:
- `cp .envrc.sample .envrc`
- `direnv allow`
Nix should install all the necessary dependencies

Without direnv:
- `nix develop`
Nix should install all the necessary dependencies

## Testing
To run unit and feature tests:
```sh
php artisan test
```

## Deployment
1. Set up the production server with the required dependencies.
2. Pull the latest changes and install dependencies.
3. Run migrations.
4. Configure a web server like Nginx or Apache to serve the application.

## TODO:
- Add tests
- Add authenication on the front end
- Improve accessibility 
- Add timestamps to customer migration script
- Use Swagger to document API
