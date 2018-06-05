<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Document;
use Validator;
use Illuminate\Support\Facades\DB;


class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        
        $data_result=array();
        $doc_list=Document::where('status', '=', 1)->get();
        $data_result['doc_list']=$doc_list;
        return View::make('BackEnd.document.doc_list')->with($data_result);
      
    }
   
    public function anyData()
        {
          $document=DB::table('document_detail')
                    ->select('*')
                    ->where('status',1)
                    ->get();
          
             return Datatables::of($document)->editColumn('status', function($data) {
                                return ($data->status == 1)
                                ? trans('Active'): trans('Inactive');
                                })
                                ->addColumn('action', function ($document) {
                                $button= '<div class="datatable_btn"><a target="_blank" href="upload/'.$document->document.'" data-id="'.$document->id.'" class="btn btn-xs btn-info"> Download</a> &nbsp;';
                                $button .='<a onclick="delete_document('.$document->id.')" class="btn btn-xs btn-danger"> Delete</a></div>';
                                return $button;
                    })
                    
                    ->editColumn('id', '{{$id}}')
                    ->make(true);
        }
        
    public function adddocument(Request $request){
        

            $filename  = basename($_FILES['doc_upload']['name']);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            
            $validator = Validator::make($request->all(), [
                'txt_title' => 'required',
                'doc_upload' => 'required',
                'txt_des' => 'required',
                
                    ]);
            if ($validator->passes()) {
                $product = new Document($request->input()) ;
          
               
                if($file = $request->hasFile('doc_upload')) {
                    
                    $file = $request->file('doc_upload') ;
                    
                    $destinationPath = public_path().'/upload/';
                    $uniquesavename=time().uniqid(rand());
                    $destFile = $uniquesavename . '.'.$extension;
                    $file->move($destinationPath,$destFile);
                    $product->doc_upload = $destFile ;
                 }
                 
                $txt_title = $request->input('txt_title');
                $doc_upload = $destFile;
                $txt_des = $request->input('txt_des');
                
                $data_insert = array();
                $data_insert['title']=$txt_title;
                $data_insert['document']=$doc_upload;
                $data_insert['description']=$txt_des;

                $data_insert['status']=1;
                
                Document::insert($data_insert);
                return response()->json(['success'=>'Added new records.']);
                }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
    }
    
    public function deletedocument(){
        $id=$_POST['id'];
        if(isset($id) && $id !=''){
            DB::table('document_detail')
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

