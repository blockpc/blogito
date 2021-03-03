<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'title' => $this->faker->sentence(),
            'resume' => $this->faker->text(random_int(150, 255)),
            'body' => $this->faker->paragraphs(3, true),
            'owner_id' => User::all()->random()->id,
        ];
    }
}
