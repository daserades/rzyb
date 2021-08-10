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
			 <div align="center">{{ __('KUMAS GİRİŞ LİSTESİ') }}
				<button type="button" onclick="location.href='{{ route('kumas.create') }}'"class="btn btn-outline-info">Yeni</button>
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
								<th>Firma </th>
								<th>Top Adeti </th>
								<th>İrsaliye </th>
								<th>Fatura </th>
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
		$('#table').on( 'click', 'tbody tr td.sil', function () {
  //var rowData = table.row( this ).data();
                if (confirm('Silmek İstediğinize Emin Misiniz?'))
                    return true;
                else {
                    return false;
                }
			} );

		$('#table').DataTable({
			//order : //['5','desc'],    
			order:[],    
			processing: true,
			serverSide: true,
			ajax: '{{ route('kumasjs') }}',
			columns: [
			{ data: 'firma.name' },
			{ data: 'adet' },
			{ data: 'irsaliye_no' },
			{ data: 'fatura_no' },
			{data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});

	});
</script>
@endsection