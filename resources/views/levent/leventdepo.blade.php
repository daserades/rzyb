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
			 <div align="center">{{ __('LEVENT DEPO') }}</div>
				<div class="panel body">
					<table id="table" class="table-hover">
						<thead>
							<tr>
								<th>Sipariş</th>
								<th>Barcode</th>
								<th>Sıra No</th>
								<th>Tel Sayısı</th>
								<th>Levent Eni</th>
								<th>Metraj</th>
								<th>KG</th>
								<th>Durum</th>
								<th></th>
							</tr>
						</thead>
						<tbody>

						</tbody>
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
		$('#table').DataTable({
			//order : //['5','desc'],    
			order:[],    
			processing: true,
			ajax: '{{ route('leventdepojs') }}',
			columns: [
			{ data: 'order.order_no' ,"defaultContent": ""},
			{ data: 'barcode' },
			{ data: 'no' },
			{ data: 'telsayi' },
			{ data: 'leventeni' },
			{ data: 'metraj' },
			{ data: 'kg' },
			{ data: 'durum.name' },
			{ data: 'action', orderable: false, searchable: false}
			//{ data: 'miktar', render: $.fn.dataTable.render.number( '.', ',', 2) },
			//{ data: 'brutmiktar' , render: $.fn.dataTable.render.number( '.', ',', 2) },
	/*/		{ data: 'brutmiktar' , render: function ( data, type, row ) {
            return row.brutmiktar + '<br>(' + row.unit + ')';
        } },*/
			]
		});

	});
</script>
@endsection