function rental_detail(){
     var checkBox = document.getElementById("chk_rental");
  // Get the output text
  var Rentail_list = document.getElementById("Rentail_list");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    Rentail_list.style.display = "block";
  } else {
    Rentail_list.style.display = "none";
  }
        
}
var table= jQuery('.house-table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: 'house/getdata',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'block_name', name: 'block_name'},
                        { data: 'house_no', name: 'house_no'},
                        { data: 'name', name: 'name'},
//                        { data: 'member_last_name', name: 'rental_name'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
                     initComplete: function(settings, json) {
                        refreshJshouse();
                    }        
    });  
$(document).ready(function() {
           table.ajax.reload();
            $(".add-house").click(function(e){
                
                e.preventDefault();
                var demo = document.getElementById("block_list");
                 var demoowner = document.getElementById("Owner_list");
                var demoremntal = document.getElementById("Rentail_list");
                var block_id = demo.options[demo.selectedIndex].value;
                var _token = $("input[name='_token']").val();
                var txt_house_no = $("input[name='txt_house_no']").val();
                var owner_id = demoowner.options[demoowner.selectedIndex].value;
                var rental_id = demoremntal.options[demoremntal.selectedIndex].value;
                var count_error = 0;
                if (block_id == 0) {
                    
                     $("select[name='block_list']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='block_list']").removeClass('has-error');
                }
                if (txt_house_no.trim() == '') {
                    $("input[name='txt_house_no']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_house_no']").removeClass('has-error');
                }
                if (owner_id == 0) {
                     $("select[name='Member_list']").addClass('has-error');
                    count_error++;
                } else{
                    $("select[name='Member_list']").removeClass('has-error');
                }
                
              if(count_error == 0){
                  
                $.ajax({
                    url: "house",
                    type:'POST',
                    data: {_token:_token, block_id:block_id, txt_house_no:txt_house_no, owner_id:owner_id, rental_id:rental_id},
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
            $(".update-house").click(function (e){
                
                e.preventDefault();
                var demo = document.getElementById("block_list");
                 var demoowner = document.getElementById("Owner_list");
                var demoremntal = document.getElementById("Rentail_list");
                var block_id = demo.options[demo.selectedIndex].value;
                var _token = $("input[name='_token']").val();
                var txt_house_no = $("input[name='txt_house_no']").val();
                var house_id=$("#house_id").val();
                var owner_id = demoowner.options[demoowner.selectedIndex].value;
                var rental_id = demoremntal.options[demoremntal.selectedIndex].value;
                var count_error = 0;
                if (block_id == 0) {
                    
                     $("select[name='block_list']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='block_list']").removeClass('has-error');
                }
                if (txt_house_no.trim() == '') {
                    $("input[name='txt_house_no']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='txt_house_no']").removeClass('has-error');
                }
                if (owner_id == 0) {
                     $("select[name='Member_list']").addClass('has-error');
                    count_error++;
                } else{
                    $("select[name='Member_list']").removeClass('has-error');
                }
                
              if(count_error == 0){
                  
                $.ajax({
                    url: "house/update",
                    type:'POST',
                    data: {_token:_token,house_id:house_id, block_id:block_id, txt_house_no:txt_house_no, owner_id:owner_id, rental_id:rental_id},
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
function refreshJshouse(){
    $('.btnEditHouse').on('click', function () {
        var house_id = $(this).data('id'); 
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "house/edit",
            type:'POST',
            data: {_token:_token, house_id:house_id},
            success: function(data) {
                if(data.status==1){
                    $("#txt_house_no").val(data.content.house_no);
                    $("#house_id").val(data.content.id);
                    var datablock = $("#block_list").val(data.content.house_block_id);
                    datablock.attr("selected","selected");
                    $('select[name^="block_list"] option[value=]').attr("selected","selected");
                    var dataowner = $("#Owner_list").val(data.content.owner_id);
                    dataowner.attr("selected","selected");
                    $('select[name^="Member_list"] option[value=]').attr("selected","selected");
                    $(".add-house").css('display','none');
                    $(".update-house").css('display','block');
                    $("#myHouseModal").modal("show");
                   
                    
                }
            }
        });
    });
}
function delete_house(id){
    if (confirm('Are You Sure For Delete The House..!! ')) {
        var _token = $("input[name='_token']").val();
             $.ajax({
                    url: "house/delete",
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



