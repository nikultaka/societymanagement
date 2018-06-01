<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Block;
use Validator;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        
        //return view('BackEnd.block.block_list');
      
    }
}