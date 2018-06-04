@extends('BackEnd.dashboard')
@section('content')
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
                  </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-success search-details">Save</button>
            </div>
          </form>
        </div>
      </div>
     
    </div>
    
  </div>
  
</div>
<script src="{!! asset('js/search.js')!!}"></script>
@stop