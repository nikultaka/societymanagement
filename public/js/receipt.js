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
                        if($.isEmptyObject(data.error)){
                                printSuccessMsg(data.success);
                                table.ajax.reload();
                                $('#myForm')[0].reset();
                                $("#hosue_no").hide();
                        }else{
                                printErrorMsg(data.error);
                        }
                
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
    var block_id=$('#block_list_for_auto').val();
    var charge_type=$('#charges_type').val();
    var error_count=0;
    
    if(block_id==0){
        alert('please select block');
        return false; 
        
    }else{
                $.ajax({
                   url:$('#base_url').val()+'receipt/auto_receipt',
                   type:'post',
                   data:$('#myautoreceiptForm').serialize(),
                   success: function (data) {
                       alert('Record Add Successfully..!');
                        table.ajax.reload();
                        $('#myautoreceiptForm')[0].reset();
                        $('#myreceiptautogenrate').hide();
                    }
               });
           }
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
 