<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line("Generating comments of 50 latest posts");
        $posts = Post::latest()->take(50)->get();
        $posts->each(function($post, $key) {
            Comment::factory(fake()->numberBetween(1, 5))->create([
                'post_id' => $post->id
            ]);
        });

        $this->command->line("Generating random 100 comments");
        $post_ids = Post::select(['id'])->get();
        $user_ids = User::select(['id'])->get();
        Comment::factory(100)->create([
            'post_id' => $post_ids->random()->id, 'post_id' => $user_ids->random()->id
        ]);
    }
}
