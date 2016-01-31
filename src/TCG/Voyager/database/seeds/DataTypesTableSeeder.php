<?php

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'posts',
                'slug' => 'posts',
                'display_name_singular' => 'Post',
                'display_name_plural' => 'Posts',
                'icon' => 'newspaper-o',
                'model_name' => '\\App\\Post',
                'description' => '',
                'created_at' => '2016-01-27 19:45:51',
                'updated_at' => '2016-01-28 03:45:51',
            ),
        ));
        
        
    }
}
