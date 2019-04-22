# Lumen Web Service for CRUD Event App

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## How to deploy This Project
1. Clone this project to htdocs directory
2. Create .env file from .env.example and set your database configuration
3. Run command below :
``` bash
# install dependencies
$ composer update

# run the migration
$ php artisan migrate

# to serve this project in port 8000
$ php -S localhost:8000 -t public
```
## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
