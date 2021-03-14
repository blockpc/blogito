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
        Type::create(['name' => 'cita', 'start' => '<blockquote>', 'end' => '</blockquote>']);
        Category::create(['name' => 'laravel', 'description' => 'Laravel es un framework de código abierto para desarrollar aplicaciones y servicios web con PHP']);
        Category::create(['name' => 'PHP', 'description' => 'PHP es un lenguaje de programación de uso general que se adapta especialmente al desarrollo web']);
        Category::create(['name' => 'MySQL', 'description' => 'MySQL es un sistema de gestión de bases de datos relacional']);
        Category::create(['name' => 'MariaDB', 'description' => 'MariaDB es un sistema de gestión de bases de datos derivado de MySQL con licencia GPL']);
        Category::create(['name' => 'TailWind', 'description' => 'Tailwind CSS es un framework CSS que permite un desarrollo ágil, basado en clases de utilidad que se pueden aplicar con facilidad en el código HTML']);
        Category::create(['name' => 'bootstrap', 'description' => 'Bootstrap es una biblioteca multiplataforma o conjunto de herramientas de código abierto para diseño de sitios y aplicaciones web']);
        Category::create(['name' => 'alpine', 'description' => 'librería javascript inspirada en otros frameworks como AngularJS, VueJS']);
        Category::create(['name' => 'livewire', 'description' => 'Livewire es un framework fullstack para el desarrollo de componentes Laravel']);
        Tag::factory()->count(10)->create();

        Post::factory()->count(11)->create()->each(function ($post) {
            $cuantos = random_int(2,5);
            $post->blocks()->saveMany(Block::factory()->count($cuantos)->make());
        });
    }
}
