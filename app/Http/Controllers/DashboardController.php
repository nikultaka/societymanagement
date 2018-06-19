<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        
        
    }
    public function home()
    {   
        $data=array();
        $pending_receipt= DB::table('house_receipts')
                        ->join('charges_list','house_receipts.charges_id','=','charges_list.id')
                        ->where('house_receipts.status','=',0)
                        ->select(DB::raw("SUM(charges_list.charges_ammount) as pending"))
                        ->first();
        $Paid_charges= DB::table('house_receipts')
                        ->join('charges_list','house_receipts.charges_id','=','charges_list.id')
                        ->where('house_receipts.status','=',1)
                        ->select(DB::raw("SUM(charges_list.charges_ammount) as paidCount"))
                        ->first();
        $totalExpenses= DB::table('expenses_list')
                        ->where('status','=',1)
                        ->select(DB::raw("SUM(ammount) as TotalExpense"))
                        ->first();
        $totalhouse= DB::table('house_managment')
                    ->where('status','=',1)
                    ->select(DB::raw("COUNT(*) as Totalhouse"))
                    ->first();
        $data['pending']=$pending_receipt;
        $data['paid']=$Paid_charges;
        $data['totalexpenses']=$totalExpenses;
        $data['totalhouse']=$totalhouse;
        return View::make('BackEnd.dashboardhome')->with($data);
    }
    
}
