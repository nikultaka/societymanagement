<form id="myForm">

		{{ csrf_field() }}
<div id="mytrasferModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Trasfer Member</h4>
      </div>
     <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>
  <div class="modal-body ">
       <div style="float: left; width: 45%;">
          <div class="col-sm-6">
      <h5>Old Member Detail</h5>
      <div class="control-group">
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
            <div id="hosue_no">
          
            </div>
                
              </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Eneter Name" name="txt_fname" id="txt_fname">
                </div>
              </div>
                 <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Eneter Father`s Name" name="txt_mname" id="txt_mname">
                </div>
              </div>
            <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Eneter SurName" name="txt_lname" id="txt_lname">
                </div>
              </div>
             <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Enter Email" name="email" id="email">
                </div>
              </div>
                <div class="control-group">
                
                <div class="controls">
                    <input type="text" placeholder="Eneter Mobile No" name="number" id="number" />
                    <input type="hidden" id="owner_id">
                </div>
              </div>
              </div>
          </div>
           <div style="float: left; width: 45%;">
          <div class="col-sm-6">
      <h5>New Member Detail</h5>
      
              <div class="control-group">
                <div class="controls">
                    <div id="member_list">
          
            </div>
                </div>
              </div>
               
              </div>
          </div>
          </div>
     
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-success pull-left add-transfer">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  
    </div>

  </div>
</div>
</form>
<script src="{!! asset('js/transfer.js')!!}"></script>