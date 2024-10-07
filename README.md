## Environment Setup for Laravel (PHP, Nginx, Laravel, MySql, phpMyAdmin) using Docker

### Project Structure

- `docker` - Folder for all configuration files for docker and other services
    - `nginx` - Folder for nginx configuration files
    - `php` - Folder for php configuration files
- `docs` - Postman collections are there
- `src` - Folder where the project code will be stored
- `scripts` - Git hook supporting conventional commits and matching setup script
- `docker-compose.yml` - Docker compose configuration file
- `setenv.sh` - Script for creating .env file

### Step-by-Step Guide

#### 1. Build the Project Using Docker Compose

- Run this command
  ```
  docker compose build
  ```

#### 2. Setup project environment and dependencies

- Run `setenv.sh` from the root folder to create .env file. should appear in `src` folder with updated database connection data.

- Install Composer packages (`vendor` folder should appear in `src` folder):
  ```
  docker compose run --rm composer install
  ```
- Setup conventional commits support, from the `scripts/hooks` folder run
  ```
  setup.sh
  ```

#### 3. Run migrations and seeders to add some exemplary data
  ```
  docker compose run --rm artisan migrate
  ```
  ```
  docker compose run --rm artisan db:seed
  ```

Whenever you want to start database tables over (drop and migrate), run this command and seed data afterwards.
  ```
  docker compose run --rm artisan migrate:fresh
  ```

#### 4. Run the project
- Start docker containers (`-d` for detached mode to unblock the terminal)
  ```
  docker compose up -d
  ```
  If you'd like to watch services logs running in the terminal, run without `-d`.

- The project should be available by URL:

  ```
  http://localhost:3000/
  ```

#### Notes

When services started it takes some time (about a minute) to pass health checks and become available.

Folders `mysql`, `nginx-logs` and `phpmyadmin` appear after the first services start. They contain MySQL database files, web server logs and phpMyAdmin installation for convenience.

#### Some useful commands
- To stop services
  ```
  docker compose down
  ```

- To build or start particular service
  ```
  docker compose build <service>
  ```
  ```
  docker compose start <service>
  ```

- Enter the `php` container (`php` is the name of the service from docker-compose.yml)
  ```
  docker compose run --rm php /bin/sh
  ```

- If access Forbidden
  ```
  docker compose run --rm php /bin/sh
  chown -R laravel:laravel /var/www/html
  ```
- To start database tables over (drop and migrate)
  ```
  docker compose run --rm artisan migrate:fresh
  ```
