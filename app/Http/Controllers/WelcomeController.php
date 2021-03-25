<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;


class WelcomeController extends Controller
{
    public function index()
    {
        $data = Mission::latest()->paginate(5);

        return view('welcome',compact('data'))
             ->with('i', (request()->input('page', 1) - 1) * 5);

    }
}
