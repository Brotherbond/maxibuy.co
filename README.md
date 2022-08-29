# Using docker to run the setup

Both servers are laravel based. copies of the subscriber server can used for multiple tests

# Setup

- git clone the repo

## create multiple subscriber server
cp -r subscriber subscriber2

# MySQL
set FORWARD_DB_PORT

# Open each server folder in terminal, install packages then sail up
composer install && ./vendor/bin/sail up -d

# To stop process, close from docker or open required server folder in terminal, then sail down
./vendor/bin/sail down

