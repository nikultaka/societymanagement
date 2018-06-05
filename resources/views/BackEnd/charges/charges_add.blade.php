<style>
    .has-error{
        border: solid 1px red !important;
    }
</style>
<form id="myForm" >

    {{ csrf_field() }}
    <div id="mychargestypeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Expenses</h4>
                </div>
                <div class="alert alert-danger print-error-msg" style="display:none">

                    <ul></ul>

                </div>
                <div class="modal-body">

           
              <div class="control-group">
              <label class="control-label">Select Block/wing</label>
              <div class="controls">
                <select name="block_list" id="block_list">
                        <option value="0">---Select Expense Block---</option>
                         @if($block_list->count() > 0)
                        @foreach($block_list as $block)
                         <option  value="{{$block->id}}">{{$block->block_name}}</option>
                        @endForeach
                        @else
                         No Record Found
                          @endif   
                        
                        
                    </select> 
              </div>
            </div>
                 <div class="control-group">
              <div class="controls">
                  <input type="hidden" id="charges_id">
                  <input type="text" id="txt_charges_name" name="txt_charges_name" placeholder="Please Enter Charges Name">
              </div>
             
            </div>
                <div class="control-group">
                
                <div class="controls">
                    <input type="text" name="txt_charges_ammount" id="txt_charges_ammount" placeholder="Please Enter Charges Ammount">
                </div>
              </div>
                
        <div class="control-group">
            <div class="controls">
                <textarea rows="4" id="description" name="description" placeholder="Enter Description For Charges text ..."></textarea>
            </div>
          
        </div>
      
                </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-success pull-left add-charges">Add</button>
                    <button type="button" class="btn btn-default btn-success pull-left update-charges" style="display: none;">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
             </div>
        </div>
    </div>
</form>
<script src="{!! asset('js/charges.js')!!}"></script>
