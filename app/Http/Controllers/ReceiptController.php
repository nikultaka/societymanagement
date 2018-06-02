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
class ReceiptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $current_month=date('m');
        $data_result=array();
        $block_list=Block::where('status', '=', 1)->get();
        $data_result['block_list']=$block_list;
        $data_result['current_month']=$current_month;
        $payment_type=DB::table('payment_type')->where('status', '=', 1)->get();
        $data_result['payment_type']=$payment_type;
        return View::make('BackEnd.receipt.receipt_list')->with($data_result);
    }
      public function anyData()
        {
          
          $members=DB::table('house_receipts')
                    ->join('house_managment', 'house_receipts.house_managment_id', '=', 'house_managment.id')
                    ->join('block', 'house_managment.house_block_id', '=', 'block.id')
                    ->join('charges_list', 'block.id', '=', 'charges_list.block_id')
                    ->join('member_list', 'house_managment.owner_id', '=', 'member_list.id')
                    ->select('charges_list.charges_name','house_receipts.id','house_receipts.status','house_receipts.start_date', 'house_managment.house_no','block.block_name as block',DB::raw('CONCAT(member_list.member_first_name," ",member_list.member_middle_name," ",member_list.member_last_name) as membername'))
                    ->get();
          
           // $members = Member::select(['id','member_first_name','member_middle_name','member_last_name','member_email','member_contect','status']);
             return Datatables::of($members)->editColumn('status', function($data) {
                                return ($data->status == 1) ? trans('Paid'): trans('Unpaid');
                                })
                    ->addColumn('action', function ($members) {
                        $button= '<a href="#edit-'.$members->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;';
                        $button .='<a href="#delete-'.$members->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> Delete</a> &nbsp;';
                        $button .='<a onclick="change_payment_status('.$members->id.')" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Paynow</a>';
                        return $button;
                    })
                    ->editColumn('id', '{{$id}}')
                    ->make(true);
        }
        
    public function addmember(Request $request){
            $validator = Validator::make($request->all(), [
                'txt_fname' => 'required',
                'txt_mname' => 'required',
                'txt_lname' => 'required',
                'email' => 'required|email',
                'number' => 'required|min:11|numeric',
                
                    ]);
            if ($validator->passes()) {
                $txt_fname = $request->input('txt_fname');
                $txt_mname = $request->input('txt_mname');
                $txt_lname = $request->input('txt_lname');
                $email = $request->input('email');
                $number = $request->input('number');
                $block_id = $_POST['block_id'];
                
                
                $data_insert = array();
                $data_insert['member_first_name']=$txt_fname;
                $data_insert['member_middle_name']=$txt_mname;
                $data_insert['member_last_name']=$txt_lname;
                $data_insert['member_email']=$email;
                $data_insert['member_contect']=$number;
                $data_insert['member_password']='';
                $data_insert['member_block_id']=$block_id;
                
                $data_insert['status']=1;
                Member::insert($data_insert);
                return response()->json(['success'=>'Added new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
        }
        public function getdatafordropdown(){
            
                    $id=$_GET['id'];
                    
                    if ($id != '') {
                    $house_no=DB::table('house_managment')
                            ->where('house_block_id','=',$id)
                            ->where('status','=',1)
                            ->get();
                    
                    $data= "<select name='house_no' id='house_no' onchange='gethousemember(this.value);'>";
                    $data .= "<option value=''>Select House No</option>";
                    foreach ($house_no as $key=>$value){
                        $data .="<option value='" . $value->owner_id . "' id='". $value->house_no ."' data-id='".$value->id."'>" . $value->house_no . "</option>";
                    }
                    
                    $data .= "</select>";
                    $charges_type=DB::table('charges_list')
                            ->where('block_id','=',$id)
                            ->where('status','=',1)
                            ->get();
                    $data.= "<select name='charges_type' id='charges_type'>";
                    foreach ($charges_type as $key=>$value){
                        $data .="<option value='" . $value->id . "' id='". $value->charges_name ."' >" . $value->charges_name . "</option>";
                    }
                    
                    $data .= "</select>";
                 }
                 return $data;
        }
        public function getdataforhousemember(){
            $owner_id=$_GET['owner_id'];
             if ($owner_id != '') {
                    $member_details=DB::table('member_list')->where('id','=',$owner_id)->first();
                    $member_list=DB::table('member_list')->where('id','!=',$owner_id)->get();
                    
                    $data= "<select name='new_Member_list' id='new_member_list' >";
                    $data .= "<option value=''>Select Member</option>";
                    foreach ($member_list as $key=>$value){
                        $data .="<option value='" . $value->id . "'>" . $value->member_first_name ." ". $value->member_middle_name." ". $value->member_last_name. "</option>";
                    }
                    
                    $data .= "</select>";
                 
                    $data_result['status']=1;
                    $data_result['content']=$member_details;
                    $data_result['member_list']=$data;
                 }
                 return json_encode($data_result);
        }
        public function add_receipt_single(){

            if($_POST){
                $current_month=$_POST['receipt_month'];
                
                $house_management_id = $_POST['house_managment_id'];  
                $charges_id = $_POST['charges_type'];
                $first_second = date('01-'.$current_month.'-Y');
                $last_second  = date('t-'.$current_month.'-Y'); // A leap year
                $payment_type = $_POST['payment_type'];  
                
                
                $data_insert = array();
                $data_insert['house_managment_id']=$house_management_id;
                $data_insert['charges_id']=$charges_id;
                $data_insert['start_date']=$first_second;
                $data_insert['end_date']=$last_second;
                $data_insert['payment_type']=$payment_type;
                $data_insert['status']=0;
                
                Receipt::insert($data_insert);

                return response()->json(['success'=>'Added new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
            }
    public function get_charges_type(){
        $data='';
        if($_GET){
            $id=$_GET['block_id'];
         $charges_type=DB::table('charges_list')
                            ->where('block_id','=',$id)
                            ->where('status','=',1)
                            ->get();
        $data.= "<select name='charges_type' id='charges_type'>";
            foreach ($charges_type as $key=>$value){
                $data .="<option value='" . $value->id . "' id='". $value->charges_name ."' >" . $value->charges_name . "</option>";
            }

        $data .= "</select>";
        }
        return $data;
    }
    public function auto_receipt(){
        $block_id=$_POST['block_list'];
        $charges_type=$_POST['charges_type'];
        $data= DB::table('house_managment')
                ->where('house_managment.house_block_id','=',$block_id)
                /*->join('charges_list', 'house_managment.house_block_id', '=', 'charges_list.block_id')*/
                ->join('charges_list',function($join) use($charges_type)
                    {
                        $join->on('house_managment.house_block_id', '=', 'charges_list.block_id');
                        $join->on('charges_list.status','=',DB::raw(1));
                        $join->on('charges_list.id','=',DB::raw($charges_type));
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
           $data_result['status']=0;
           $cart[]=$data_result;
       }
       foreach ($cart as $data){
           DB::table('house_receipts')->insert($data);
       }
    }
    public function get_receiptdetails_id(){
        $data_result=array();
        $data_result['status']=0;
        if($_GET['action']=='getdatabyid'){
              $receipt_id=$_GET['receipt_id'];
          $members=DB::table('house_receipts')
                    ->join('house_managment', 'house_receipts.house_managment_id', '=', 'house_managment.id')
                    ->join('block', 'house_managment.house_block_id', '=', 'block.id')
                    ->join('charges_list', 'block.id', '=', 'charges_list.block_id')
                    ->join('member_list', 'house_managment.owner_id', '=', 'member_list.id')
                    ->where('house_receipts.id','=',$receipt_id)
                    ->select('charges_list.charges_name','charges_list.charges_ammount','house_receipts.id','house_receipts.status','house_receipts.start_date', 'house_managment.house_no','block.block_name as block',DB::raw('CONCAT(member_list.member_first_name," ",member_list.member_middle_name," ",member_list.member_last_name) as membername'))
                    ->first();
          if($members){
             $data_result['status']=1;
             $data_result['result']=$members;
          }
          
        }
        return json_encode($data_result);
          
    }
    public function payment_status_change(){
        $data_result=array();
        $data_result['status']=0;
        $data_result['msg']='Please Try Agen..!!';
        if($_POST){
            $data_update=array();
            $receipt_id=$_POST['receipt_id_for_status'];
            $payment_type=$_POST['payment_type'];
            $data_update['payment_type']=$_POST['payment_type'];
            $data_update['status']=1;
            $data_update['cheque_number']='';
            $data_update['bank_name']='';
            $data_update['bank_ifsc']='';
            if(isset($payment_type) && $payment_type==1){
               DB::table('house_receipts')
                    ->where('id', $receipt_id)
                    ->update($data_update);
            }
            elseif (isset($payment_type) && $payment_type==2) {
             $data_update['status']=1;
            $data_update['cheque_number']=$_POST['chq_no'];
            $data_update['bank_name']=$_POST['bank_name'];
            $data_update['bank_ifsc']=$_POST['bank_ifsc_code'];
                DB::table('house_receipts')
                    ->where('id', $receipt_id)
                    ->update($data_update);
            
                 $data_result['status']=1;
             $data_result['msg']='Payment Status Updated..!';
            }
            else {

            }
        }
        return json_encode($data_result);
    }
}