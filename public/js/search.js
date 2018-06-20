var table= jQuery('.search_list').DataTable({
                    data:[],
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'house_no', name: 'house_no'},
                        { data: 'charges_name', name: 'charges_name'},
                        { data: 'charges_ammount', name: 'charges_ammount'},
                        { data: 'member_first_name', name: 'member_first_name'},
                        { data: 'member_last_name', name: 'member_last_name'},
                        { data: 'start_date', name: 'start_date'},
                        { data: 'end_date', name: 'end_date'},
                        { data: 'status', name: 'status'},
                        { data: 'gm_created', name: 'gm_created'},
                        
                            ],
                            dom: 'Bfrtip',
                       buttons: [
                                    { extend: 'copyHtml5', footer: true },
                                    { extend: 'excelHtml5', footer: true },
                                    { extend: 'csvHtml5', footer: true },
                                    { extend: 'pdfHtml5', footer: true }
                                ],
                    "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
 
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };

                        // Total over all pages
                        total = api
                            .column( 3 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        $( api.column( 3 ).footer() ).html(
                             total 
                        );
                    },            
                    rowCallback: function (row, data) {},
                    filter: false,
                    info: false,
                    ordering: false,
                    processing: true,
                    retrieve: true        
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
                }).done(function (result) {
                   
                table.clear().draw();
                table.rows.add(result).draw();
                }).fail(function (jqXHR, textStatus, errorThrown) { 
                  // needs to implement if it fails
            });
});
