@extends('layouts.app')

@section('content')
	<div>
		<div >
			@if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
			 <div align="center">{{ __('İPLİK DEPO(DETAY)') }}</div>
				<div class="panel body">
					<table id="table" class="table-hover">
						<thead>
							<tr>
								<th>Barcode</th>
								<th>Lot No</th>
								<th>Marka</th>
								<th>Cins</th>
								<th>Boya Cins</th>
								<th>No-Ne</th>
								<th>Büküm S.</th>
								<th>Renk1</th>
								<th>Renk2</th>
								<th>Renk No1</th>
								<th>Renk No2</th>
								<th>Miktar</th>
								<th>Brüt M.</th>
								<th>Birim</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
						<tfoot>	
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
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
@endsection
@section('js')
<script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script>
	$(function() {
			 $('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" size="8" placeholder="Search '+title+'" />' );
    } ); 


		var table =$('#table').DataTable({
			//order : //['5','desc'],    
			order:[],    
			processing: true,
			serverSide: true,
			ajax: '{{ route('iplikjs2') }}',
			dom: 'Blfrtip',
			columns: [
			{ data: 'barcode' },
			{ data: 'partino' },
			{ data: 'iplikmarka' },
			{ data: 'iplikcins.name' , "defaultContent": ""},
			{ data: 'boyacins.name' , "defaultContent": ""},
			{ data: 'iplikno' },
			{ data: 'ne' },
			{ data: 'renk' },
			{ data: 'renksim' },
			{ data: 'renkno' },
			{ data: 'renknosim' },
            { data: 'miktar'},
            //{ data: 'miktar', render: $.fn.dataTable.render.number( '.', ',', 2) },
			{ data: 'brutmiktar' },
	/*/		{ data: 'brutmiktar' , render: function ( data, type, row ) {
            return row.brutmiktar + '<br>(' + row.unit + ')';
        } },*/
			{ data: 'unit.name' , "defaultContent": ""}
			]
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