<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Block;
use App\Models\Receipt;
use Validator;
use Illuminate\Support\Facades\DB;
    
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        
        return View::make('BackEnd.report.report_list');
//        return view('BackEnd.report.report_list');
      
    }
    
    public function anyData()
        {
//        echo "dffsd";
//        print_r($_GET);exit;
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $report = DB::table('house_receipts')
                    ->select('*')
                    ->where('start_date',$start_date and 'end_date',$end_date)
                    ->get();
        echo $report;exit;
             return Datatables::of($document)->editColumn('status', function($data) {
                                return ($data->status == 1)
                                ? trans('Active'): trans('Inactive');
                                });
//                                ->addColumn('action', function ($document) {
//                                $button= '<div class="datatable_btn"><a target="_blank" href="upload/'.$document->document.'" data-id="'.$document->id.'" class="btn btn-xs btn-info"> Download</a> &nbsp;';
//                                $button .='<a onclick="delete_document('.$document->id.')" class="btn btn-xs btn-danger"> Delete</a></div>';
//                                return $button;
//                    })
                    
//                    ->editColumn('id', '{{$id}}')
//                    ->make(true);
        }
}