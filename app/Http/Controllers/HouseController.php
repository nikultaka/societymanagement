<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Member;
use App\Models\Block;
use App\Models\House;
use Validator;
use Illuminate\Support\Facades\DB;
class HouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data_result=array();
        $block_list=Block::where('status', '=', 1)->get();
        $member_list= Member::get();
        $data_result['block_list']=$block_list;
        $data_result['member_list']=$member_list;
        return View::make('BackEnd.house.house_list')->with($data_result);
    }
      public function anyData()
        {
          $members=DB::table('house_managment')
                    ->where('house_managment.status',1)
                    ->join('block', 'house_managment.house_block_id', '=', 'block.id')
                    ->join('member_list', 'house_managment.owner_id', '=', 'member_list.id')
                   // ->join('member_list', 'house_managment.rental_id', '=', 'member_list.id')
                    ->select('house_managment.id','house_managment.house_no','house_managment.status', 'block.block_name as block_name',  DB::raw('CONCAT(member_list.member_first_name," ",member_list.member_middle_name," ",member_list.member_last_name) as name'))
                    ->get();
        
           // $members = Member::select(['id','member_first_name','member_middle_name','member_last_name','member_email','member_contect','status']);
             return Datatables::of($members)->editColumn('status', function($data) {
                                return ($data->status == 1) ? trans('Active'): trans('Inactive');
                                })
                        ->addColumn('action', function ($members) {
                        $button= '<a href="javascript:void(0);" data-id="'.$members->id.'" class="btn btn-xs btn-info btnEditHouse"> Edit</a>  	&nbsp;';
                        $button .='<a onclick="delete_house('.$members->id.')" class="btn btn-xs btn-danger"> Delete</a>';
                        return $button;
                    })
                    ->editColumn('id', '{{$id}}')
                    ->make(true);
        }
    public function addmember(Request $request){
            $validator = Validator::make($request->all(), [
                'txt_house_no' => 'required',
                    ]);
            if ($validator->passes()) {
                $txt_house_no = $request->input('txt_house_no');
                $rental_id = $_POST['rental_id'];
                $owner_id = $_POST['owner_id'];
                $block_id = $_POST['block_id'];
                
                
                $data_insert = array();
                $data_insert['house_block_id']=$block_id;
                $data_insert['house_no']=$txt_house_no;
                $data_insert['owner_id']=$owner_id;
                $data_insert['rental_id']=$rental_id;
                $data_insert['status']=1;
                House::insert($data_insert);
                return response()->json(['success'=>'Added new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
    }
    public function deletehouse(){
        $id=$_POST['id'];
        if(isset($id) && $id !=''){
            DB::table('house_managment')
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
    public function edithouse(){
        $id=$_POST['house_id'];
        $member =DB::table('house_managment')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$member;
        return $data_result;   
    }
    public function updatehouse(Request $request){
        $validator = Validator::make($request->all(), [
                'txt_house_no' => 'required',
                    ]);
            if ($validator->passes()) {
                $txt_house_no = $request->input('txt_house_no');
                $rental_id = $_POST['rental_id'];
                $owner_id = $_POST['owner_id'];
                $block_id = $_POST['block_id'];
                $house_id=$_POST['house_id'];
                
                
                $data_insert = array();
                $data_insert['house_block_id']=$block_id;
                $data_insert['house_no']=$txt_house_no;
                $data_insert['owner_id']=$owner_id;
                $data_insert['rental_id']=$rental_id;
                $data_insert['status']=1;
                DB::table('house_managment')
                    ->where('id', $house_id)
                    ->update($data_insert);
                
                return response()->json(['success'=>'Updated new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
    }
}