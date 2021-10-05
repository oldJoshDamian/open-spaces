<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;

class HomeController extends Controller
{
    public function index() {
        if (auth()->check()) {
            return redirect()->route('space.index');
        }
        $spaces = Space::where('visibility', 'public')->latest('updated_at')->get();
        return view('welcome', compact('spaces'));
    }
}