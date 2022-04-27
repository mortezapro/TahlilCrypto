# Laravel Starter Kit (based on Laravel 8.*)
**Laravel Starter Kit** is a Laravel 8.x based simple starter project for backend. Most of the commonly needed features of an application like Authentication, User and Role management, Permission Management, Application Backend, User Activity log are available here.

Please let me know your feedback and comments.

# Reporting a Vulnerability
If you discover any security related issues, please send an e-mail to Morteza Goodarzi via goodarzi.morteza73@gmail.com instead of using the issue tracker.

# Custom Commands

We have created a number of custom commands for the project. The commands are listed below with a brief about the use of it.

### Make Repository

`php artisan make:repository RepositoryName --directory=YOUR_DIR --model=YOUR_MODEL`

this command generate two file. a repository file and an Interface of repository into app/repositories/YOUR_DIR
all repository extends base repository and all interface implement baseInterface. so Repetitive methods like Get,Save,Delete,Update,Count,Truncate, ... placed into base repository and you don't need to redefine them.

All repository methods use cache (By Default: Redis) To improve the performance of the project.

### Make Service

`php artisan make:service ServiceName --directory=YOUR_DIR --model=YOUR_MODEL`
this command generate a file into app/services/YOUR_DIR
so most common methods like CRUD Operation are available in your service file. Of course the service use the repository for communicate to database on this project.

### Make controller.service

`php artisan make:controler.service ControllerName 
this command generate a controller into app/http/controller with the most common methods like CRUD operation.

# Features

The Laravel Starter comes with a number of features which are the most common in almost all the applications. It is a template project which means it is intended to build in a way that it can be used for other projects.

# Core Features

* User Authentication (laravel breeze)
* Authorization (Role-Permission , UserPermission)
  * custom directive for Authorization (like @role("roleName"))
* Dynamic Menu System
* custom Theme
* Article Service
  * Posts
  * Categories
  * Tags
  * Comments
* Application Settings
* External Libraries
  * Redis
* User Activity Log

# installation

Follow the steps mentioned below to install and run the project.
1. Clone or download the repository
2. Go to the project directory and run `composer install`
3. Create `.env` file by copying the `.env.example`. You may use the command to do that `cp .env.example .env`
4. Update the database name and credentials in `.env` file
5. Run the command `php artisan migrate --seed`
6. Link storage directory: `php artisan storage:link`
7. You may create a virtualhost entry to access the application or run `php artisan serve` from the project root and visit `http://127.0.0.1:8000`
