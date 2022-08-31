# Publisher & Subscriber System

### Publisher  => https://github.com/Brotherbond/maxibuy.co

### Subscriber =>  https://github.com/Brotherbond/websocket
## Using docker to run the setup

Both servers are laravel based. copies of the subscriber server can used for multiple tests

## create multiple subscriber server and adjust the environment 

cp -r subscriber subscriber2

# Setup

- git clone the repo

- mv .env.dev .env => rename the .env.dev file for each server

- set APP_PORT, VITE_PORT, DOCKER_APP_URL and FORWARD_ values in the .env file for new server in case of multiple system

## Switch user to sail to work in container environment, NB default is set as root

su - sail 

cd /var/www/html

## Open each server folder in terminal, install packages then sail up

composer install && ./vendor/bin/sail up -d

## To send notification from publisher on a separate terminal

php artisan queue:work

## start websocket for subscriber alone

php artisan websockets:serve

## install and run blade in dev mode

pnpm i && pnpm run dev # NB pnpm is used here just like npm or yarn

## test event in tinker

php artisan tinker

event (new \App\Events\NewTrade('new'))


# To stop process, close from docker or open required server folder in terminal, then sail down

./vendor/bin/sail down


## effect can be seen on 127.0.0.1:9000 for subscriber server 1