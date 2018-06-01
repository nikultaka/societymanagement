@extends('BackEnd.dashboard')
@section('content')


  <div id="content-header">
<!--    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>-->
    <h1>Block List</h1>
  </div>
  
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Block Detail List Here </h5>
            <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#myblockModal" data-id="0">Add New Block</button>
<!--            <a href="addblock"> <span class="label label-info">Add Block Category</span></a> -->
          </div>
          <div class="widget-content ">
            <table class="table table-bordered table-striped with-check block-table" id="block-table">
              <thead>
                <tr>
                  
                  <th>number</th>
                  <th>Block Name</th>
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

<!--<script type="text/javascript">
    jQuery(document).ready(function(){
     
    
    jQuery('.block-table').DataTable({
        
        processing: true,
        serverSide: true,
       ajax: '{{ route('block/getdata') }}',
        columns: [
           
            { data: 'id', name: 'id',"width": "10%" },
            { data: 'block_name', name: 'block_name',"width": "60%" },
            {data: 'action', name: 'action', orderable: false, searchable: false,"width": "30%"},
           
        ]
    });

    });
</script>-->

@include('BackEnd.block.block_add')
@stop