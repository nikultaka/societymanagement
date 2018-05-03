<style>
    .has-error{
        border: solid 1px red !important;
    }
</style>

<form id="myForm">

		{{ csrf_field() }}
<div id="mymemberModal" class="modal fade" role="dialog" style="z-index: 1600;">
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
                    <input type="text" placeholder="Enter Name *" name="txt_fname" id="txt_fname"> *
                </div>
              </div>
                 <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Enter Father`s Name *" name="txt_mname" id="txt_mname"> *
                </div>
              </div>
            <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Enter SurName *" name="txt_lname" id="txt_lname"> *
                </div>
              </div>
             <div class="control-group">
                <div class="controls">
                    <input type="text" placeholder="Enter Email *" name="email" id="email"> *
                </div>
              </div>
                <div class="control-group">
                
                <div class="controls">
                    <input type="hidden" id="member_id">
                    <input type="text" placeholder="Enter Mobile No *" name="number" id="number" /> *
                </div>
              </div>
              
               
          </div>
     
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-success pull-left add-member">Add</button>
          <button type="button"  class="btn btn-default btn-success pull-left Update-member" style="display: none;" >Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  
    </div>

  </div>
</div>
</form>
<script src="{!! asset('js/member.js')!!}"></script>