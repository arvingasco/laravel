<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use App\Models\User;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postsCount = (int)$this->command->ask('How many blog posts?', 50);
        $users = User::all();

        BlogPost::factory()->count($postsCount)->make()->each(function ($post) use ($users){
            $post->user()->associate($users->random())->save();
        });
    }
}
