<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function myProfile()
   {
       return view('backend.profile.profile')->with('currentUser',Auth()->user());

   }

}
