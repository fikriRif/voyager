<?php

use Illuminate\Database\Seeder;

class VoyagerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('DataTypesTableSeeder');
        $this->call('DataRowsTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('PostsTableSeeder');
    }
}
