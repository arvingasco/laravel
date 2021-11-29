<?php

namespace Database\Factories;
 
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
 
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Comment::class;
 
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->realText()
        ];
    }
}
// tinker
// Comment::factory()->create(['blog_post_id'=>1])