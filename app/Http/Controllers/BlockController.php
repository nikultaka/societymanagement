<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Block;
use Validator;
use Illuminate\Support\Facades\DB;
class BlockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('BackEnd.block.block_list');
      
    }
    public function getlist()
{
    $blocks = Block::select(['id','block_name'])->where('status','=',1);
    
     return Datatables::of($blocks)->editColumn('status', function($data) {
                                return ($data->status == 1) ? trans('Active'): trans('Inactive');
                                })
                            ->addColumn('action', function ($blocks) {
                            $button= '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$blocks->id.'" class="btn btn-xs btn-info btnEditBlock"> Edit</a>  	&nbsp;';
                            $button .='<a onclick="delete_block('.$blocks->id.')" class="btn btn-xs btn-danger"> Delete</a></div>';
                            return $button;
                            })
                            ->editColumn('id', '{{$id}}')
                            ->make(true);
}
    public function addblock(Request $request){
         $validator = Validator::make($request->all(), [
                      'txt_block_name' => 'required',
                    ]);
            if ($validator->passes()) {
                $block_name = $request->input('txt_block_name');
                $data_insert = array();
                $data_insert['block_name']=$block_name;
                $data_insert['status']=1;
                Block::insert($data_insert);
                return response()->json(['success'=>'Added new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);   
    }
    public function deleteblock(){
        $id=$_POST['id'];
        if(isset($id) && $id !=''){
        Block::where('id',$id)->update(array('status'=>-1));
        $data_result=array();
        $data_result['status']=1;
        $data_result['msg']="record deleted success.";
        
        return $data_result;
        }
    else {
        return response()->json(['error'=>'record Not Found']);
    }
    }
    public function editblock(){
        $id=$_POST['block_id'];
        $blocks = Block::select(['id','block_name'])->where('id','=',$id)->first();
        
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$blocks;
        return $data_result;
    }
    public function updateblock(Request $request){
         $validator = Validator::make($request->all(), [
                      'txt_block_name' => 'required',
                    ]);
            if ($validator->passes()) {
                $block_name = $request->input('txt_block_name');
                $block_id = $request->input('block_id');
                $data_insert = array();
                $data_insert['block_name']=$block_name;
                $data_insert['status']=1;
                DB::table('block')
                    ->where('id', $block_id)
                    ->update($data_insert);
                //Block::update($data_insert);
                return response()->json(['success'=>'Record Update Successfully.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);   
    }
}