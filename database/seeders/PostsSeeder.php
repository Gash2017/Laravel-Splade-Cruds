<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Post;
use App\Models\Category;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_US');

        
        $cat_data = collect([]);
    
        for ($i = 1; $i <= 1001; $i++) {
            $cat_data->push([
                'name' => $faker->unique()->name,
                'slug' => $faker->unique()->name(),

                // ...
            ]);
        }
        
        $chunks = $cat_data->chunk(500);
        
         foreach ($chunks as $chunk) {
             Category::insert($chunk->toArray());
         }

         $post_data = collect([]);
    
         for ($i = 1; $i <= 10001; $i++) {
             $post_data->push([
                 'title' => $faker->unique()->name,
                 'slug' => $faker->unique()->name(),
                 'category_id' => $faker->numberBetween($min = 1, $max = 1000),
                 'description' => $faker->name(),

             ]);
         }
         
         $chunks = $post_data->chunk(500);
         
          foreach ($chunks as $chunk) {
              Post::insert($chunk->toArray());
          }

    }
}
