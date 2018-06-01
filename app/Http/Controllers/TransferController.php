<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Member;
use App\Models\Block;
use Validator;
use Illuminate\Support\Facades\DB;
class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
         $data_result=array();
        $block_list=Block::where('status', '=', 1)->get();
        $data_result['block_list']=$block_list;
        $payment_type=DB::table('payment_type')->where('status', '=', 1)->get();
        $data_result['payment_type']=$payment_type;
        return View::make('BackEnd.transfer.transfer_list')->with($data_result);
    }
      public function anyData()
        {
          $members=DB::table('member_list')
                    ->join('block', 'member_list.member_block_id', '=', 'block.id')
                    ->select('member_list.*', 'block.block_name')
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
        public function savenewhouse(){
            $block_id=$_POST['block_id'];
            $house_no=$_POST['house_no'];
            $new_member_id=$_POST['new_member_id'];
            $old_owner_id=$_POST['old_owner_id'];
            
            DB::table('house_managment')
            ->where('house_block_id', $block_id)
            ->where('house_no', $house_no) 
            ->where('owner_id', $old_owner_id) 
            ->update(['status' => 2]);
           // DB::table('house_managment')
            
        }
}