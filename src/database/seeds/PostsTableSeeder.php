<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 20,
                'author_id' => 0,
                'title' => 'Lorem Ipsum Post',
                'excerpt' => 'This is the excerpt for the Lorem Ipsum Post',
                'body' => '<p>This is the body of the lorem ipsum post</p>',
                'image' => 'content/uploads/posts/nlje9NZQ7bTMYOUG4lF1.jpg',
                'slug' => 'lorem-ipsum-post',
                'meta_description' => 'This is the meta description',
                'meta_keywords' => 'keyword1, keyword2, keyword3',
                'status' => 'PUBLISHED',
                'created_at' => '2016-01-29 06:56:24',
                'updated_at' => '2016-01-29 00:03:36',
            ),
            1 => 
            array (
                'id' => 21,
                'author_id' => 0,
                'title' => 'My Sample Post',
                'excerpt' => 'This is the excerpt for the sample Post',
                'body' => '<p>This is the body for the sample post, which includes the body.</p>
<h2>We can use all kinds of format!</h2>
<p>And include a bunch of other stuff.</p>',
                'image' => 'content/uploads/posts/7uelXHi85YOfZKsoS6Tq.jpg',
                'slug' => 'my-sample-post',
                'meta_description' => 'Meta Description for sample post',
                'meta_keywords' => 'keyword1, keyword2, keyword3',
                'status' => 'PUBLISHED',
                'created_at' => '2016-01-29 06:56:22',
                'updated_at' => '2016-01-29 00:05:08',
            ),
            2 => 
            array (
                'id' => 23,
                'author_id' => 0,
                'title' => 'Latest Post',
                'excerpt' => 'This is the excerpt for the latest post',
                'body' => '<p>This is the body for the latest post</p>',
                'image' => 'content/uploads/posts/9txUSY6wb7LTBSbDPrD9.jpg',
                'slug' => 'latest-post',
                'meta_description' => 'This is the meta description',
                'meta_keywords' => 'keyword1, keyword2, keyword3',
                'status' => 'PUBLISHED',
                'created_at' => '2016-01-29 14:43:49',
                'updated_at' => '2016-01-29 14:43:49',
            ),
        ));
        
        
    }
}
