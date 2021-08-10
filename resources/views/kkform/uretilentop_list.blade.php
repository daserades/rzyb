@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header" align="center">{{ __('Dokumadan Kesilen Toplar') }}
                </div>
                <div class="card-body">
                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <div class="col-md-6">
                                    <td><h5>Sipariş No</h5></td>
                                    <td><h5>Top Barcode</h5></td>
                                    <td><h5>Levent Barcode</h5></td>
                                    <td><h5>Makina No</h5></td>
                                    {{-- <td><h5>Metre</h5></td>
                                    <td><h5>Brüt Metre</h5></td> --}}
                                    <td><h5>Kumas Eni</h5></td>
                                    <td><h5>Ebat</h5></td>
                                    <td><h5>Tarih</h5></td>
                                    <td><h5>Durum</h5></td>
                                    <td><h5></h5></td>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <tfoot> <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                {{-- <th></th> --}}
                                {{-- <th></th> --}}
                                
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}" rel="stylesheet">  
    <link  href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/fontawesome-free-5.10.2-web/css/all.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
{{-- <script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}"></script> --}}
<script>
    $('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" size="3" placeholder="Search '+title+'" />' );
    } );
    $(function() {
        
        $('#table').on( 'click', 'tbody tr td.sil', function () {
  //var rowData = table.row( this ).data();
                if (confirm('Silmek İstediğinize Emin Misiniz?'))
                    return true;
                else {
                    return false;
                }
            } );


        table= $('#table').DataTable({
            //order : //['5','desc'],    
            order:[],    
            processing: true,
            serverSide: true,
            ajax: '{{ route('uretilentop_list_js') }}',
            columns: [
            // {data: null , name:'order.order_no' ,render: function ( data, type, row) {
            //     //console.log(row);
            //     if (row.order.order_no != null) return '<a href="{{url('kkform/orderball/')}}/'+data.order_id+'" target="_blank">'+row.order.order_no+'</a>';
            // } },
            { data: 'order.order_no' ,"defaultContent": ""},
            { data: 'barcode'},
            { data: 'levent_barcode',"defaultContent": ""},
            { data: 'machine_id',"defaultContent": ""},
            // { data: 'metre',"defaultContent": ""},
            // { data: 'brutmetre',"defaultContent": ""},
            { data: 'kumaseni',"defaultContent": ""},
            { data: 'ebat',"defaultContent": ""},
            { data: 'created_at',"defaultContent": ""},
            { data: 'durum.name',"defaultContent": ""},
             {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        //     ,footerCallback: function ( row, data, start, end, display ) {
        //     var api = this.api(), data;
 
        //     // Remove the formatting to get integer data for summation
        //     var intVal = function ( i ) {
        //         return typeof i === 'string' ?
        //             i.replace(/[\$,]/g, '')*1 :
        //             typeof i === 'number' ?
        //                 i : 0;
        //     };
 
        //     // Total over all pages
        //     fiyat = api
        //         .column( 5 )
        //         .data()
        //         .reduce( function (a, b) {
        //             return intVal(a) + intVal(b);
        //         }, 0 );
        //     pageTotal = api
        //         .column( 5, { page: 'current'} )
        //         .data()
        //         .reduce( function (a, b) {
        //             return intVal(a) + intVal(b);
        //         }, 0 );
            
        //     $( api.column( 5 ).footer() ).html(
        //         pageTotal +' <br>(T.Toplam='+ fiyat +')'
        //     );

        // }

        });

        table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change clear', function () 
        {
            if ( that.search() !== this.value ) 
            {
                that
                    .search( this.value )
                    .draw();
            }
        });
    });

    });

     // $(document).ready(function(){
     //    $.fn.dataTable.ext.search.push(
     //    function (settings, data, dataIndex) {
     //        var min = $('#min').datepicker("getDate");
     //        var max = $('#max').datepicker("getDate");
     //        var startDate = new Date(data[10]);
     //        if (min == null && max == null) { return true; }
     //        if (min == null && startDate <= max) { return true;}
     //        if(max == null && startDate >= min) {return true;}
     //        if (startDate <= max && startDate >= min) { return true; }
     //        return false;
     //    }
     //    );

       
     //        $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
     //        $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
     //        // var table = $('#table').DataTable();

     //        // Event listener to the two range filtering inputs to redraw on input
     //        $('#min, #max').change(function () {
     //            table.draw();
     //        });
     //    });
</script>
@endsection
