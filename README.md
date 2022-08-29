# Using docker to run the setup

Both servers are laravel based. copies of the subscriber server can used for multiple tests
## create multiple subscriber server
cp -r subscriber subscriber2

# Setup

- git clone the repo

- mv .env.dev .env   => rename the .env.dev file for each server

- set APP_PORT, VITE_PORT and FORWARD_ values in the new .env file

# Open each server folder in terminal, install packages then sail up
composer install && ./vendor/bin/sail up -d

# To stop process, close from docker or open required server folder in terminal, then sail down
./vendor/bin/sail down

