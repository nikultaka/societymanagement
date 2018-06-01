<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Member;
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
                    ->join('member_list', 'house_managment.owner_id', '=', 'member_list.id')
                    ->select('house_receipts.id','house_receipts.status','house_receipts.start_date', 'house_managment.house_no','block.block_name as block',DB::raw('CONCAT(member_list.member_first_name," ",member_list.member_middle_name," ",member_list.member_last_name) as membername'))
                    ->get();
         
           // $members = Member::select(['id','member_first_name','member_middle_name','member_last_name','member_email','member_contect','status']);
             return Datatables::of($members)->addColumn('action', function ($members) {
                        $button= '<a href="#edit-'.$members->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        $button .='<a href="#delete-'.$members->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
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
                $timestamp    = strtotime('February 2012');
                $first_second = date('m-01-Y 00:00:00', $timestamp);
                $last_second  = date('m-t-Y 12:59:59', $timestamp); // A leap year
            }
        }
}