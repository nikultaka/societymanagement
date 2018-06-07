
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
                    var data = $.parseJSON(result);
                    alert(result);

                var table= jQuery('.search_list').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: $('#base_url').val()+'search/search_record',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'house_managment_id', name: 'house_managment_id'},
                        { data: 'charges_id', name: 'charges_id'},
                        { data: 'start_date', name: 'start_date'},
                        { data: 'end_date', name: 'end_date'},
                        { data: 'payment_type', name: 'payment_type'},
                        { data: 'status', name: 'status'},
                        { data: 'gm_created', name: 'gm_created'},
                            ]
                    });

                    
                    
                    
                    }
                });
})