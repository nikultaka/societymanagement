<form>
{{ csrf_field() }}
<div id="myexpensetypeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Expense Type</h4>
        
      </div>
        <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>
      <div class="modal-body">
        <div class="control-group">
                <label class="control-label">Expense Name</label>
                <div class="controls">
                <input type="text" class="form-control" id="txt_expense_name" name="txt_expense_name" placeholder="Enter Expense Name" required>
                 
                </div>
         </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-success pull-left add-expanse-type">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</form>