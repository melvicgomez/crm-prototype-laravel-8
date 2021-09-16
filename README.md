# **CRM Sample App Documentation**

### **Prerequisite**
* Make sure you have `php` CLI running in your terminal
* Install `composer` by checking this guide https://getcomposer.org/download/
* Make sure you have MySQL available (remote DB is fine as long as your terminal can connect), prepare DB Host, DB Name, DB Username, DB Password, DB Port for connection later

### **Lert's Get Started**
* Clone this repo to your designated directory
  * Clone via SSH - `git clone git@github.com:melvicgomez/crm-prototype-laravel-8.git`
  * Clone via HTTPS - `git clone git@github.com:melvicgomez/crm-prototype-laravel-8.git`
* Create a file `.env` in the root directory by copying the `.env.example` file
* Change the DB variables to your remote or local DB credentials
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_crm_sample_app
DB_USERNAME=root
DB_PASSWORD=
```
* Open your terminal and select the root directory of your CRM Sample App project, run the command `composer i` to install all dependencies. Make sure you have composer CLI installed in your machine
* Run `php artisan key:generate` in your terminal to generate new app key
* To initialize the tables for your database, you must run the command `php artisan migrate:refresh` in your terminal


### **How to start the app**
* Open your terminal, and run the command `php artisan serve`, your web app should accessible via `http://127.0.0.1:8000/` URL.
* If you want to see all route list available, run `php artisan route:list`



### **Troubleshooting**
* You can contact me thru connect@melvicgomez.com, if you need assistance on how to setup the app.

### *You are all set now! Happy Coding!*