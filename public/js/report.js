var table= jQuery('.search_list').DataTable({
                    data:[],
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'expense_name', name: 'expense_name'},
                        { data: 'ammount', name: 'ammount'},
                        { data: 'vender_name', name: 'vender_name'},
                        { data: 'payment_date', name: 'payment_date'},
                        
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
                            .column( 2 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        // Total over this page
//                        pageTotal = api
//                            .column( 3, { page: 'current'} )
//                            .data()
//                            .reduce( function (a, b) {
//                                return intVal(a) + intVal(b);
//                            }, 0 );

                        // Update footer
                        $( api.column( 2 ).footer() ).html(
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

var incometable= jQuery('.Incomesearch_list').DataTable({
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

                        // Total over this page
//                        pageTotal = api
//                            .column( 3, { page: 'current'} )
//                            .data()
//                            .reduce( function (a, b) {
//                                return intVal(a) + intVal(b);
//                            }, 0 );

                        // Update footer
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

$('.btnGetReportForBalance').on('click',function (){
    var count=0;
    if($('#start_date').val().trim()==''){
        $('#start_date').addClass('has-error');
        count++;
    }else{
        $('#start_date').removeClass('has-error');
    }
    if($('#end_date').val().trim()==''){
        $('#end_date').addClass('has-error');
        count++;
    }else{
        $('#end_date').removeClass('has-error');
    }
    if(count==0){
        $.ajax({
                type: "Post",
                url: $('#base_url').val()+"report/getdata",
                data:$('#formForGetBalance').serialize(),
                }).done(function (result) {
                   
                table.clear().draw();
                
                table.rows.add(result).draw();
                }).fail(function (jqXHR, textStatus, errorThrown) { 
               
            });
    }
    else{
        return false;
    }
    
});
$('.btnGetReportForIncomeBalance').on('click',function (){
    var count=0;
    if($('#start_date').val().trim()==''){
        $('#start_date').addClass('has-error');
        count++;
    }else{
        $('#start_date').removeClass('has-error');
    }
    if($('#end_date').val().trim()==''){
        $('#end_date').addClass('has-error');
        count++;
    }else{
        $('#end_date').removeClass('has-error');
    }
    if(count==0){
        $.ajax({
                type: "Post",
                url: $('#base_url').val()+"report/receiptgetdata",
                data:$('#formForGetBalance').serialize(),
                }).done(function (result) {
                   
                incometable.clear().draw();
                
                incometable.rows.add(result).draw();
                 incometable.column( 4 ).data().sum();
                }).fail(function (jqXHR, textStatus, errorThrown) { 
               
            });
    }
    else{
        return false;
    }
    
})
