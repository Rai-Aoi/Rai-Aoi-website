<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = Type::first();
        if (!$type) {
            $this->command->line("Generating Types");
            $types = ['มหาวิทยาลัย', 'คณะวิทยาศาสตร์', 'สบศ.', 'กองกิจการนิสิต', 'องค์การนิสิต'];
            collect($types)->each(function ($type_name, $key) {
                $type = new Type();
                $type->name = $type_name;
                $type->save();
            });
        }

        $this->command->line("Generating types for all posts");
        $posts = Post::get();
        $posts->each(function($post, $key) {
            $n = fake()->numberBetween(1,1);
            $type_ids = Type::inRandomOrder()->limit($n)->get()->pluck(['id'])->all();
            $post->types()->sync($type_ids);
        });
    }
}
