<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use App\Models\Block;
use Illuminate\Http\Request;
use DB;
class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data_result=array();
        $block_list=Block::where('status', '=', 1)->get();
        $data_result['block_list']=$block_list;
        return View::make('BackEnd.payment.payment_list')->with($data_result);
    }
    public function addpayment(){
        return View::make('BackEnd.payment.payment_add');
    }
    public function addpaymentreceipt(){
        
         
       $data= DB::table('house_managment')
                /*->join('charges_list', 'house_managment.house_block_id', '=', 'charges_list.block_id')*/
                ->join('charges_list',function($join)
                    {
                        $join->on('house_managment.house_block_id', '=', 'charges_list.block_id');
                        $join->on('charges_list.status','=',DB::raw(1));
                    })
                ->where('house_managment.status','=',1)
                ->select('house_managment.id', 'charges_list.id as charge_id')
                ->get();
      $first_day_this_month = date('m-01-Y');
      $last_day_this_month  = date('m-t-Y');
       foreach ($data as $key=>$value){
           $data_result=array();
           $data_result['house_managment_id'] =$value->id;
           $data_result['charges_id']=$value->charge_id;
           $data_result['start_date']=$first_day_this_month;
           $data_result['end_date']=$last_day_this_month;
           $data_result['status']=1;
           $cart[]=$data_result;
       }
       foreach ($cart as $data){
           DB::table('house_receipts')->insert($data);
       }
    }
}