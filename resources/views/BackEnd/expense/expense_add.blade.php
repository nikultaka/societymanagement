<style>
    .has-error{
        border: solid 1px red !important;
    }
</style>
<form id="myForm" >

    {{ csrf_field() }}
    <div id="myexpenseModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Expenses</h4>
                </div>
                <div class="alert alert-danger print-error-msg" style="display:none">

                    <ul></ul>

                </div>
                <div class="modal-body">

                    <div class="control-group">
                        <label class="control-label">Expense Type</label>
                         <button type="button" class="btn btn-info btn-sm pull-left" data-toggle="modal" data-target="#myexpensetypeModal">Add Expnese Type</button>
                        <div class="controls">
                            <select name="expense_type" id="expense_type">
                                @if($expense_type->count() > 0)
                        @foreach($expense_type as $expense)
                         <option value="{{$expense->id}}">{{$expense->expense_name}}</option>
                        @endForeach
                        @else
                         No Record Found
                          @endif   
                            </select>
                            
                        </div>
                    </div>
                    <div class="controls">
                    <select name="block_list" id="block_list">
                        <option value="0">---Select Expense Block---</option>
                         @if($block_list->count() > 0)
                        @foreach($block_list as $block)
                         <option value="{{$block->id}}">{{$block->block_name}}</option>
                        @endForeach
                        @else
                         No Record Found
                          @endif   
                        
                        
                    </select> 
                </div>
                    <div class="control-group">
                        <div class="controls">
                            <input type="hidden" id="expenses_id">
                            <input type="text" placeholder="Please Enter Vender Name" name="txt_vname" id="txt_vname">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <input type="text" placeholder="Please Enter Ammount" name="txt_amount" id="txt_amount">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Payment Type</label>
                        <div class="controls">
                            <select name="payment_type" class="selectpicker" data-live-search="true" id="payment_type">
                               
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
                        <label>Select Date: </label>
                        <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                            <input class="form-control" type="text" id="txt_payment_date" name="txt_payment_date"/>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <textarea  style="width: 204px;" id="txt_description" name="txt_description" rows="4" placeholder="Enter text ..."></textarea>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-success pull-left add-expense">Add</button>
                    <button type="button" class="btn btn-default btn-success pull-left update-expense" style="display: none;">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{!! asset('js/expense.js')!!}"></script>
