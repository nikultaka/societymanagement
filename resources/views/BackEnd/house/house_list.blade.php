@extends('BackEnd.dashboard')
@section('content')
<div id="content">
  <div id="content-header">
<!--    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>-->
    <h1>House List</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>House Detail List Here </h5>
            <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#myHouseModal">Add house</button>
<!--            <a href="addmember"> <span class="label label-info">Add Member</span></a>-->
          </div>
          <div class="widget-content ">
            <table class="table table-bordered table-striped with-check house-table">
              <thead>
                <tr>
                  
                  <th>ID</th>
                  <th>Block Name</th>
                  <th>House No</th>
                  <th>Owner Name</th>
                  <th>Status</th>
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
</div>
@include('BackEnd.house.house_add')
@stop