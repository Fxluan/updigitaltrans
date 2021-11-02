<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontakKamiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kontakkamiUser()
    {
        return view('user.kontakkami');
    }

     public function kontakkamiAdmin()
    {
        return view('admin.kontakkami.index');
    }
    
}
