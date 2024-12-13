## Table of contents

- [Introduction](#Introduction)
- [Features](#Features)
- [Requirements](#Requirements)
- [Installation](#Installation)

## Introduction

A Simple [Laravel](https://laravel.com) authentication and authorization App.

## Features

- Authentication (JWT-token)
- Authorization (RBAC - Role Based Access Control)

## Requirements

- PHP version 8.0 or higher.
- Composer.
- MySql.


## Installation

- To install this project and run it locally, clone the project on github or download the zip file, navigate to the root directory and run `composer install` to install the required packages. Then follow the step by step guide.

- Copy the example environment file to create your own environment file.
 `cp .env.example .env`

- Generate a new application key.
    `php artisan key:generate`

- Generate jwt secret.
`php artisan jwt:secret`

- Open .env and set up your database and other environment variables (mail)
    ```
        DB_CONNECTION=mysql
        DB_HOST=db_ip_address
        DB_PORT=db_port_number
        DB_DATABASE=database_name
        DB_USERNAME=database_username
        DB_PASSWORD=database_password

    ```

- Apply the database migrations for other tables.
    `php artisan migrate`

    `php artisan db:seed`

- Start the Laravel development server.
    `php artisan serve`





