
## requirements

 - git
 - docker
 - nginx
 - mysql
 - php

## Installation

for install and run project you should follow these steps:

 1. git clone from project and go to project directory
 2. run `docker-compose up -d` command for bulid docker containers from docker compose file
 3. go to php container with `docker exec -it <container name> bash` command
 4. run `composer install` command
 5. after install packages run `php artisan migrate` command
 6. you can run `php artisan db:seed` for seeding database (optional)
 

## *Unit test*
for test project at first got to php container then run `vendor/bin/phpunit` command
