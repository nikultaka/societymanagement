
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
      <input type="hidden" name="house_managment_id" id="house_managment_id">
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
<!--                    <input type="text" placeholder="Please select date" name="date" id="date" readonly />-->
                    <select name="receipt_month" id="receipt_month">
                        <option value="01" {{ $current_month === "01" ? "Selected" : "" }}>January(1)</option>
                        <option value="02" {{ $current_month === "02" ? "Selected" : "" }}>February(2)</option>
                        <option value="03" {{ $current_month === "03" ? "Selected" : "" }}>March(3)</option>
                        <option value="04" {{ $current_month === "04" ? "Selected" : "" }}>April(4)</option>
                        <option value="05" {{ $current_month === "05" ? "Selected" : "" }}>May(5)</option>
                        <option value="06" {{ $current_month === "06" ? "Selected" : "" }}>June(6)</option>
                        <option value="07" {{ $current_month === "07" ? "Selected" : "" }}>July(7)</option>
                        <option value="08" {{ $current_month === "08" ? "Selected" : "" }}>August(8)</option>
                        <option value="09" {{ $current_month === "09" ? "Selected" : "" }}>September(9)</option>
                        <option value="10" {{ $current_month === "10" ? "Selected" : "" }}>October(10)</option>
                        <option value="11" {{ $current_month === "11" ? "Selected" : "" }}>November(11)</option>
                        <option value="12" {{ $current_month === "12" ? "Selected" : "" }}>December(12)</option>
                    </select>
                </div>
              </div>
                <div class="control-group">
                
                <div class="controls">
                     <select name="payment_type" id="payment_type">
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
          <button type="button" class="btn btn-default btn-success pull-left add-receipt_single">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  
    </div>

  </div>
</div>
</form>
