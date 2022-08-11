# Hr-helper

## Description:

Hr-helper is a graduation task in course "PHP-developer" created by [BDA](https://baikaldigitalacademy.ru/).
It's a CRM system for HRs. It can simplify process of structuring and preparing CVs.

## Requirements:

- MariaDB v10.4.17+ 
- Laravel 8+
- PHP 7.4+
- node 14.20.0+
- npm v7+

## Contributors:

- [Kirill](https://github.com/kirilltobola).
- [Maxim](https://github.com/zindmax).
- [Mihail](https://github.com/bluffyaloha).

## How to install and run:

First you have to configure MySQL and create database for application.

Then create `.env` file:

```
cp .env.example .env
```

Define database name in created `.env` file:

```
DB_DATABASE={YOUR_DATABASE}
```

Then generate applicatino key and run migrations:

```
php artisan key:generate
php artisan migrate:fresh --seed
```

## Useful links:

- [Mind map](https://coggle.it/diagram/YU2458XUaSh-OK).
- [Functional map](https://coggle.it/diagram/YU75JcXUaUMXqS).
- [User flow](https://coggle.it/diagram/YU78WmWJes-0Pt).
