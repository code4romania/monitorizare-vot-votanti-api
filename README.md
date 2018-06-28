## Monitorizare Vot Rest API

 Restful API implementation using Laravel 5.3 "Monitorizare Vot" apps.

Main packages:

* JWT-Auth - [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
* Dingo API - [dingo/api](https://github.com/dingo/api)
* Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)

## Requirements

* PHP 7+ (with mbstring, openSSL extensions);
* Apache or Nginx (mod_rewrite required);
* MySQL;

## Installationn

```bash
composer install
-- create database and add the database server configuration to .env file
php artisan key:generate //Not sure if really neccesary
php artisan jwt:generate
php artisan migrate --seed
```

Run the local server with
```bash
php artisan serve
```

Sometimes these folders need to be create manually if the user doesn't have the rights to do so
- /storage/framework/cache
- /storage/framework/sessions
- /storage/framework/views
- /storage/logs


Access http://localhost:8000 or http://localhost:8000/api/check in the browser to test the project

## Project structure
* Controllers in /app/Api/V1/Controllers
* Routing in /app/Http/api_routes.php
* See Laravel and Dingo API documentation for more.
* Also: https://www.sitepoint.com/how-to-build-an-api-only-jwt-powered-laravel-app/

## Main Features

### AuthController

* _login()_;
* _signup()_;
* _recovery()_;
* _reset()_;

You will need:

* _login_: just email and password;
* _signup_: whatever you like: you can specify it in the config file;
* _recovery_: just the user email address;
* _reset_: token, email, password and password confirmation;

### IncidentController Endpoint

* _GET /api/incidents_ ( get last 20 incidents )
* _GET /api/incidents?limit=100_ (Get more incidents)
* _GET /api/incidents?limit=10&page=3+ (limit parameter is optional, will default to 20)
* _GET /api/incidents?status[]=Pending_ (filter by state)
* _GET /api/incidents?status[]=Pending&status[]=Rejected_ (get pending and rejected)
* _POST /api/incidents_ (Create incident)

* _PUT /api/incidents/5/approve_ (Approve incident - ADMIN)
* _PUT /api/incidents/5/reject_ (Reject incident - ADMIN)
* _DELETE /api/incidents/5_ (Delete incident - ADMIN)

### A Separate File for Routes

You can specify your routes in the `api_routes.php` file, that will be automatically loaded. In this file you will find many examples of routes.

### Secrets Generation

Every time you create a new project starting from this repository, the _php artisan jwt:generate_ command will be executed.

## Configuration

As I already told before, this boilerplate is based on _dingo/api_ and _tymondesigns/jwt-auth_ packages. So, you can find many informations about configuration <a href="https://github.com/tymondesigns/jwt-auth/wiki/Configuration" target="_blank">here</a> and <a href="https://github.com/dingo/api/wiki/Configuration">here</a>.

However, there are some extra options that I placed in a _config/boilerplate.php_ file.

* **signup_fields**: you can use this option to specify what fields you want to use to create your user;
* **signup_fields_rules**: you can use this option to specify the rules you want to use for the validator instance in the signup method;
* **signup_token_release**: if "true", an access token will be released from the signup endpoint if everything goes well. Otherwise, you will just get a _201 Created_ response;
* **reset_token_release**: if "true", an access token will be released from the signup endpoint if everything goes well. Otherwise, you will just get a _200_ response;
* **recovery_email_subject**: here you can specify the subject for your recovery data email;

## Creating Endpoints

You can create endpoints in the same way you could to with using the single _dingo/api_ package. You can <a href="https://github.com/dingo/api/wiki/Creating-API-Endpoints" target="_blank">read its documentation</a> for details.

After all, that's just a boilerplate! :)

## Cross Origin Resource Sharing

If you want to enable CORS for a specific route or routes group, you just have to use the _cors_ middleware on them.

Thanks to the _barryvdh/laravel-cors_ package, you can handle CORS easily. Just check <a href="https://github.com/barryvdh/laravel-cors" target="_blank">the docs at this page</a> for more info.
