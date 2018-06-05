
<form id="payment_submitForm">

		{{ csrf_field() }}
<div id="Change_status_popup" class="modal fade" role="dialog" style="z-index: 1600;">
  <div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <input type="hidden" id="receipt_id_for_status" name="receipt_id_for_status">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Auto Receipt </h4>
      </div>
     <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>
  <div class="modal-body">
      <div class="control-group">
          <div class="controls">
              <b> <span style="font-size: 16px;">Name :</span></b><span id="user_name" style="font-size: 16px;"></span>
          </div>
      </div>
      <div class="control-group">
          <div class="controls">
              <b><span style="font-size: 16px;">Amount :</span></b><span id="amount" style="font-size: 16px;"></span>
          </div>
      </div>
      <div class="control-group">
          <div class="controls">
              <b><span style="font-size: 16px;">House Name :</span></b><span id="house_name" style="font-size: 16px;"></span>
          </div>
      </div>
      <div class="control-group">
          <div class="controls">
              <b><span style="font-size: 16px;">Start date of Month :</span></b><span id="start_date" style="font-size: 16px;"></span>
          </div>
      </div>
      <div class="control-group">
                
                <div class="controls">
                    <select name="payment_type" id="payment_type" onchange="get_chq_details(this.value);">
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
      <div class="control-group">
          <div class="controls chq_number">
              
          </div>
      </div>
      <div class="control-group">
          <div class="controls chq_bank_name">
              
          </div>
      </div>
      <div class="control-group">
          <div class="controls chq_bank_ifsc">
              
          </div>
      </div>
      
  </div>
     
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-success pull-left payment-status-change">PayNow</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  
    </div>

  </div>
</div>
</form>

