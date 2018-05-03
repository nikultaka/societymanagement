var table= jQuery('.charges-table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: 'charges/getdata',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'block_name', name: 'block_name'},
                        { data: 'charges_name', name: 'charges_name'},
                        { data: 'charges_ammount', name: 'charges_ammount'},
                        { data: 'description', name: 'description'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
                        initComplete: function(settings, json) {
                    refreshJscharges();
                    }        
    });  
$(document).ready(function() {
           table.ajax.reload();
            $(".add-charges").click(function(e){
                
                e.preventDefault();
                var demo = document.getElementById("block_list");
                var block_id = demo.options[demo.selectedIndex].value;
                
                var _token = $("input[name='_token']").val();
                var txt_charges_name = $("input[name='txt_charges_name']").val();
                var txt_charges_ammount = $("input[name='txt_charges_ammount']").val();
                var description = $("textarea[name='description']").val();
                var count_error = 0;
                if (block_id == 0) {
                    
                     $("select[name='block_list']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='block_list']").removeClass('has-error');
                }
                if (txt_charges_name.trim() == '') {
                    $("input[name='txt_charges_name']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_charges_name']").removeClass('has-error');
                }
                if (txt_charges_ammount.trim() == '') {
                    $("input[name='txt_charges_ammount']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_charges_ammount']").removeClass('has-error');
                }
                if (description.trim() == '') {
                    $("textarea[name='description']").addClass('has-error');
                    count_error++;
                } else{
                    $("textarea[name='description']").removeClass('has-error');
                }
                
                if(count_error == 0){
                $.ajax({
                    url: "/charges",
                    type:'POST',
                    data: {_token:_token, block_id:block_id, txt_charges_name:txt_charges_name, txt_charges_ammount:txt_charges_ammount, description:description},
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
            $(".update-charges").click(function (e){
                e.preventDefault();
                var demo = document.getElementById("block_list");
                var block_id = demo.options[demo.selectedIndex].value;
                var charges_id=$("#charges_id").val();
                var _token = $("input[name='_token']").val();
                var txt_charges_name = $("input[name='txt_charges_name']").val();
                var txt_charges_ammount = $("input[name='txt_charges_ammount']").val();
                var description = $("textarea[name='description']").val();
                var count_error = 0;
                if (block_id == 0) {
                    
                     $("select[name='block_list']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='block_list']").removeClass('has-error');
                }
                if (txt_charges_name.trim() == '') {
                    $("input[name='txt_charges_name']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_charges_name']").removeClass('has-error');
                }
                if (txt_charges_ammount.trim() == '') {
                    $("input[name='txt_charges_ammount']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_charges_ammount']").removeClass('has-error');
                }
                if (description.trim() == '') {
                    $("textarea[name='description']").addClass('has-error');
                    count_error++;
                } else{
                    $("textarea[name='description']").removeClass('has-error');
                }
                
                if(count_error == 0){
                $.ajax({
                    url: "charges/update",
                    type:'POST',
                    data: {_token:_token,charges_id:charges_id, block_id:block_id, txt_charges_name:txt_charges_name, txt_charges_ammount:txt_charges_ammount, description:description},
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
function refreshJscharges(){
    $('.btnEditCharges').on('click', function () {
        var charges_id = $(this).data('id'); 
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/charges/edit",
            type:'POST',
            data: {_token:_token, charges_id:charges_id},
            success: function(data) {
                if(data.status==1){
                    
                    var datablock = $("#block_list").val(data.content.block_id);
                    datablock.attr("selected","selected");
                    $('select[name^="block_list"] option[value=]').attr("selected","selected");
                    
                    $("#txt_charges_name").val(data.content.charges_name);
                    $("#txt_charges_ammount").val(data.content.charges_ammount);
                    
                   
                    $("#description").val(data.content.description);
                    $("#charges_id").val(data.content.id);
                    
                    $(".add-charges").css('display','none');
                    $(".update-charges").css('display','block');
                    $("#mychargestypeModal").modal("show");
                   
                    
                }
            }
        });
    });
}
function delete_charges(id){
    if (confirm('Are You Sure For Delete The House..!! ')) {
        var _token = $("input[name='_token']").val();
             $.ajax({
                    url: "/charges/delete",
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
