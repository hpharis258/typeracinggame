<?php

namespace App\Http\Controllers;
use App\Models\post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all();
        return view('posts', ['posts' => $posts]);
    }  
    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable',
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image',
            'up_vote_count' => 'integer',
        ]);
        $newPost = Post::create($data);
        return redirect(route('posts.index'));
    }
}
