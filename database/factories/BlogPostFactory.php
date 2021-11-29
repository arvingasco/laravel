<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\BlogPost::class;
 
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->catchphrase(),
            'content' => $this->faker->realText(1000),
        ];
    }

    public function newTitle() {
        return $this->state([
            'title' => 'New Title',
            // 'content' => 'Content of the blog post',
        ]);
    }
}
// tinker
//BlogPost::factory()->create();