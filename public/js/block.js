var table=  jQuery('.block-table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: $('#base_url').val()+'block/getdata',
                    columns: [
                        { data: 'id', name: 'id',"width": "10%" },
                        { data: 'block_name', name: 'block_name',"width": "60%" },
                        {data: 'action', name: 'action', orderable: false, searchable: false,"width": "30%"},
                    ],
                    initComplete: function(settings, json) {
                        refreshJs();
                    }
    }); 
  
$(document).ready(function() {
    
           table.ajax.reload();
            $(".add-block").click(function(e){
                var base_url=$('#base_url').val();
                
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var txt_block_name = $("input[name='txt_block_name']").val();
                if(txt_block_name.trim() == ''){
                    var msg = "Please Enter Block Name";
                    Singleerror (msg);
                    return false;
                }
                else{
                $.ajax({
                    url: base_url+"block",
                    type:'POST',
                    data: {_token:_token, txt_block_name:txt_block_name},
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                                printSuccessMsg(data.success);
                                table.ajax.reload();
                                
                        }else{
                                printErrorMsg(data.error);
                        }
                    }
                });
            }
            });
            $(".Update-block").click(function(e){
                var base_url=$('#base_url').val();
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var txt_block_name = $("input[name='txt_block_name']").val();
        var block_id = $("#block_id").val();
        if(txt_block_name.trim() == ''){
            var msg = "Please Enter Block Name";
            Singleerror (msg);
            return false;
        }
        else{
        $.ajax({
            url: base_url+"block/update",
            type:'POST',
            data: {_token:_token, txt_block_name:txt_block_name,block_id:block_id},
            success: function(data) {
                if($.isEmptyObject(data.error)){
                        printSuccessMsg(data.success);
                        table.ajax.reload();

                }else{
                        printErrorMsg(data.error);
                }
            }
        });
    }
    });
});

function refreshJs()
{
    $('.btnEditBlock').on('click', function () {
        var base_url=$('#base_url').val();
        var block_id = $(this).data('id'); 
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: base_url+"block/edit",
            type:'POST',
            data: {_token:_token, block_id:block_id},
            success: function(data) {
                if(data.status==1){
                    $("#txt_block_name").val(data.content.block_name);
                    $("#block_id").val(data.content.id);
                    $(".add-block").css('display','none');
                    $(".Update-block").css('display','block');
                    $("#myblockModal").modal("show");
                   
                    
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
function Singleerror (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
}
function delete_block(id){
    var base_url=$('#base_url').val();
    if (confirm('Are You Sure For Delete The Block..!! ')) {
        var _token = $("input[name='_token']").val();
             $.ajax({
                    url: base_url+"block/delete",
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


                    

