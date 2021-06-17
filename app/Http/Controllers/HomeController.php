<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        //return (auth()->check()) ? view('dashboard') : view('welcome');
    }
}
