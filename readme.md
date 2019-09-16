# Articulate: Your simple Articles API

Articulate is a simple Articles API created with Laravel Lumen; One of the worlds fastest and lightweight web development frameworks.

This project was developed by William-Sear O. Odiomonafe as a technical interview test for the role of a Senior Applications Engineer for Clane Bank.

In this app, the following were implemented

- [Authentication](https://laravel.com/docs/6.0/authentication)
- API
  - Token authentication (Using Firebase JWT)
  - [API Resources](https://laravel.com/docs/6.0/eloquent-resources)
- [Migrations](https://laravel.com/docs/6.0/migrations)
- [Providers](https://laravel.com/docs/6.0/providers)
- [Requests](https://laravel.com/docs/6.0/validation#form-request-validation)
- [Seeding & Factories](https://laravel.com/docs/6.0/seeding)
- [Testing](https://laravel.com/docs/6.0/testing)

## Installation
### Via Local Server
- Clone app from the git repo into your web server
- Run "php artisan migrate" command to run all migrations
- Optionally, you can import seed data by running this command "php artisan db:seed"
- Run tests via command /vendor/bin/phpunit. 
NOTE: Some secured endpoints tests may fail
- Use POSTMAN or any other RESTful Client to send CRUD requests via the endpoints specified below.


## Documentation
- https://documenter.getpostman.com/view/4646057/SVmtzzvK


#### Endpoints
```yml
Create an article (Secured)
[POST] /articles

Keys: {title} string, {body} string, {published} boolean
Token can be passed as a {key} POST value or as Header values 

List all articles
[GET] /articles

Get an Article
[GET] /articles/{id}
URL Parameter: {id} numeric

Delete an Article (Secured)
[DELETE] /articles/{id}
URL Parameter: {id} numeric

Update an Article (Secured)
[PUT] /articles/{id}
URL Parameter: {id} numeric
Key: {title} string, {body} string, {published} string, {token} string

Post Rating
[POST] /articles/{id}/rating
URL Parameter: {id}
Key: {rating} numeric between 1 -10
```




### Using Docker
Development environment requirements :
- [Docker](https://www.docker.com)
- [Docker Compose](https://docs.docker.com/compose/install/)

Setting up your development environment on your local machine :
```bash
$ git clone https://github.com/williamodiomonafe/articulate-api.git
$ cd articulate-api
$ cp .env.example .env
$ docker-compose run --rm --no-deps articulate-api composer update
$ docker-compose run --rm --no-deps articulate-api php artisan key:generate
$ docker run --rm -it -v $(pwd):/app -w /app node yarn
$ docker-compose up -d
```

Now you can access the application via [http://localhost:8000](http://localhost:8000).

**There is no need to run ```php artisan serve```. PHP is already running in a dedicated container.**

## Before starting
You need to run the migrations:
```bash
$ docker-compose run --rm articulate-api php artisan migrate
```

Next, you need to run the database seed data:
```bash
$ docker-compose run --rm articulate-api php artisan db:seed
```


This will create a new user that you can use to sign in :
```yml
email: william@clane.com
password: secret
```

## Useful commands
Running tests :
```bash
$ docker-compose run --rm articulate-api ./vendor/bin/phpunit
```

Running php-cs-fixer :
```bash
$ docker-compose run --rm --no-deps articulate-api ./vendor/bin/php-cs-fixer fix --config=.php_cs --verbose --dry-run --diff
```

Generating fake data :
```bash
$ docker-compose run --rm articulate-api php artisan db:seed --class=ArticlesTableSeeder
```

In development environnement, rebuild the database :
```bash
$ docker-compose run --rm articulate-api php artisan migrate:fresh --seed
```

## Accessing the API

Clients can access to the REST API. API requests to CREATE, UPDATE AND DELETE articles require authentication via token. You can create a new token upon successful login.

```yml
Create an article
[POST] /articles/
```


API routes includes :

```bash
$ docker-compose run --rm --no-deps articulate-api php artisan route:list --path=api
```