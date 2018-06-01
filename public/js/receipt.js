var table= jQuery('.receipt_list').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: 'receipt/getdata',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'block', name: 'block'},
                        { data: 'house_no', name: 'house_no'},
                        { data: 'membername', name: 'membername'},
                        { data: 'start_date', name: 'start_date'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ]
    });  
$(document).ready(function() {
           table.ajax.reload();
           //var date = new Date();
          
          
//            $(".add-member").click(function(e){
//                
//                e.preventDefault();
//                var demo = document.getElementById("block_list");
//                var block_id = demo.options[demo.selectedIndex].value;
//                
//                var _token = $("input[name='_token']").val();
//                var txt_fname = $("input[name='txt_fname']").val();
//                var txt_mname = $("input[name='txt_mname']").val();
//                var txt_lname = $("input[name='txt_lname']").val();
//                var email = $("input[name='email']").val();
//                var number = $("input[name='number']").val();
//                if(block_id > 0){
//                $.ajax({
//                    url: "/member",
//                    type:'POST',
//                    data: {_token:_token, block_id:block_id, txt_fname:txt_fname, txt_mname:txt_mname, txt_lname:txt_lname, email:email, number:number},
//                    success: function(data) {
//                        if($.isEmptyObject(data.error)){
//                                printSuccessMsg(data.success);
//                                table.ajax.reload();
//                                $('#myForm')[0].reset();
//                        }else{
//                                printErrorMsg(data.error);
//                        }
//                    }
//                });
//            }
//            else{
//                alert("please select member block");
//            }
//            }); 
//            function printErrorMsg (msg) {
//                        $(".print-error-msg").find("ul").html('');
//                        $(".print-error-msg").css('display','block');
//                        $.each( msg, function( key, value ) {
//                                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
//                        });
//
//		}
//                function printSuccessMsg (msg) {
//                        $(".print-error-msg").find("ul").html('');
//                        $(".print-error-msg").css('display','block');
//                        $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
//                    }
                   
	});


function gethouseno(id)
    {
        $.ajax({
                type: "GET",
                url: "receipt/getdatafordropdown",
                data:{id:id},
                success: function(result){
                     $("#hosue_no").html(result);
                    }
                });
    };
    function gethousemember(owner_id){
         $.ajax({
                type: "GET",
                url: "receipt/getdataforhousemember",
                data:{owner_id:owner_id},
                success: function(result){
                     var data=jQuery.parseJSON(result);
                     if(data.status==1){
                        $('#txt_fname').val(data.content.member_first_name);
                        $('#txt_mname').val(data.content.member_middle_name);
                        $('#txt_lname').val(data.content.member_last_name);
                        $('#email').val(data.content.member_email);
                        $('#number').val(data.content.member_contect);
                     }
                    }
                });
        
    }
  $('.add-receipt_single').click(function (e){
              var house_id = $('#house_no option:selected').data('id');
              $('#house_managment_id').val(house_id);
        
               e.preventDefault();
               $.ajax({
                   url:'receipt/add_receipt_single',
                   type:'post',
                   data:$('#myForm').serialize(),
                   success: function (data) {
                
            }
               });
          });  
 $(function() {
   $('#start_date').datetimepicker();
 });