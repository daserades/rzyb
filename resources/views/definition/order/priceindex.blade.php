@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
			@if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div align="center">{{ __('FİYAT LİSTESİ') }} 
                </div> 
			<li align="center" type=none>
				<!--<input type="date" name="date" class="form control">
				<input type="date" name="to_date">
				<button type="submit" class="btn btn-outline-info">Ara</button>
			-->
			</li>
				<div class="asd">
					<table id="table" class="table-hover table-striped">
						<thead>
							<tr>
								<th width="300">Firma</th>
								<th>Firma Kodu</th>
								<th>Sip. No</th>
								<th>Birim</th>
								<th>Fiyat</th>
								<th>D.cins</th>
								<th>Kur</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
						<tfoot>	
								<th>Firma</th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
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
    <link href="{{ asset('fontawesome/fontawesome-free-5.10.2-web/css/all.css') }}" rel="stylesheet">
    <style type="text/css">
    	tr:hover td {background:yellow}
    </style>
@endsection
@section('js')
<script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script>
	$(function() {
    $('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" size="4" placeholder="Search '+title+'" />' );
    } );

		var table= $('#table').DataTable({
			order:[], 
			processing: true,
			//serverSide: true,
			colReorder: true,
			ajax: '{{ route('pricejs') }}',
			dom: 'Blfrtip',
			columns: [
			{ data: 'firma.name' ,name:'firma.name' , "defaultContent": "" },
			{ data: 'firma.zarano' , name:'firma.zarano',"defaultContent": "" },
			//{ data: 'order_no'},
			{data: null , name:'order_no' ,render: function ( data, type, row) {
                //console.log(row);
                if (row.order_no != null) return '<a href="{{url('order/order/')}}/'+data.id+'/edit" target="_blank">'+row.order_no+'</a>';
            } },
			{ data: 'unit2.name' , name:'unit2.name',"defaultContent": ""},
			{ data: 'fiyat' , name:'fiyat',"defaultContent": "" },
			{ data: 'kur.name',name:'kur.name',"defaultContent": "" },
			{ data: 'bazkur',name:'bazkur' }
			]
			, initComplete: function () {
            this.api().columns([1]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
		
		});

		table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

	});
</script>
@endsection
