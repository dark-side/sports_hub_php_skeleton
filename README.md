# Sports-Hub Application PHP Back-End

## Project Description

This is a draft pet project for testing Generative AI on different software engineering tasks. It is planned to evolve and grow over time. Specifically, this repo will be a PHP playground.

The application's legend is based on the sports-hub application description from the following repo: [Sports-Hub](https://github.com/dark-side/sports-hub).

## Available Front-End applications
- [React.js](https://github.com/dark-side/sports_hub_react_skeleton)
- [Angular](https://github.com/dark-side/sports_hub_angular_skeleton)

## Dependencies

- Docker
- Docker Compose

The mentioned dependencies can be installed using the official documentation [here](https://docs.docker.com/compose/install/).
Read more about alternatives to Docker [here](https://github.com/dark-side/sports_hub_angular_skeleton/blob/main/READMORE_DockerAlternatives.md).

## Project Structure

- `docker` - Folder for all configuration files for docker and other services
    - `nginx` - Folder for nginx configuration files
    - `php` - Folder for php configuration files
- `docs` - Postman collections are there
- `src` - Folder where the project code will be stored
- `scripts` - Git hook supporting conventional commits and matching setup script
- `docker-compose.yml` - Docker compose configuration file
- `setenv.sh` - Script for creating .env file

## Project back-end stack and toolset
It includes Laravel, Nginx, MySql, phpMyAdmin, Docker.

## Step-by-Step setup Guide

### 1. Clone the Repositories

To run the web application with the React front-end, clone the following repositories within the same folder:

```sh
git clone git@github.com:dark-side/sports_hub_php_skeleton.git
git clone git@github.com:dark-side/sports_hub_react_skeleton.git
```

#### 2. Build the Project Using Docker Compose

- Run this command in the root folder of the project
  ```
  docker compose build
  ```

#### 3. Setup project environment and dependencies

- Run `setenv.sh` (`setenv_mac.sh` on Mac) from the root folder to create .env file. should appear in `src` folder with updated database connection data.

- Install Composer packages (`vendor` folder should appear in `src` folder):
  ```
  docker compose run --rm composer install
  ```
- Optionally setup conventional commits support, from the `scripts/hooks` folder run
  ```
  setup.sh
  ```

#### 4. Spin up the services
- Start docker containers (`-d` for detached mode to unblock the terminal)
  ```
  docker compose up -d
  ```
  If you'd like to watch services logs running in the terminal, run without `-d`.

#### 5. Run migrations and seeders to add some exemplary data

From the root folder of the project run
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

### 6. Check the app in browser

The project should be available by URL:
- Mac, Linux - `http://localhost:3000/`
- Windows - `http://127.0.0.1:3000/`

### Running on Windows (Tips & Tricks)

While running the App on Windows 11 using WSL, you may face issues related to Unix-style line endings (especially if you are storing the project(s) under the host machine filesystem, not the WSL one (e.g., the project is cloned to the disc `c:` or any other disk you have instead of being cloned to the WSL filesystem). Working within the WSL filesystem is a best practice when developing on Windows, as it helps prevent line ending and permission issues that can arise when using the Windows filesystem. I'm just reminding you that this will save you time and headaches for future projects.

If you are still reading this, please ensure your host machine converts related script(s) to Unix-style line endings.
```sh
# Install dos2unix if not already installed
sudo apt-get install dos2unix

# Convert all files in the project directory to Unix-style line endings
find . -type f -exec dos2unix {} \;

# Convert one file (example)
dos2unix bin/docker-entrypoint
```
Also, if you face issues with script files not being executable, you can fix it with the following commands:
```sh
# check current permissions on the file
ls -l <name of script file>

# ensure the file is executable
chmod +x <name of script file>
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

- To run tests
  ```
  docker compose run --rm artisan test
  ```
  Unit tests only
  ```
  docker compose run --rm artisan test --testsuite=Unit
  ```

- To delete local branches that are missing on remote and no longer needed, from `scripts` folder run
  ```
  pruneBranches.sh
  ```

## License

Licensed under either of

- [Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0)
- [MIT license](http://opensource.org/licenses/MIT)

Just to let you know, at your option.

## Contribution

Unless you explicitly state otherwise, any contribution intentionally submitted for inclusion in your work, as defined in the Apache-2.0 license, shall be dual licensed as above, without any additional terms or conditions.

**Should you have any suggestions, please create an Issue for this repository**
