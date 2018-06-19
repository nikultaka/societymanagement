@extends('BackEnd.dashboard')
@section('content')

<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.18/api/sum().js"></script>

<style>
    .has-error{
        border: 1px solid red !important;
    }
</style>

  <div id="content-header">
<!--    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>-->
    <h1>Report List</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       <form  method="Post" id="formForGetBalance" onsubmit="return false;" class="form-horizontal">
                {{ csrf_field() }}
        <div class="input-group date form-group" >
        <b> Record List </b> <input data-provide="datepicker" name="start_date" id="start_date"> <b> To </b>
            <input data-provide="datepicker" name="end_date" id="end_date">
            <button type="button" class="btn btn-info btn-lg btnGetReportForIncomeBalance">Submit</button>
        </div>
        </form>
        
        <div class="widget-box">
            
            
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Report Detail List Here </h5>
            <table class="table table-bordered table-striped with-check Incomesearch_list">
              <thead>
                <tr>
                  
                  <th>Id</th>
                  <th>House Name</th>
                  <th>Charges</th>
                  <th>Charges Amount</th>
                  <th>Member Name</th>
                  <th>Member SurName</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>status</th>
                  <th>Date created</th>  
                </tr>
              </thead>
              <tbody>
               
              </tbody>
              <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th>Total:</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
            </table>
          
          </div>

        </div>
        
        
      </div>
    </div>
  </div>

<script src="{!! asset('js/report.js')!!}"></script>
@stop