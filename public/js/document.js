var table= jQuery('.doc-table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: 'document/getdata',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'title', name: 'title'},
                        { data: 'document', name: 'document'},
                        { data: 'description', name: 'description'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    });  
$(document).ready(function() {
           table.ajax.reload();
            $(".add-document").click(function(e){
                
                e.preventDefault();
//                var demo = document.getElementById("block_list");
//                var block_id = demo.options[demo.selectedIndex].value;
//                
                var _token = $("input[name='_token']").val();
                var txt_title = $("input[name='txt_title']").val();
                var doc_upload = $("input[name='doc_upload']").val();
                var txt_des = $("textarea[name='txt_des']").val();
                var count_error = 0;
                if (txt_title.trim() == '') {
                    
                     $("input[name='txt_title']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='txt_title']").removeClass('has-error');
                }
                if (doc_upload.trim() == '') {
                    $("input[name='doc_upload']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='doc_upload']").removeClass('has-error');
                }
                if (txt_des.trim() == '') {
                     $("textarea[name='txt_des']").addClass('has-error');
                    count_error++;
                } else{
                    $("textarea[name='txt_des']").removeClass('has-error');
                }
                if(count_error == 0){
                    
                   var formData = new FormData($('#myDocm')[0]);
                    $.ajax({
                    url: "document",
                    type:'POST',
                    data:formData,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success: function(data) {

                        if($.isEmptyObject(data.error)){
                           
                                printSuccessMsg(data.success);
                                table.ajax.reload();
                                $('#myDocm')[0].reset();
                        }else{
                                printErrorMsg(data.error);
                        }
                    }
                });
                }
                else {
                    return false;
                }
            })
            }); 

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

function delete_document(id){
    if (confirm('Are You Sure For Delete The Document..!! ')) {
        var _token = $("input[name='_token']").val();
             $.ajax({
                    url: "document/delete",
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