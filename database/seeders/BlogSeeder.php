<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Type;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create(['name' => 'parrafo', 'start' => '<p>', 'end' => '</p>']);
        Type::create(['name' => 'codigo', 'start' => '<pre><code>', 'end' => '</code></pre>']);
        Category::factory()->count(5)->create();
        Tag::factory()->count(10)->create();

        Post::factory()->count(11)->create()->each(function ($post) {
            $cuantos = random_int(2,5);
            $post->blocks()->saveMany(Block::factory()->count($cuantos)->make());
        });
    }
}
