var table= jQuery('.expenses-table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: $('#base_url').val()+'expense/getdata',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'expense_name', name: 'expense_name'},
                        { data: 'block_name', name: 'block_name'},
                        { data: 'payment_name', name: 'payment_name'},
                        { data: 'vender_name', name: 'vender_name'},
                        { data: 'ammount', name: 'ammount'},
                        { data: 'payment_date', name: 'payment_date'},
                        { data: 'description', name: 'description'},
                        
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
                            initComplete: function(settings, json) {
                        refreshJsexpense();
                    }        
    });  
$(document).ready(function() {
  
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
           table.ajax.reload();
            $(".add-expense").click(function(e){
                
                e.preventDefault();
                var block = document.getElementById("block_list");
                var ex = document.getElementById("expense_type");
                var pa = document.getElementById("payment_type");
                
                var block_id = block.options[block.selectedIndex].value;
                var expense_type_id = ex.options[ex.selectedIndex].value;
                var payment_type_id = pa.options[pa.selectedIndex].value;
                var _token = $("input[name='_token']").val();
                var txt_vname = $("input[name='txt_vname']").val();
                var txt_amount = $("input[name='txt_amount']").val();
                var txt_payment_date = $("input[name='txt_payment_date']").val();
                var txt_description = $("textarea[name='txt_description']").val();
                var count_error = 0;
                if (block_id == 0) {
                    
                     $("select[name='block_list']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='block_list']").removeClass('has-error');
                }
                if (expense_type_id == 0) {
                    
                     $("select[name='expense_type']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='expense_type']").removeClass('has-error');
                }
                if (payment_type_id == 0) {
                    
                     $("select[name='payment_type']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='payment_type']").removeClass('has-error');
                }
                if (txt_vname.trim() == '') {
                    $("input[name='txt_vname']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_vname']").removeClass('has-error');
                }
                if (txt_amount.trim() == '') {
                    $("input[name='txt_amount']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_amount']").removeClass('has-error');
                }
                if (txt_payment_date.trim() == '') {
                    $("input[name='txt_payment_date']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_payment_date']").removeClass('has-error');
                }
                if (txt_description.trim() == '') {
                    $("textarea[name='txt_description']").addClass('has-error');
                    count_error++;
                } else{
                    $("textarea[name='txt_description']").removeClass('has-error');
                }
                
                
              if(count_error == 0){
                
               
                $.ajax({
                    url: $('#base_url').val()+"expense",
                    type:'POST',
                    data: {_token:_token, block_id:block_id, expense_type_id:expense_type_id, payment_type_id:payment_type_id, txt_vname:txt_vname, txt_amount:txt_amount, txt_payment_date:txt_payment_date,txt_description:txt_description},
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                                printSuccessMsg(data.success);
                                table.ajax.reload();
                                $('#myForm')[0].reset();
                        }else{
                                printErrorMsg(data.error);
                        }
                    }
                });
            }
            else{
                 return false;
            }
            });
            $(".add-expanse-type").click(function(e){
                
                e.preventDefault();
                var count_error = 0;
                var _token = $("input[name='_token']").val();
                var txt_expense_name = $("input[name='txt_expense_name']").val();
               if (txt_expense_name.trim() == '') {
                    $("input[name='txt_expense_name']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_expense_name']").removeClass('has-error');
                }
               if(count_error == 0){
                $.ajax({
                    url: $('#base_url').val()+"expensestype",
                    type:'POST',
                    data: {_token:_token, txt_expense_name:txt_expense_name},
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                                printSuccessMsg(data.success);
                                table.ajax.reload();
                                $('#myForm')[0].reset();
                        }else{
                                printErrorMsg(data.error);
                        }
                    }
                });
            }
            else{
                return false;
            }
            });
            $(".update-expense").click(function (e){
                 
                e.preventDefault();
                var block = document.getElementById("block_list");
                var ex = document.getElementById("expense_type");
                var pa = document.getElementById("payment_type");
                var expenses_id=$("#expenses_id").val();
                var block_id = block.options[block.selectedIndex].value;
                var expense_type_id = ex.options[ex.selectedIndex].value;
                var payment_type_id = pa.options[pa.selectedIndex].value;
                var _token = $("input[name='_token']").val();
                var txt_vname = $("input[name='txt_vname']").val();
                var txt_amount = $("input[name='txt_amount']").val();
                var txt_payment_date = $("input[name='txt_payment_date']").val();
                var txt_description = $("textarea[name='txt_description']").val();
                var count_error = 0;
                if (block_id == 0) {
                    
                     $("select[name='block_list']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='block_list']").removeClass('has-error');
                }
                if (expense_type_id == 0) {
                    
                     $("select[name='expense_type']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='expense_type']").removeClass('has-error');
                }
                if (payment_type_id == 0) {
                    
                     $("select[name='payment_type']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='payment_type']").removeClass('has-error');
                }
                if (txt_vname.trim() == '') {
                    $("input[name='txt_vname']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_vname']").removeClass('has-error');
                }
                if (txt_amount.trim() == '') {
                    $("input[name='txt_amount']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_amount']").removeClass('has-error');
                }
                if (txt_payment_date.trim() == '') {
                    $("input[name='txt_payment_date']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_payment_date']").removeClass('has-error');
                }
                if (txt_description.trim() == '') {
                    $("textarea[name='txt_description']").addClass('has-error');
                    count_error++;
                } else{
                    $("textarea[name='txt_description']").removeClass('has-error');
                }
                
                
              if(count_error == 0){
                
               
                $.ajax({
                    url: $('#base_url').val()+"expense/update",
                    type:'POST',
                    data: {_token:_token,expenses_id:expenses_id, block_id:block_id, expense_type_id:expense_type_id, payment_type_id:payment_type_id, txt_vname:txt_vname, txt_amount:txt_amount, txt_payment_date:txt_payment_date,txt_description:txt_description},
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                                printSuccessMsg(data.success);
                                table.ajax.reload();
                                $('#myForm')[0].reset();
                        }else{
                                printErrorMsg(data.error);
                        }
                    }
                });
            }
            else{
                 return false;
            }
            });
        });

function delete_expense(id){
    if (confirm('Are You Sure For Delete The House..!! ')) {
        var _token = $("input[name='_token']").val();
             $.ajax({
                    url: $('#base_url').val()+"expense/delete",
                    type:'POST',
                    data: {_token:_token, id:id},
                    success: function(data) {
                        if(data.status==1){
                            alert(data.msg);
                            table.ajax.reload();
                        }
                    }
                });
            }
                else {
                return false;
            }
}
function  refreshJsexpense(){
    $('.btnEditExpense').on('click', function () {
        var expense_id = $(this).data('id'); 
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: $('#base_url').val()+"expense/edit",
            type:'POST',
            data: {_token:_token, expense_id:expense_id},
            success: function(data) {
                if(data.status==1){
                    var expense_type = $("#expense_type").val(data.content.expense_type_id);
                    expense_type.attr("selected","selected");
                    $('select[name^="expense_type"] option[value=]').attr("selected","selected");
                    
                    var datablock = $("#block_list").val(data.content.block_id);
                    datablock.attr("selected","selected");
                    $('select[name^="block_list"] option[value=]').attr("selected","selected");
                    
                    $("#txt_vname").val(data.content.vender_name);
                    $("#txt_amount").val(data.content.ammount);
                    
                    var payment_type = $("#payment_type").val(data.content.payment_type_id);
                    payment_type.attr("selected","selected");
                    $('select[name^="payment_type"] option[value=]').attr("selected","selected");
                    $("#txt_payment_date").val(data.content.payment_date);
                    $("#txt_description").val(data.content.description);
                    $("#expenses_id").val(data.content.id);
                    
                    $(".add-expense").css('display','none');
                    $(".update-expense").css('display','block');
                    $("#myexpenseModal").modal("show");
                   
                    
                }
            }
        });
    });
}
function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });

}
function printSuccessMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
    }