# Publisher & Subscriber System

#### Publisher  => https://github.com/Brotherbond/maxibuy.co

#### Subscriber =>  https://github.com/Brotherbond/websocket

#### Postman API => https://documenter.getpostman.com/view/14901487/VUxKVAUq

NB: pusher app key & secret in .env file  could be any random value and doesn't link to my live account

<br>

## Requirements / Tools =>  Docker, VS code, Sequel Ace

<br>

### Using docker to run the setup

Both servers are laravel based. copies of the subscriber server can used for multiple tests

<br>

<span>

### To create multiple subscriber server and adjust the environment 

<i style="color:yellow">
cp -r subscriber subscriber2
</i>
</span>
<br>
<br>

# Setup

- git clone the repos

- cp .env.docker to .env => rename the .env.docker file for each server

- set APP_PORT, VITE_PORT, DOCKER_APP_URL and FORWARD_ values in the .env file for new server in case of multiple system

<i style="color:yellow">

#### Optional if switching user to sail to work in container environment, add WWWUSER and WWWGROUP. NB default is set as root

su - sail 
##### switch to /var/www/html

cd /var/www/html
</i>
<br>
<br>

### start Publisher terminal => both servers work using database for queue setup

<i style="color:green">

php artisan queue:work

npm run dev

</i>

### start Subscriber terminal

<i style="color:green">

php artisan queue:work

npm run dev

php artisan websockets:serve

</i>

<br>

##  127.0.0.1:8000 for Publisher server 
##  127.0.0.1:9000 for Subscriber server 1

<br>

# Extra info


### Open each server folder in terminal, install packages then sail up

composer install &&  npm run dev && ./vendor/bin/sail up -d

<br>

### To send notification from publisher on a separate terminal

<i>
php artisan queue:work
</i>

<br>

### start websocket for subscriber alone

<i>
php artisan websockets:serve

</i>

<br>

### install and run blade in dev mode

<i>
pnpm i && pnpm run dev # NB pnpm is used here just like npm or yarn
</i>

<br>

### To stop process, close from docker or open required server folder in terminal, then sail down
<i>
./vendor/bin/sail down
</i>

<br>

### test subscriber event in tinker
<i>
php artisan tinker

event (new \App\Events\NewTrade('new'))

</i>
