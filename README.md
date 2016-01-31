# **V**oyager - A Laravel Admin & BREAD System

*What is BREAD?* 

Glad you asked. It's the same concept as CRUD which stands for **Create**, **Read**, **Update**, and **Delete**. 

BREAD stands for **Browse**, **Read**, **Edit**, **Add**, & **Delete**. It sounds much nicer too, right? It's much better to have a bunch of BREAD, than a bunch of CRUD.

![Screenshot of Voyager](https://raw.githubusercontent.com/the-control-group/voyager/master/src/assets/images/screenshot.png)

After creating your new Laravel application you can include the Voyager package with the folowing command: 

```
composer require tcg/voyager
```

Next make sure to create a new database and add your database credentials to your .env file:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Add the Voyager service provider as well as the Image Intervention service provider to the config/app.php file in the `'providers' => [` array:

```
    TCG\Voyager\VoyagerServiceProvider::class,
    Intervention\Image\ImageServiceProvider::class,
```

Optionally if you wish to have the front-end authentication scaffolding provided by laravel you can run:

```
php artisan make:auth
```

Then, we'll need to publish our voyager files to be loaded into your app

```
php artisan vendor:publish
```

Finally, lets run our migrations

```
php artisan migrate
```

And before we run the database seed, we must first add the following to our *database/seeds/DatabaseSeeder.php* inside of the `public function run()`:

```
$this->call('DataTypesTableSeeder');
$this->call('DataRowsTableSeeder');
$this->call('UsersTableSeeder');
$this->call('PostsTableSeeder');
```

Now, let's run our database seeds:

```
php artisan db:seed --class=VoyagerDatabaseSeeder
```

And we're all good to go! 

Start up a local development server with `php artisan serve` And, visit http://localhost:8000/admin and you can login with the following login credentials:

```
**email:** admin@admin.com
**password:** password
```
