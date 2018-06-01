
<form id="myautoreceiptForm">

		{{ csrf_field() }}
<div id="Change_status_popup" class="modal fade" role="dialog" style="z-index: 1600;">
  <div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <input type="hidden" id="receipt_id_for_status">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Auto Receipt </h4>
      </div>
     <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>
  <div class="modal-body">
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
          <button type="button" class="btn btn-default btn-success pull-left apply-charges-by-block">Apply Charges</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  
    </div>

  </div>
</div>
</form>

