@extends('BackEnd.dashboard')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Expneses List</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Expnese Detail List Here </h5>
            <button type="button" class="btn btn-info btn-lg pull-right" style="margin-left: 10px;" data-toggle="modal" data-target="#myexpenseModal">Add Expneses</button>
             <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myexpensetypeModal">Add Expnese Type</button>

          </div>
          <div class="widget-content ">
            <table class="table table-bordered table-striped with-check expenses-table">
              <thead>
                <tr>
                  
                  <th>id</th>
                  <th>Expense Type</th>
                  <th>Block Name</th>
                  <th>Payment Type</th>
                 <th>Vender Name</th>
                 <th>Ammount</th>
                 <th>Payment Date</th>
                 <th>Description</th>
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
@include('BackEnd.expense.expense_add')
@include('BackEnd.expense.expense_type_add')
@stop