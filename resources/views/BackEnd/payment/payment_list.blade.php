@extends('BackEnd.dashboard')
@section('content')

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
            <a href="addpaymentreceipt"> <span class="label label-info">Add</span></a>
            <a href="addpayment"> <span class="label label-info">Add Payment</span></a> </div>
          <div class="widget-content ">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  
                  <th>Id</th>
                  <th>Title</th>
                  <th>Member Name</th>
                  <th>paid Amount</th>
                  <th>Remaining Amount</th>
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


@stop