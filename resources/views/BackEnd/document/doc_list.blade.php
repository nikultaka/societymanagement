@extends('BackEnd.dashboard')
@section('content')

  <div id="content-header">
<!--    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>-->
    <h1>Document List</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Document Detail List Here </h5>
            <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#mydocumentModal">Add New Document</button>
<!--            <a href="addmember"> <span class="label label-info">Add Member</span></a>-->
          </div>
          <div class="widget-content ">
            <table class="table table-bordered table-striped with-check doc-table">
              <thead>
                <tr>
                  
                  <th>ID</th>
                  <th>Title</th>
                  <th>Document</th>
                  <th>description</th>
                  <th>status</th>
                  <th>Action</th>
                 
                </tr>
              </thead>
              <tbody>
               
              </tbody>
            </table>
          </div>
        </div>
        
        
      </div>
    </div>
  </div>

@include('BackEnd.document.doc_add')
@stop