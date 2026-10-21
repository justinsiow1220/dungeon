<?php

namespace App\Controllers;

class GameController extends BaseController
{
    public function index()
    {
        return view('game/home');
    }
}