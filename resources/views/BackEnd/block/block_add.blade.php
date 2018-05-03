
<form id="myform" data-toggle="validator" role="form">

		{{ csrf_field() }}
<div id="myblockModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Block</h4>
      </div>
        <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>
      <div class="modal-body">
         
        <div class="control-group">
                <label class="control-label">Block Name</label>
                <div class="controls">
                    <input type="hidden" id="block_id"> 
                <input type="text" class="form-control" id="txt_block_name" name="txt_block_name" placeholder="Enter Block Name" required>
                 
                </div>
         </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-success pull-left add-block">Add</button>
          <button type="button"  class="btn btn-default btn-success pull-left Update-block" style="display: none;" >Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        </form>
<script src="{!! asset('js/block.js')!!}"></script>