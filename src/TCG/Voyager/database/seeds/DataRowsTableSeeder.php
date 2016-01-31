<?php

use Illuminate\Database\Seeder;

class DataRowsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_rows')->delete();
        
        \DB::table('data_rows')->insert(array (
            0 => 
            array (
                'id' => 1,
                'data_type_id' => 1,
                'field' => 'id',
                'type' => 'PRI',
                'display_name' => 'ID',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 1,
                'details' => '',
            ),
            1 => 
            array (
                'id' => 2,
                'data_type_id' => 1,
                'field' => 'author_id',
                'type' => 'text',
                'display_name' => 'Author',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 1,
                'details' => '',
            ),
            2 => 
            array (
                'id' => 3,
                'data_type_id' => 1,
                'field' => 'title',
                'type' => 'text',
                'display_name' => 'Title',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            3 => 
            array (
                'id' => 4,
                'data_type_id' => 1,
                'field' => 'excerpt',
                'type' => 'text_area',
                'display_name' => 'excerpt',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            4 => 
            array (
                'id' => 5,
                'data_type_id' => 1,
                'field' => 'body',
                'type' => 'rich_text_box',
                'display_name' => 'Body',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            5 => 
            array (
                'id' => 6,
                'data_type_id' => 1,
                'field' => 'image',
                'type' => 'image',
                'display_name' => 'Post Image',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            6 => 
            array (
                'id' => 7,
                'data_type_id' => 1,
                'field' => 'slug',
                'type' => 'text',
                'display_name' => 'slug',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            7 => 
            array (
                'id' => 8,
                'data_type_id' => 1,
                'field' => 'meta_description',
                'type' => 'text_area',
                'display_name' => 'meta_description',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            8 => 
            array (
                'id' => 9,
                'data_type_id' => 1,
                'field' => 'meta_keywords',
                'type' => 'text_area',
                'display_name' => 'meta_keywords',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            9 => 
            array (
                'id' => 10,
                'data_type_id' => 1,
                'field' => 'status',
                'type' => 'select_dropdown',
                'display_name' => 'status',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{
"dropdown": {
"PUBLISHED": "published",
"DRAFT": "draft",
"PENDING": "pending"
}
}',
            ),
            10 => 
            array (
                'id' => 11,
                'data_type_id' => 1,
                'field' => 'created_at',
                'type' => 'timestamp',
                'display_name' => 'created_at',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 1,
                'details' => '',
            ),
            11 => 
            array (
                'id' => 12,
                'data_type_id' => 1,
                'field' => 'updated_at',
                'type' => 'timestamp',
                'display_name' => 'updated_at',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 1,
                'details' => '',
            ),
        ));
        
        
    }
}
