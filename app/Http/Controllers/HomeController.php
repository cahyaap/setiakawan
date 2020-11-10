<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $title = "Setia Kawan | Dashboard";
    
    public function index()
    {
        return view('pages.dashboard')->with([
            'title' => $this->title
        ]);
    }
}
