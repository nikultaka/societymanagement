var table= jQuery('.member-table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: $('#base_url').val()+'member/getdata',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'member_first_name', name: 'member_first_name'},
                        { data: 'member_middle_name', name: 'member_middle_name'},
                        { data: 'member_last_name', name: 'member_last_name'},
                        { data: 'member_email', name: 'member_email'},
                        { data: 'member_contect', name: 'member_contect'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
                    initComplete: function(settings, json) {
                        refreshJsMember();
                    }        
    });  
$(document).ready(function() {
           table.ajax.reload();
            $(".add-member").click(function(e){
                
                e.preventDefault();
//                var demo = document.getElementById("block_list");
//                var block_id = demo.options[demo.selectedIndex].value;
//                
                var _token = $("input[name='_token']").val();
                var txt_fname = $("input[name='txt_fname']").val();
                var txt_mname = $("input[name='txt_mname']").val();
                var txt_lname = $("input[name='txt_lname']").val();
                var email = $("input[name='email']").val();
                var number = $("input[name='number']").val();
                var count_error = 0;
                if (txt_fname.trim() == '') {
                    
                     $("input[name='txt_fname']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='txt_fname']").removeClass('has-error');
                }
                if (txt_mname.trim() == '') {
                    $("input[name='txt_mname']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_mname']").removeClass('has-error');
                }
                if (txt_lname.trim() == '') {
                     $("input[name='txt_lname']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_lname']").removeClass('has-error');
                }
                if (email.trim() == '') {
                     $("input[name='email']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='email']").removeClass('has-error');
                } 
                if (number.trim() == '') {
                     $("input[name='number']").addClass('has-error');
                    count_error++;
                }
                else{
                    $("input[name='number']").removeClass('has-error');
                }
               
                
                if(count_error == 0){
                    
                    $.ajax({
                    url: $('#base_url').val()+"member",
                    type:'POST',
                    data: {_token:_token, txt_fname:txt_fname, txt_mname:txt_mname, txt_lname:txt_lname, email:email, number:number},
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
                else {
                    return false;
                }
            }); 
            $(".Update-member").click(function(e){
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var txt_fname = $("input[name='txt_fname']").val();
                var txt_mname = $("input[name='txt_mname']").val();
                var txt_lname = $("input[name='txt_lname']").val();
                var email = $("input[name='email']").val();
                var number = $("input[name='number']").val();
                var member_id=$("#member_id").val();
                var count_error = 0;
                if (txt_fname.trim() == '') {
                    
                     $("input[name='txt_fname']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='txt_fname']").removeClass('has-error');
                }
                if (txt_mname.trim() == '') {
                    $("input[name='txt_mname']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_mname']").removeClass('has-error');
                }
                if (txt_lname.trim() == '') {
                     $("input[name='txt_lname']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_lname']").removeClass('has-error');
                }
                if (email.trim() == '') {
                     $("input[name='email']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='email']").removeClass('has-error');
                } 
                if (number.trim() == '') {
                     $("input[name='number']").addClass('has-error');
                    count_error++;
                }
                else{
                    $("input[name='number']").removeClass('has-error');
                }
               
                
                if(count_error == 0){
                    
                    $.ajax({
                    url: $('#base_url').val()+"member/update",
                    type:'POST',
                    data: {_token:_token,member_id:member_id, txt_fname:txt_fname, txt_mname:txt_mname, txt_lname:txt_lname, email:email, number:number},
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
                else {
                    return false;
                }
            }); 
            
                               
	});
function refreshJsMember(){
    $('.btnEditMember').on('click', function () {
        var member_id = $(this).data('id'); 
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: $('#base_url').val()+"member/edit",
            type:'POST',
            data: {_token:_token, member_id:member_id},
            success: function(data) {
                if(data.status==1){
                    $("#txt_fname").val(data.content.member_first_name);
                    $("#txt_mname").val(data.content.member_middle_name);
                    $("#txt_lname").val(data.content.member_last_name);
                    $("#email").val(data.content.member_email);
                    $("#number").val(data.content.member_contect);
                    $("#member_id").val(data.content.id);
                    $(".add-member").css('display','none');
                    $(".Update-member").css('display','block');
                    $("#mymemberModal").modal("show");
                   
                    
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
function delete_member(id){
    if (confirm('Are You Sure For Delete The Member..!! ')) {
        var _token = $("input[name='_token']").val();
             $.ajax({
                    url: $('#base_url').val()+"member/delete",
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



