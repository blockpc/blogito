<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\Post;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Block::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->paragraphs(3, true),
            'type_id' => Type::all()->random()->id,
            //'post_id' => Post::all()->random()->id,
        ];
    }
}
