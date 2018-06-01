<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        
        return View::make('BackEnd.dashboard');
    }
    
}
