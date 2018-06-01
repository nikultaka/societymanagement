<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Member;
use App\Models\Block;
use Validator;
use Illuminate\Support\Facades\DB;
class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data_result=array();
        $block_list=Block::where('status', '=', 1)->get();
        $data_result['block_list']=$block_list;
        return View::make('BackEnd.member.member_list')->with($data_result);
    }
    public function anyData()
        {
          $members=DB::table('member_list')
                    ->select('member_list.*')
                    ->where('status',1)
                    ->get();
            
           // $members = Member::select(['id','member_first_name','member_middle_name','member_last_name','member_email','member_contect','status']);
             return Datatables::of($members)->editColumn('status', function($data) {
                                return ($data->status == 1) ? trans('Active'): trans('Inactive');
                                })
                                ->addColumn('action', function ($members) {
                                $button= '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$members->id.'" class="btn btn-xs btn-info btnEditMember"> Edit</a>  	&nbsp;';
                                $button .='<a onclick="delete_member('.$members->id.')" class="btn btn-xs btn-danger"> Delete</a></div>';
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
                
                
                
                $data_insert = array();
                $data_insert['member_first_name']=$txt_fname;
                $data_insert['member_middle_name']=$txt_mname;
                $data_insert['member_last_name']=$txt_lname;
                $data_insert['member_email']=$email;
                $data_insert['member_contect']=$number;
                $data_insert['member_password']='';
                
                
                $data_insert['status']=1;
                Member::insert($data_insert);
                return response()->json(['success'=>'Added new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
    }
    public function editmember(){
        $id=$_POST['member_id'];
        $member =DB::table('member_list')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$member;
        return $data_result;   
    }
    public function updatemember(Request $request){
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
                $member_id=$request->input('member_id');
                
                
                $data_insert = array();
                $data_insert['member_first_name']=$txt_fname;
                $data_insert['member_middle_name']=$txt_mname;
                $data_insert['member_last_name']=$txt_lname;
                $data_insert['member_email']=$email;
                $data_insert['member_contect']=$number;
                $data_insert['member_password']='';
                
                $data_insert['status']=1;
                DB::table('member_list')
                    ->where('id', $member_id)
                    ->update($data_insert);
                return response()->json(['success'=>'Record Update Successfully.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
    }
    public function deletemember(){
        $id=$_POST['id'];
        if(isset($id) && $id !=''){
            DB::table('member_list')
                    ->where('id', $id)
                    ->update(array('status'=>-1));
        $data_result=array();
        $data_result['status']=1;
        $data_result['msg']="Record deleted success.";
        
        return $data_result;
        }
        else {
            return response()->json(['error'=>'record Not Found']);
        }
    }
}