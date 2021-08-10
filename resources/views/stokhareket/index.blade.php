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
			 <div align="center">{{ __('STOK HAREKET LİSTESİ') }}
				<button type="button" onclick="location.href='{{ route('stokhareket.create') }}'"class="btn btn-outline-info">Yeni Hareket</button>
			</div>
			<li align="center" type=none>
				<!--<input type="date" name="date" class="form control">
				<input type="date" name="to_date">
				<button type="submit" class="btn btn-outline-info">Ara</button>
			-->
			</li>
				<div class="panel body">
					<table id="table" class="table">
						<thead>
							<tr>
								<th>Hareket Türü</th>
								<th>Sİpariş No</th>
								<th>Renk </th>
								<th>Renk No</th>
								<th>Parti No</th>
								<th>N.Miktar</th>
								<th>B.Miktar</th>
								<th>İade Miktar</th>
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
			serverSide: true,
			ajax: '{{ route('shjs') }}',
			columns: [
			{ data: 'hareketturu.name', name: 'id' },
			{ data: 'order_id', name: 'order_id' },
			{ data: 'renk', name: 'renk' },
			{ data: 'renkno', name: 'renkno' },
			{ data: 'partino', name: 'partino' },
			{ data: 'miktar', name: 'miktar' },
			{ data: 'brutmiktar', name: 'brutmiktar' },
			{ data: 'iademiktar', name: 'iademiktar' },
			{data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});

	});
</script>
@endsection