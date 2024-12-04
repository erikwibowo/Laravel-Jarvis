<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class GuestController extends Controller
{
    public function index(){
        return Inertia::render('Guest/Index', [
            'title' => "Home",
        ]);
    }
}
