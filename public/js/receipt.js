var table= jQuery('.receipt_list').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: $('#base_url').val()+'receipt/getdata',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'block', name: 'block'},
                        { data: 'house_no', name: 'house_no'},
                        { data: 'membername', name: 'membername'},
                        { data: 'charges_name', name: 'charges_name'},
                        { data: 'start_date', name: 'start_date'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ]
    });  
$(document).ready(function() {
           table.ajax.reload();
           $('.payment-status-change').on('click',function (){
    
     $.ajax({       
            url:$('#base_url').val()+'receipt/payment_status_change',
            type:'POST',
            datatype:'JSON',
            data:$('#payment_submitForm').serialize(),
            success: function (data) {
                var data=$.parseJSON(data);
                if(data.status==1){
                  $('.print-error-msg').html(data.msg);
                  table.ajax.reload();  
                  $('#Change_status_popup').modal('hide');   
                }
     
     
             }
        });
 })
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
                url: $('#base_url').val()+"receipt/getdatafordropdown",
                data:{id:id},
                success: function(result){
                     $("#hosue_no").html(result);
                    }
                });
    };
    function gethousemember(owner_id){
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
                   url:$('#base_url').val()+'receipt/add_receipt_single',
                   type:'post',
                   data:$('#myForm').serialize(),
                   success: function (data) {
                
            }
               });
          });
function getchargestype(block_id){
    if(block_id>0){
         $.ajax({
                   url:$('#base_url').val()+'receipt/get_charges_type',
                   type:'get',
                   data:{block_id:block_id},
                   success: function (data) {
                       $('.charges-type-by-block').html(data);
                       $('.charges-type-by-block').show();
                    }
               });
    }
    else{
        return false;
    }
}
$('.apply-charges-by-block').on('click',function (){
    var block_id=$('#block_list').val();
    var charge_type=$('#charges_type').val();
    var error_count=0;
    if(block_id==0){
        
    }
                $.ajax({
                   url:$('#base_url').val()+'receipt/auto_receipt',
                   type:'post',
                   data:$('#myautoreceiptForm').serialize(),
                   success: function (data) {
                       alert('Record Add Successfully..!')
                    }
               });
})

 function change_payment_status(id){
     
    $.ajax({       
            url:$('#base_url').val()+'receipt/get_receiptdetails_id',
            type:'GET',
            datatype:'JSON',
            data:{action:'getdatabyid',receipt_id:id},
            success: function (data) {
                var data=$.parseJSON(data);
                $('#user_name').html(data.result.membername);
                $('#amount').html(data.result.charges_ammount);
                $('#house_name').html(data.result.house_no);
                $('#start_date').html(data.result.start_date);
                $('#receipt_id_for_status').val(id);
                $('#Change_status_popup').modal('show'); 
     return false;
                //alert('Record Add Successfully..!')
             }
        });
 }
 function get_chq_details(id){
     if(id==2){
         var text_box_number='<input type="text" name="chq_no" id="chq_no" placeholder="Please enter cheque number">';
         $('.chq_number').html(text_box_number);
          var text_box_name='<input type="text" name="bank_name" id="bank_name" placeholder="Please enter Bank name">';
         $('.chq_bank_name').html(text_box_name);
          var text_box_ifsc='<input type="text" name="bank_ifsc_code" id="bank_ifsc_code" placeholder="Please enter Bank IFSC">';
         $('.chq_bank_ifsc').html(text_box_ifsc);
     }
     else{
          $('.chq_number').empty();
          $('.chq_bank_name').empty();
          $('.chq_bank_ifsc').empty();
     }
 }
 