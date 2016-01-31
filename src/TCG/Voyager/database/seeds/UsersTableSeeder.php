<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => \Hash::make('password'),
                'remember_token' => 'cPTJOJ88JemqHRMBTe40x3TS0LahThZ5EwrbGasPhSn7NDO4gBjkFf4ImFXz',
                'created_at' => '2016-01-28 11:20:57',
                'updated_at' => '2016-01-28 00:14:50',
            ),
        ));
        
        
    }
}
