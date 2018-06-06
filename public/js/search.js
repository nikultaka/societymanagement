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