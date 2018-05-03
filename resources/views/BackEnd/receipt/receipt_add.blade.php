
<form id="myForm">

		{{ csrf_field() }}
<div id="myreceiptModal" class="modal fade" role="dialog" style="z-index: 1600;">
  <div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Member</h4>
      </div>
     <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>
  <div class="modal-body">
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
          
              </div>
      <div id="hosue_no">
          
      </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Eneter Name" name="txt_fname" id="txt_fname" readonly>
                </div>
              </div>
                 <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Eneter Father`s Name" name="txt_mname" id="txt_mname" readonly>
                </div>
              </div>
            <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Eneter SurName" name="txt_lname" id="txt_lname" readonly>
                </div>
              </div>
             <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Enter Email" name="email" id="email" readonly>
                </div>
              </div>
                <div class="control-group">
                
                <div class="controls">
                    <input type="text" placeholder="Eneter Mobile No" name="number" id="number" readonly />
                </div>
              </div>
               <div class="control-group">
                
                <div class="controls">
                    <input type="text" placeholder="Please select date" name="date" id="date" readonly />
                </div>
              </div>
                <div class="control-group">
                
                <div class="controls">
                     <select name="block_list" id="payment_type">
                        <option value="0">---Select Payment type---</option>
                         @if($payment_type->count() > 0)
                        @foreach($payment_type as $payment)
                         <option value="{{$payment->id}}">{{$payment->payment_name}}</option>
                        @endForeach
                        @else
                         No Record Found
                          @endif   
                        
                        
                    </select> 
                </div>
              </div>
               
          </div>
     
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-success pull-left add-member">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  
    </div>

  </div>
</div>
</form>
<script src="{!! asset('js/receipt.js')!!}"></script>