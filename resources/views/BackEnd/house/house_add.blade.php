<style>
    .has-error{
        border: solid 1px red !important;
    }
</style>
<form id="myForm">

		{{ csrf_field() }}
<div id="myHouseModal" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add House</h4>
      </div>
     <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>
  <div class="modal-body">
      <div class="control-group">
                
                <div class="controls">
                    <select name="block_list" id="block_list">
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
              <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Enter House Name" name="txt_house_no" id="txt_house_no">
                    <input type="hidden" id="house_id">
                </div>
              </div>
              <div class="controls">
                    <select name="Member_list" id="Owner_list">
                        <option value="0">---Select Owner Name---</option>
                         @if($member_list->count() > 0)
                        @foreach($member_list as $member)
                         <option value="{{$member->id}}">{{$member->member_first_name }}  {{$member->member_middle_name }}  {{$member->member_last_name }}</option>
                        @endForeach
                        @else
                         No Record Found
                          @endif   
                        
                        
                    </select> 
                  <a href="member">Add New Member</a>
                </div>
                <div class="control-group">
                <div class="controls">
                    <span>Please Select for rental record..!</span>
                    <input type="checkbox" name="chk_rental" id="chk_rental" onclick="rental_detail()">
                </div>
                </div>
                <div class="controls">
                    <select name="Member_list" id="Rentail_list" style="display: none;">
                        <option value="0">---Select Rental Name---</option>
                        @if($member_list->count() > 0)
                        @foreach($member_list as $member)
                         <option value="{{$member->id}}">{{$member->member_first_name }}  {{$member->member_middle_name }}  {{$member->member_last_name }}</option>
                        @endForeach
                        @else
                         No Record Found
                          @endif   
                        
                        
                    </select> 
                </div>
          </div>
     
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-success pull-left add-house">Add</button>
          <button type="button"  class="btn btn-default btn-success pull-left update-house" style="display: none;" >Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  
    </div>

  </div>
</div>
</form>

<script src="{!! asset('js/house.js')!!}"></script>
