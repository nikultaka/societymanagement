<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use App\Models\Block;
use Illuminate\Http\Request;
use Validator;
use App\Models\Charges;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
class ChargesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data_result=array();
        $block_list=Block::where('status', '=', 1)->get();
        $data_result['block_list']=$block_list;
        return View::make('BackEnd.charges.charges_list')->with($data_result);
    }
     public function anyData()
        {
          $charges=DB::table('charges_list')
                    ->where('charges_list.status',1)
                    ->join('block', 'charges_list.block_id', '=', 'block.id')
                    ->select('charges_list.*', 'block.block_name')
                    ->get();
          
           // $members = Member::select(['id','member_first_name','member_middle_name','member_last_name','member_email','member_contect','status']);
             return Datatables::of($charges)->editColumn('status', function($data) {
                                return ($data->status == 1) ? trans('Active'): trans('Inactive');
                                })
                        ->addColumn('action', function ($charges) {
                        $button= '<a href="javascript:void(0);" data-id="'.$charges->id.'" class="btn btn-xs btn-info btnEditCharges"> Edit</a>  	&nbsp;';
                        $button .='<a onclick="delete_charges('.$charges->id.')" class="btn btn-xs btn-danger"> Delete</a>';
                        return $button;
                    })
                    ->editColumn('id', '{{$id}}')
                    ->make(true);
        }
    public function addcharges(Request $request){
        $validator = Validator::make($request->all(), [
                'txt_charges_name' => 'required',
                'txt_charges_ammount' => 'required|numeric',
                'description' => 'required',
                
                    ]);
            if ($validator->passes()) {
                $txt_charges_name = $request->input('txt_charges_name');
                $txt_charges_ammount = $request->input('txt_charges_ammount');
                $description = $request->input('description');
                $block_id = $_POST['block_id'];
                
                
                $data_insert = array();
                $data_insert['block_id']=$block_id;
                $data_insert['charges_name']=$txt_charges_name;
                $data_insert['charges_ammount']=$txt_charges_ammount;
                $data_insert['description']=$description;
                
                
                $data_insert['status']=1;
                Charges::insert($data_insert);
                return response()->json(['success'=>'Added new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
    }
     public function deletecharges(){
        $id=$_POST['id'];
        if(isset($id) && $id !=''){
            DB::table('charges_list')
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
    public function editcharges(){
        $id=$_POST['charges_id'];
        $charges =DB::table('charges_list')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$charges;
        return $data_result;   
    }
    public function updatecharges(Request $request){
        $validator = Validator::make($request->all(), [
                'txt_charges_name' => 'required',
                'txt_charges_ammount' => 'required|numeric',
                'description' => 'required',
                
                    ]);
            if ($validator->passes()) {
                $txt_charges_name = $request->input('txt_charges_name');
                $txt_charges_ammount = $request->input('txt_charges_ammount');
                $description = $request->input('description');
                $block_id = $_POST['block_id'];
                $charges_id=$_POST['charges_id'];
                
                $data_insert = array();
                $data_insert['block_id']=$block_id;
                $data_insert['charges_name']=$txt_charges_name;
                $data_insert['charges_ammount']=$txt_charges_ammount;
                $data_insert['description']=$description;
                
                $data_insert['status']=1;
                DB::table('charges_list')
                    ->where('id', $charges_id)
                    ->update($data_insert);
                return response()->json(['success'=>'Updated new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
    }

}