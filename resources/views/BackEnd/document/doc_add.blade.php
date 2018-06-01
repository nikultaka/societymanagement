<style>
    .has-error{
        border: solid 1px red !important;
    }
</style>

<form id="myDocm" name="myDocm" action="" onsubmit="return false" enctype="multipart/form-data">

		{{ csrf_field() }}
<div id="mydocumentModal" class="modal fade" role="dialog" style="z-index: 1600;">
  <div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add document</h4>
      </div>
     <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>
    <div class="modal-body">
      
            <div class="control-group">
                <div class="controls">
                    <input class="form-control" type="text" placeholder="Enter Title *" name="txt_title" id="txt_title"> *
                </div>
            </div>
            <div class="control-group">
                <div class="controls">

                    <input type="file" name="doc_upload" id="doc_upload" >

              </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <textarea rows="5" placeholder="Enter Description *" name="txt_des" id="txt_des"></textarea>*
                </div>
            </div>               
    </div>
     
      <div class="modal-footer">
          <button type="button" value="upload" class="btn btn-default btn-success pull-left add-document">Add</button>
          <!--<button type="button"  class="btn btn-default btn-success pull-left Update-member" style="display: none;" >Update</button>-->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  
    </div>

  </div>
</div>
</form>
<script src="{!! asset('js/document.js')!!}"></script>