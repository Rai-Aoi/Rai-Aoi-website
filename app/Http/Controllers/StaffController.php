<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->simplePaginate(50);
        return view('staffs.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        if (is_int($post->view_count)) {
            $post->view_count = $post->view_count + 1;
            $post->save();
        }
        return view('posts.show', ['post' => $post]);
    }
}
