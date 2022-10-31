<?php

namespace Database\Seeders;

use App\Models\Process;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $process = Process::first();
        if (!$process) {
            $this->command->line("Generating process status");
            $processes = ['รอรับเรื่อง', 'ไม่อนุมัติ', 'ดำเนินการ', 'เสร็จสิ้น'];
            collect($processes)->each(function ($process_name, $key) {
                $process = new Process;
                $process->name = $process_name;
                $process->save();
            });
        }

        $this->command->line("Generating processes for all posts");
        $posts = Post::get();
        $posts->each(function($post, $key) {
            $n = fake()->numberBetween(1,1);
            $process_ids = Process::inRandomOrder()->limit($n)->get()->pluck(['id'])->all();
            $post->processes()->sync($process_ids);
        });
    }
}
