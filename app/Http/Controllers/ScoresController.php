<?php

namespace App\Http\Controllers;
use App\Models\score;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ScoresController extends Controller
{
    //
    public function index()
    {
        $scores = Score::all();
        $sortedScores = $scores->sortByDesc('wpm');
        return view('scores', ['scores' => $sortedScores]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'wpm' => 'required',
            'imageurl' => 'nullable',
        ]);
        $newScore = Score::create($data);
        return redirect(route('scores.index'));
    }
}
