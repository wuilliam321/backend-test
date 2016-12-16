# Event App

## How to install

### Pre-requisite
 * Install PHP5.6+ (see https://launchpad.net/~ondrej/+archive/ubuntu/php)
 * Install Laravel (see https://laravel.com/docs/5.3)
 * Install Composer (https://getcomposer.org/download/)
 * Install Node.js (Stable version) (https://github.com/creationix/nvm)
 * Install Gulp (http://gulpjs.com/)
 * Install a Mysql Server
 
### Setting up the app
Installing some libraries needed
```
sudo apt-get install php5.6-mbstring php5.6-xml php5.6-mysql
```
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
This step is for nvm users only (stable)
```
nvm use stable
```
Install node dependencies
```
npm install
npm install --global gulp-cli # Ensure you have gulp installed
```
Create a mysql database named `eventsdb`. First log into the mysql shell
```
$ mysql # Use your custom credentials ex: mysql -u root -proot
```
In the mysql shell run:
```
mysql> create database eventsdb; 
```
Prepare `.env` file
```
cp .env.example .env
php artisan key:generate
```
Open the `.env` file and change these values with the yours
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead # < Here
DB_USERNAME=homestead # < Here
DB_PASSWORD=secret    # And here
```
Save and close the file

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
gulp # Every time you change the javascript files
```
And run:
```
php artisan serve
```
Now you can go to:
```
http://localhost:8000/
```
Working Demo:
```
http://ec2-54-191-170-68.us-west-2.compute.amazonaws.com/
```
And see the app working

## Important Notes
 * I moved the `location` and `price` attribute from `events` table to `event_dates` table because the same event could be in different places with different prices (place restriction)
 * I used english in the whole project because we can translate this easily in the future
 * The customization of `event_dates` add new dates is not implemented (it was not a required behavior) 