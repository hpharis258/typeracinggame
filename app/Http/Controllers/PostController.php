<?php

namespace App\Http\Controllers;
use App\Models\post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        //$posts = Post::all();
        //$sortedPosts = $posts->sortByDesc('up_vote_count');
        $posts = Post::paginate(5)->withQueryString();
       // $posts = DB::table('posts')->orderBy('up_vote_count', 'DESC')->cursorPaginate(5);
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
    public function edit(Post $post)
    {
        return view('edit', ['post' => $post]);
    }
    public function update(Post $post, Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable',
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image',
            'up_vote_count' => 'integer',
        ]);
        $post->update($data);

        return redirect(route('posts.index'))->with("success", "Post updated successfully!");
    }
    public function updateUpvote(Post $post, Request $request)
    {
        $post->up_vote_count += 1;
        $post->save();
        return redirect(route('posts.index'))->with("success", "Post up-voted successfully!");
    }
    public function updateDownvote(Post $post, Request $request)
    {
        $post->up_vote_count -= 1;
        $post->save();
        return redirect(route('posts.index'))->with("success", "Post Down-voted successfully!");
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect(route('posts.index'))->with("success", "Post deleted successfully!");
    }
}
