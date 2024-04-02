<?php

namespace App\Http\Controllers;
use App\Models\score;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ScoresController extends Controller
{
    //
    public function index()
    {
        $scores = DB::table('scores')->orderBy('wpm', 'DESC')->cursorPaginate(5);
        return view('scores', ['scores' => $scores]);
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
