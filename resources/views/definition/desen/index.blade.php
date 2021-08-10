@extends('layouts.app')

@section('content')
	<div>
		<div class="panel panel-default">
			@if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
			<div align="center">{{ __('DESEN LİSTESİ') }}
			<button type="button" onclick="location.href='{{ route('desen.create') }}'"class="btn btn-outline-info">Yeni</button>
		</div>
			<li align="center" type=none>
				<!--<input type="date" name="date" class="form control">
				<input type="date" name="to_date">
				<button type="submit" class="btn btn-outline-info">Ara</button>
			-->
			</li>
				<div class="panel body">
					<table id="table" class="table table-hover table-striped">
						<thead>
							<tr>
								<th>Desen Adı</th>
								<th>Sipariş No</th>
								<th>Varyant</th>
							<!--	<th>Kalite</th> -->
								<th>Desen No</th>
								<th>Atkı Sıklığı</th>
								<th>Çözgü Sıklığı</th>
								<th>C.T.S</th>
								<th>Tarak Eni</th>
								<th>Ham GR</th>
								<th>Mamul GR</th>
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
    <style type="text/css">
    	th { font-size: 13px; }
    	td { font-size: 12px; }
    </style>
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
			ajax: '{{ route('js') }}',
			columns: [
			{ data: 'name', name: 'name' },
			{ data: 'order_no', "defaultContent": "" },
			{ data: 'varyant', "defaultContent": "" },
			//{ data: 'order.kalite' , "defaultContent": "" },
			{ data: 'no', name: 'no' },
			{ data: 'atki_sikligi', name: 'atki_sikligi' },
			{ data: 'cozgu_sikligi', name: 'cozgu_sikligi' },
			{ data: 'cts', name: 'cts' },
			{ data: 'tarak_eni', name: 'tarak_eni' },
			{ data: 'ham_gr', name: 'ham_gr' },
			{ data: 'mamul_gr', name: 'mamul_gr' },
			{data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});

	});
</script>
@endsection
