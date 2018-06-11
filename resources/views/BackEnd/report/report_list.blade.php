@extends('BackEnd.dashboard')
@section('content')

  <div id="content-header">
<!--    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>-->
    <h1>Report List</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       
        <div class="input-group date form-group" >
            <b> Record List </b> <input data-provide="datepicker" name="start_date"> <b> To </b>
            <input data-provide="datepicker" name="end_date" id="end_date">
            <button type="button" id="report_list" class="btn btn-info btn-lg">Submit</button>
        </div>
        
        <div class="widget-box">
            
            
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Report Detail List Here </h5>
            <!--<button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#mydocumentModal">Add New Document</button>-->
<!--            <a href="addmember"> <span class="label label-info">Add Member</span></a>-->
          </div>

        </div>
        
        
      </div>
    </div>
  </div>

<script src="{!! asset('js/report.js')!!}"></script>
@stop