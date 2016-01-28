# **V**oyager - A Laravel Admin & BREAD System

*What is BREAD?* 

Glad you asked. It's the same concept as CRUD which stands for **Create**, **Read**, **Update**, and **Delete**. 

BREAD stands for **Browse**, **Read**, **Edit**, **Add**, & **Delete**). It sounds much nicer too, right? It's much better to have a bunch of BREAD, than a bunch of CRUD. Documentation coming soon...

![Screenshot of Voyager](https://raw.githubusercontent.com/the-control-group/voyager/master/src/assets/images/screenshot.png)

Voyager will be released as a Package in the Packagist directory when it has been completed, but for the meantime to preview the current state you can follow these steps:

Create Your New Laravel App (must have the Laravel installer)
```
laravel new application
```

Change Directory into your current application
```
cd application
```

Clone the Repo
```
git clone https://github.com/the-control-group/voyager.git
```

Open up your composer.json and load the package in the PSR-4 autoload value, so it looks like the following:

```
"autoload": {
    "classmap": [
        "database"
    ],
    "psr-4": {
        "App\\": "app/",
        "TCG\\Voyager\\": "voyager/src"
    }
},
```

Then run composer command to dump the current autoloaded files:

```
composer dump-autoload
```

Next, create a new database and add the database credentials to your .env file of your laravel app. We'll also start off by running the default Laravel authentication scaffolding by running:

```
php artisan make:auth
```

Then we need to add our service provider. Add the following inside of config/app.php inside of the providers array:

```
TCG\Voyager\VoyagerServiceProvider::class
```

Then, we'll need to publish our voyager files to be loaded into your app

```
php artisan vendor:publish
```

Finally, lets run the migrations and the seeds

```
php artisan migrate
php artisan db:seed
```

If seeds do not run, you may need to add the following inside of the run function inside of database/seeds/DatabaseSeeder.php

```
$this->call('DataTypesTableSeeder');
$this->call('DataRowsTableSeeder');
$this->call('UsersTableSeeder');
```

Start up a local development server:

```
php artisan serve
```

And, visit http://localhost:8000/admin and you can login with the following login credentials:

```
**email:** admin@admin.com
**password:** password
```
