<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use App\Models\Block;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use App\Models\Expense;
use Yajra\Datatables\Datatables;
class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data_result=array();
        $block_list=Block::where('status', '=', 1)->get();
        $payment_type=DB::table('payment_type')->where('status', '=', 1)->get();
        $expense_type=DB::table('expense_type')->where('status', '=', 1)->get();
        $data_result['block_list']=$block_list;
        $data_result['payment_type']=$payment_type;
        $data_result['expense_type']=$expense_type;
        return View::make('BackEnd.expense.expense_list')->with($data_result);
    }
      public function anyData()
        {
          $expense=DB::table('expenses_list')
                    ->where('expenses_list.status',1)
                    ->join('block', 'expenses_list.block_id', '=', 'block.id')
                    ->join('expense_type', 'expenses_list.expense_type_id', '=', 'expense_type.id')
                    ->join('payment_type', 'expenses_list.payment_type_id', '=', 'payment_type.id')
                    
                    ->select('expenses_list.id','expenses_list.vender_name','expenses_list.ammount','expenses_list.payment_date','expenses_list.description', 'block.block_name','expense_type.expense_name','payment_type.payment_name')
                    ->get();
    
          
           // $members = Member::select(['id','member_first_name','member_middle_name','member_last_name','member_email','member_contect','status']);
             return Datatables::of($expense)->addColumn('action', function ($expense) {
                        $button= '<a href="javascript:void(0);" data-id="'.$expense->id.'" class="btn btn-xs btn-info btnEditExpense">Edit</a>  	&nbsp;';
                        $button .='<a onclick="delete_expense('.$expense->id.')" class="btn btn-xs btn-danger">Delete</a>';
                        return $button;
                    })
                    ->editColumn('id', '{{$id}}')
                    ->make(true);
        }
    public function addexpense(Request $request){
        $validator = Validator::make($request->all(), [
                'txt_vname' => 'required',
                'txt_amount' => 'required|numeric',
                'txt_payment_date' => 'required',
                'txt_description' => 'required',
                
                    ]);
            if ($validator->passes()) {
                $txt_vname = $request->input('txt_vname');
                $txt_amount = $request->input('txt_amount');
                $txt_payment_date = $request->input('txt_payment_date');
                $txt_description = $request->input('txt_description');
                $block_id = $_POST['block_id'];
                $expense_type_id=$_POST['expense_type_id'];
                $payment_type_id=$_POST['payment_type_id'];
                
                $data_insert = array();
                $data_insert['expense_type_id']=$expense_type_id;
                $data_insert['block_id']=$block_id;
                $data_insert['vender_name']=$txt_vname;
                $data_insert['ammount']=$txt_amount;
                $data_insert['payment_type_id']=$payment_type_id;
                $data_insert['payment_date']=$txt_payment_date;
                $data_insert['description']=$txt_description;
                
                $data_insert['status']=1;
                Expense::insert($data_insert);
                return response()->json(['success'=>'Added new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
    }
    public function addexpensestype(Request $request){
        $validator = Validator::make($request->all(), [
                'txt_expense_name' => 'required',
                    ]);
            if ($validator->passes()) {
                $txt_expense_name = $request->input('txt_expense_name');
                
                $data_insert = array();
                $data_insert['expense_name']=$txt_expense_name;
                $data_insert['status']=1;
                DB::table('expense_type')->insert($data_insert);
                
                return response()->json(['success'=>'Added new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
    }
    public function deleteexpense(){
        $id=$_POST['id'];
        if(isset($id) && $id !=''){
            DB::table('expenses_list')
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
    public function editexpense(){
        $id=$_POST['expense_id'];
        $expense =DB::table('expenses_list')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$expense;
        return $data_result;   
    }
    public function update_expense(Request $request){
        
        $validator = Validator::make($request->all(), [
                'txt_vname' => 'required',
                'txt_amount' => 'required|numeric',
                'txt_payment_date' => 'required',
                'txt_description' => 'required',
                
                    ]);
            if ($validator->passes()) {
                
                $txt_vname = $request->input('txt_vname');
                $txt_amount = $request->input('txt_amount');
                $txt_payment_date = $request->input('txt_payment_date');
                $txt_description = $request->input('txt_description');
                $block_id = $_POST['block_id'];
                $expense_type_id=$_POST['expense_type_id'];
                $payment_type_id=$_POST['payment_type_id'];
                $expense_id=$_POST['expenses_id'];
                
                $data_insert = array();
                $data_insert['expense_type_id']=$expense_type_id;
                $data_insert['block_id']=$block_id;
                $data_insert['vender_name']=$txt_vname;
                $data_insert['ammount']=$txt_amount;
                $data_insert['payment_type_id']=$payment_type_id;
                $data_insert['payment_date']=$txt_payment_date;
                $data_insert['description']=$txt_description;
                
                $data_insert['status']=1;
                
                DB::table('expenses_list')
                    ->where('id', $expense_id)
                    ->update($data_insert);
                
                
                return response()->json(['success'=>'Updated new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
    }
}