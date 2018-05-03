@extends('BackEnd.dashboard')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Payment</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Payment Detail List Here </h5>
           
            <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#myreceiptModal">Add New Receipt</button>
          </div>
          <div class="widget-content ">
            <table class="table table-bordered table-striped with-check receipt_list">
              <thead>
                <tr>
                  
                  <th>Id</th>
                  <th>Block No</th>
                  <th>House Number</th>
                  <th>Member Name</th>
                  <th>Charge Month</th>
                  
                 <th>Paid/Unpaid</th>
                 
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
@include('BackEnd.receipt.receipt_add')
@stop