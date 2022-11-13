# news-parser

## Setup

1. The project uses docker and docker-compose. All environment dependencies will be setup according to the configurations in the (Dockerfile) and (docker-compose.yml)
2. If you don't have docker, you need to install Docker (https://docs.docker.com/get-docker/)

## Run the project
After cloning the project cd into the root directory.
```shell
$ cd news-parser
```
While inside this folder run the command below to start the application.
```shell
$ docker-compose up -d --build
```

Install dependencies
```shell
$ docker-compose exec php composer install
```

Setup migrations
```shell
$ docker-compose exec php symfony console make:migration
```

Load migrations
```shell
$ docker-compose exec php symfony console doctrine:migrations:migrate
```

Add users
```shell
$ docker-compose exec php symfony console doctrine:fixtures:load
```

Start the queue worker
```shell
$ docker-compose exec php symfony console messenger:consume async
```

You are good to go !!

### Access to the running server:
* **URL:** `localhost:8080`

* Administrator credentials
  * **Username:** admin@gmail.com 
  * **Password:** test

* Moderator credentials
    * **Username:** moder@gmail.com
    * **Password:** test
