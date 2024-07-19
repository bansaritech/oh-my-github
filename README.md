## GitHub Helper Project

This project is an open-source GitHub helper built using PHP Laravel and Filament. It provides features to manage personal GitHub repositories.

## Features

Manage GitHub repositories

Scan GitHub profiles

Set and enforce branch limits


## Requirements

PHP 8.0 or higher

Composer

Laravel 8.0 or higher

Filament


## Installation
Step 1: Clone the repository

```
git clone https://github.com/your-username/github-helper.git
```
```
cd github-helper
 ```

Step 2: Install dependencies

``` 
composer install
```

Step 3: Set up the environment

Copy the .env.example file to .env and configure your environment variables:

```
cp .env.example .env
```

Generate an application key:
```
php artisan key:generate
```

Step 4: Configure .env file for the database
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
``` 
Step 5: Set up the database

Run the database migrations:
```
php artisan migrate
```

Step 6: Seed the database 

```
php artisan db:seed
```

Step 7: Run the application

Start the development server:
```
php artisan serve
```


## Contributing

Contributions are welcome! Please fork this repository and submit pull requests.
