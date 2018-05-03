<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        
        return View::make('BackEnd.dashboard');
    }
    
}
