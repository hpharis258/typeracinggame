<?php

namespace App\Http\Controllers;
use App\Models\score;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $imageFile = $request->file('imageInput');
        $extension = $imageFile->getClientOriginalExtension(); 
        $filename = $data['username'].time().'.' . $extension;
        $imageFile->move('uploads/scores/', $filename);
        $data['imageurl'] = $filename;
        //Storage::disk('local')->putFile('scores/'+ $data->username + date('Y-m-d'), $request->file('imageInput'));
        $newScore = Score::create($data);
        return redirect(route('scores.index'));
    }
}
