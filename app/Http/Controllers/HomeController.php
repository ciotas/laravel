<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions=Discussion::latest()->paginate(15);
        return view('home',compact('discussions'));
    }
}
