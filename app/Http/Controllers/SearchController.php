<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Member;
use App\Models\Receipt;
use App\Models\Block;
use Validator;
use Illuminate\Support\Facades\DB;
class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data_result=array();
        $block_list=Block::where('status', '=', 1)->get();
        $data_result['block_list']=$block_list;
        return View::make('BackEnd.search.index')->with($data_result);
    }
     public function getdatafordropdown(){
            
                    $id=$_GET['id'];
                    
                    if ($id != '') {
                    $house_no=DB::table('house_managment')
                            ->where('house_block_id','=',$id)
                            ->where('status','=',1)
                            ->get();
                    
                    $data= "<select name='house_no' id='house_no'>";
                    $data .= "<option value=''>Select House No</option>";
                    foreach ($house_no as $key=>$value){
                        $data .="<option value='" . $value->id . "' id='". $value->house_no ."' data-id='".$value->id."'>" . $value->house_no . "</option>";
                    }
                    
                    $data .= "</select>";
                    
                 }
                 return $data;
        }
    public function search_record(){
        if($_POST){
            $block_id=$_POST['block_list'];
            $house_id=$_POST['house_no'];
            $month_id=$_POST['select_month'];
            
            $dateToTest = date("Y-".$month_id."-01");
            $lastday = date('t',strtotime($dateToTest));
            
            $first_date = date($month_id.'-01-Y');
            $last_date  = date($month_id.'-'.$lastday.'-Y');
             
            if(isset($month_id) && $month_id > '0'){
                echo "dssa";exit;
            $receipt= DB::table('house_receipts')
                    ->select('*')
                    ->where('start_date','=',$first_date and 'end_date','=',$last_date and 'status','=',0)
                    ->get();
            }
            
            
            
            
            else{
           $receipt= DB::table('house_receipts')
                   ->where(function ($param) use ($house_id) {
                       return $param->where('house_receipts.house_managment_id','=',$house_id)
                               ->where('house_receipts.status','=',0);
            })
                   ->get();
            }
           echo '<pre>';
           print_r($receipt);
//           die;
        }
    }
}