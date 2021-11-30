<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();
        if($posts->count() == 0) {
            $this->command->info('There are no blog post for comments to add into.');
            return;
        }
        $commentCount = (int)$this->command->ask('How many comments?', 150);

        Comment::factory()->count($commentCount)->make()->each(function ($comment) use ($posts) {
            $comment->blogPost()->associate($posts->random())->save();
        });
    }
}
