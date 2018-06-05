var table= jQuery('.trasfer-member-list').DataTable({
                     order: [ [0, 'desc'] ],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: $('#base_url').val()+'transfer/getdata',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'block_name', name: 'block_name'},
                        { data: 'house_no', name: 'house_no'},
                        { data: 'oldname', name: 'oldname'},
                        { data: 'newmembername', name: 'newmembername'},
                        { data: 'gm_created', name: 'gm_created'},
//                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ]
    });  
$(document).ready(function() {
          // table.ajax.reload();
           //var date = new Date();
          
          
            $(".add-transfer").click(function(e){
               
                e.preventDefault();
                var demo = document.getElementById("block_list");
                var block_id = demo.options[demo.selectedIndex].value;
                var houase = document.getElementById("house_no");
                var house_no = houase.options[houase.selectedIndex].id;
                var old_owner_id = $('#owner_id').val();
                var member_list =document.getElementById("new_member_list");
                var new_member_id = member_list.options[member_list.selectedIndex].value;
                var _token = $("input[name='_token']").val();
              
               
                $.ajax({
                    url: $('#base_url').val()+"transfer",
                    type:'POST',
                    data: {_token:_token, block_id:block_id, house_no:house_no, old_owner_id:old_owner_id, new_member_id:new_member_id},
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
                   
	});


function gethouseno(id)
    {
        $.ajax({
                type: "GET",
                url: $('#base_url').val()+"receipt/getdatafordropdown",
                data:{id:id},
                success: function(result){
                     $("#hosue_no").html(result);
                    }
                });
    };
    function gethousemember(owner_id,house_name){
       
         $.ajax({
                type: "GET",
                url: $('#base_url').val()+"receipt/getdataforhousemember",
                data:{owner_id:owner_id},
                success: function(result){
                     var data=jQuery.parseJSON(result);
                     if(data.status==1){
                        $('#txt_fname').val(data.content.member_first_name);
                        $('#txt_mname').val(data.content.member_middle_name);
                        $('#txt_lname').val(data.content.member_last_name);
                        $('#email').val(data.content.member_email);
                        
                        $('#owner_id').val(data.content.id);
                        
                        $('#member_list').html(data.member_list);
                     }
                    }
                });
        
    }
