# Quiz Backend API

A powerful API backend to make our quiz app work using best practices, in a scalable way.
The API is GraphQL ready, ElasticSearch ready, with support for JSON, JSON hydra.

Live version available here: [quizz-api.xtipper.com/api](https://quizz-api.xtipper.com/api)
Frontend application is available here: [quizz.xtipper.com](https://quizz.xtipper.com)

To understand the entire architecture and step by step guide behind this project, [please follow this blog post](https://edouardkombo.wordpress.com/2023/09/04/quiz-application-using-api-platform-vuejs-3/)

## Installation

1. Create a `.env` file at the root of the project, and replace the placeholders with your own credentials
```
# In all environments, the following files are loaded if they exist,
# the latter taking precedence over the former:
#
#  * .env                contains default values for the environment variables needed by the app
#  * .env.local          uncommitted file with local overrides
#  * .env.$APP_ENV       committed environment-specific defaults
#  * .env.$APP_ENV.local uncommitted environment-specific overrides
#
# Real environment variables win over .env files.
#
# DO NOT DEFINE PRODUCTION SECRETS IN THIS FILE NOR IN ANY OTHER COMMITTED FILES.
# https://symfony.com/doc/current/configuration/secrets.html
#
# Run "composer dump-env prod" to compile .env files for production use (requires symfony/flex >=1.2).
# https://symfony.com/doc/current/best_practices.html#use-environment-variables-for-infrastructure-configuration

###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=5daa2084ade944054653163da1e87ef7
###< symfony/framework-bundle ###

###> doctrine/doctrine-bundle ###
# Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
#
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
# DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"
DATABASE_URL="mysql://__MYSQL_USER__:__MYSQL_PASSWORD__@127.0.0.1:3306/__MYSQL_DATABASE__?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
#DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"
###< doctrine/doctrine-bundle ###

###> nelmio/cors-bundle ###
CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'
###< nelmio/cors-bundle ###
```

2. Copy the nginx file `nginx_quiz-api` to your nginx sites-enabled folder (make sure to change directories and ports accordingly)

3. Run the below commands
```
composer install

bin/console doctrine:schema:drop
bin/console doctrine:schema:create
```

4. Start Built-in server
```
symfony serve

service nginx restart
```

If you do not have `symfony` command, please refer to that [tutorial](https://symfony.com/download).


5. Setup the standalone websocket server [located here](https://github.com/edouardkombo/quiz-websockets)

6. Setup the frontend SPA application built under VueJS [here](https://github.com/edouardkombo/quiz-frontend)

7. Visit your exposed API using Swagger at this location `http://localhost/api`

