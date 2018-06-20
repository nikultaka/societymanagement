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
<div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Search Form</h1>
  </div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      
      <div class="widget-box">
        
        <div class="widget-content nopadding">
            <form  method="Post" id="search_form" onsubmit="return false;" class="form-horizontal">
                {{ csrf_field() }}
              <div class="row">
            <div class="control-group col-sm-6">
              <label class="control-label">Select Block/wing</label>
              <div class="controls">
                <select name="block_list" id="block_list" onchange="gethouseno(this.value);">
                        <option value="0">---Select Member Block---</option>
                         @if($block_list->count() > 0)
                        @foreach($block_list as $block)
                         <option value="{{$block->id}}">{{$block->block_name}}</option>
                        @endForeach
                        @else
                         No Record Found
                          @endif   
                        
                        
                </select> 
              </div>
              
            </div>
              <div class="control-group get-house-list col-sm-6" style="display: none;">
              <label class="control-label">Select House</label>
              <div class="controls get-house-list-div" id="hosue_no">
                
              </div>
            </div>
                <div class="control-group get-house-list col-sm-6">
                  <label class="control-label">Select Month</label>
                  <div class="controls get-house-list-div" id="month_no">
                      <select name="select_month" id="select_month">
                        <option value="0">---Select Month---</option>
                        <option value="01">January(1)</option>
                        <option value="02">February(2)</option>
                        <option value="03">March(3)</option>
                        <option value="04">April(4)</option>
                        <option value="05">May(5)</option>
                        <option value="06">June(6)</option>
                        <option value="07">July(7)</option>
                        <option value="08">August(8)</option>
                        <option value="09">September(9)</option>
                        <option value="10">October(10)</option>
                        <option value="11">November(11)</option>
                        <option value="12">December(12)</option>
                    </select>

                  </div>
                </div>
                  </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-success search-details">Search</button>
            </div>
          </form>
        </div>
      </div>
     
    
          <table class="table table-bordered table-striped with-check search_list ">
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
<script src="{!! asset('js/search.js')!!}"></script>
@stop