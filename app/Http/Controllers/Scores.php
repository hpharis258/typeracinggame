<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;


class Scores extends Controller
{
    //
    public function index()
    {
        return view('scores');
    }
    public function GameOverNotLoggedIn()
    {
        return view('home', compact('gameCompleteModalNotLoggedIn'));
    }
}
