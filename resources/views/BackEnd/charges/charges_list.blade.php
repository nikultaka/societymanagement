@extends('BackEnd.dashboard')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Charges List</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Charges Detail List Here </h5>
             <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#mychargestypeModal">Add Charges Type</button>
<!--            <a href="addcharges"> <span class="label label-info">Add Charges</span></a> -->
          </div>
          <div class="widget-content ">
            <table class="table table-bordered table-striped with-check charges-table">
              <thead>
                <tr>
                  
                  <th>number</th>
                  <th>Block/wing</th>
                  <th>Charges type</th>
                  <th>Charges Amount</th>
                  <th>Description</th>
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

@include('BackEnd.charges.charges_add')
@stop