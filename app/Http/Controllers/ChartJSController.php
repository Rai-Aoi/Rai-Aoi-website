<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Process;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class ChartJSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        //type data
        $types_label = [];
        $types_value = [];
        $types = Type::get();
        foreach ($types as $type){
            array_push($types_label,$type->name);
            array_push($types_value,$type->posts->count());
        }
        $types_labels = array_values($types_label);
        $types_dataset = array_values($types_value);


//        tags data

        $tags_name = [];
        $posts = Post::all()->where('created_at','>=',Carbon::today()->startOfMonth()->toDateString())
            ->where('created_at','<=',Carbon::today()->endOfMonth()->toDateString());

        foreach ($posts as $post){
            foreach ($post->tags as $tag){
                $tags_name[] = $tag->name;
            }
        }

        $tags_name = array_unique($tags_name); // put the uniques tags

        $tags_value_month = array_map(function ($tag_name) use ($posts) {
            $count = 0;
            foreach($posts as $post) {
                foreach($post->tags as $tag) {
                    if ( $tag->name == $tag_name) {
                        $count = $count + 1;
                    }
                }
            }
            return $count;
        }, $tags_name);

        $tags = array_combine($tags_name, $tags_value_month);
        arsort($tags);

        $tags_labels = array_keys($tags);
        $tags_dataset = array_values($tags);

        //processes data

        $process_label = [];
        $process_value = [];
        $processes = Process::get();
        foreach ($processes as $process){
            array_push($process_label, $process->name);
            array_push($process_value, $process->posts->count());
        }
        $processes_labels = array_values($process_label);
        $processes_dataset = array_values($process_value);

        return view('admin.index', compact('types_labels', 'types_dataset',
            'tags_labels','tags_dataset',
            'processes_labels','processes_dataset'));
    }
}
