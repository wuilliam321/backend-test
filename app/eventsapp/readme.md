# Event App

## How to install

### Pre-requisite
 * Composer (https://getcomposer.org/download/)
 * Node.js (https://github.com/creationix/nvm)
 
### Setting up the app
Download the code
```
git clone https://github.com/wuilliam321/backend-test.git
```
Move to the `eventapp` folder
```
cd backend-test/app/eventsapp/
```
Install composer dependencies, you have to go to pre-requisite linnk and see how to enable composer
```
composer install
```
Install node dependencies
```
npm install
```
After install all dependencies you have to run migrations
```
php artisan migrate
```
Fill database with data values
```
php artisan db:seed
```
If you want to clean all data and seed database again use:
```
php artisan migrate:refresh --seed
```
Run:
```
php artisan serve
```
Now you can go to:
```
http://localhost:8000/
```
And see the app working