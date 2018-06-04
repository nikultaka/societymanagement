@extends('BackEnd.dashboard')
@section('content')
 
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Trasfer List</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Transfer Detail List</h5>
            <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#mytrasferModal">Add Trasfer</button>
          </div>
          <div class="widget-content ">
            <table class="table table-bordered table-striped with-check trasfer-member-list">
              <thead>
                <tr>
                  
                  <th>Id</th>
                  <th>Block Name</th>
                  <th>House Name</th>
                  <th>Old Member Name</th>
                  <th>New Member Name</th>
                 <th>Update Date</th>
                 
<!--                 <th>Action</th>-->
                 
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

@include('BackEnd.transfer.transfer_add')
@stop