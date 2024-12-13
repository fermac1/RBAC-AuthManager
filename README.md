## Table of contents

- [Introduction](#Introduction)
- [Features](#Features)
- [Requirements](#Requirements)
- [Explanation](#Explanation)
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

## Explanation

This section contains an explanation of the tools used in this project.

- **Laravel Framework** <br/>
 Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).<br/>

- **MySQL as the Database** <br/>
 MySQL is faster, and more widely used..

- **EloquentORM as the ORM Library** <br/>
  [EloquentORM](https://laravel.com/docs/eloquent) is built for Laravel and is recommended when using Laravel.


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





