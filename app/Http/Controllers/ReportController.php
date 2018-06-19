<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Block;
use App\Models\Receipt;
use Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
   
class ReportController extends DashboardController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        
        return View::make('BackEnd.report.report_list');
//        return view('BackEnd.report.report_list');
      
    }
    
    public function anyData(Request $request)   
    {
        
        $validator = Validator::make($request->all(), [
                'end_date' => 'required',
                'start_date' => 'required',
                'report_type' => 'required',
                    ]);
        if ($validator->passes()) {
            $start_date=date('Y-m-d', strtotime($request->input('start_date')));
            $end_date=date('Y-m-d', strtotime($request->input('end_date')));;
            $report_type=$request->input('report_type');
            //Search For Expences
            if($report_type == 1){
                
                $reportlist= DB::table('expenses_list')
                              ->join('expense_type', 'expense_type.id', '=', 'expenses_list.expense_type_id')
                              ->where('expenses_list.gm_created','>=', $start_date)
                              ->where('expenses_list.gm_created','<=', $end_date)
                              ->where('expenses_list.status','=', 1)
                              ->select('expenses_list.*','expense_type.expense_name')
                              ->get();
                
            }
            //Search For Receipt
            elseif($report_type == 2){
                $reportlist= DB::table('house_receipts')
                    ->where('gm_created','>=',$start_date)
                    ->where('gm_created','<=',$end_date)
                    ->where('status','=',0)
                    ->get();
                
            }
            else{
                die();
            }
        }
        return $reportlist;exit();
        
        
    }
    public function receiptreportindex(){
         return View::make('BackEnd.report.receiptreport_list');
    }
    public function receiptgetdata(Request $request){
        
        $validator = Validator::make($request->all(), [
                'end_date' => 'required',
                'start_date' => 'required',
                ]);
        if ($validator->passes()) {
            $start_date=date('Y-m-d', strtotime($request->input('start_date')));
            $end_date=date('Y-m-d', strtotime($request->input('end_date')));;
            
            $reportlist= DB::table('house_receipts')
                    ->join('house_managment','house_receipts.house_managment_id','=','house_managment.id')
                    ->join('member_list','house_managment.owner_id','=','member_list.id')
                    ->join('charges_list','house_receipts.charges_id','=','charges_list.id')
                    ->where('house_receipts.gm_created','>=',$start_date)
                    ->where('house_receipts.gm_created','<=',$end_date)
                    ->where('house_receipts.status','=',1)
                    ->select('house_receipts.*','house_managment.house_no','member_list.member_first_name','member_list.member_last_name','charges_list.charges_name','charges_list.charges_ammount')
                    ->get();
        }
        else {
            die();
        }
        return $reportlist;exit();
    }
}