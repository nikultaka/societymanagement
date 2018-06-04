function gethouseno(id)
    {
        $.ajax({
                type: "GET",
                url: $('#base_url').val()+"search/getdatafordropdown",
                data:{id:id},
                success: function(result){
                    $('.get-house-list').show();
                     $("#hosue_no").html(result);
                     $('#charges_type').hide();
                    }
                });
    };
$('.search-details').on('click',function (){
    $.ajax({
                type: "Post",
                url: $('#base_url').val()+"search/search_record",
                data:$('#search_form').serialize(),
                success: function(result){
                    
                    }
                });
})