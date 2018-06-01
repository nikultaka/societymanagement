
<form id="myautoreceiptForm">

		{{ csrf_field() }}
<div id="myreceiptautogenrate" class="modal fade" role="dialog" style="z-index: 1600;">
  <div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Auto Receipt </h4>
      </div>
     <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>
  <div class="modal-body">
        <div class="control-group">
            <label class="control-label">Select Member Block</label>
            <select name="block_list" id="block_list" onchange="getchargestype(this.value);">
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
      <div class="control-group charges-type-by-block" style="display: none;">
            <label class="control-label">Select Charges type</label>
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

<script src="{!! asset('js/receipt.js')!!}"></script>