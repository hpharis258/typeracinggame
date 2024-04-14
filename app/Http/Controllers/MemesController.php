<?php

namespace App\Http\Controllers;
use App\Models\Meme;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MemesController extends Controller
{
    //
    public function index()
    {
        $meme = Meme::orderBy('up_vote_count','desc')->paginate(5)->withQueryString();
        return view('memes', ['memes' => $meme]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'imageurl' => 'required',
            'up_vote_count' => 'integer:default(0)',
        ]);
        $newMeme = Meme::create($data);
        return redirect(route('memes.index'));
    }
    public function create()
    {
        return view('create');
    }
    public function updateUpvote(Meme $meme, Request $request)
    {
        $meme->up_vote_count += 1;
        $meme->save();
        return redirect(route('memes.index'))->with("success", "Meme up-voted successfully!");
    }
    public function updateDownvote(Meme $meme, Request $request)
    {
        $meme->up_vote_count -= 1;
        $meme->save();
        return redirect(route('memes.index'))->with("success", "Meme Down-voted successfully!");
    }
}
