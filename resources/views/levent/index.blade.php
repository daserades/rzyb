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
			 <div align="center">{{ __('LEVENT İRSALİYE LİSTESİ') }}
				<button type="button" onclick="location.href='{{ route('leventhareket.create') }}'"class="btn btn-outline-info">Yeni</button>
			</div>
			<li align="center" type=none>
			</li>
				<div class="panel body">
					<table id="table" class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Yer</th>
								<th>Hareket Türü</th>
								<th>Firma</th>
								<th>Giriş Tarihi </th>
								<th>Çıkış Tarihi </th>
								<th>İrsaliye No</th>
								<th>Fatura No</th>
								<th>Açıklama</th>
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
			ajax: '{{ route('leventirsaliyejs') }}',
			columns: [
			{ data: 'id' , "defaultContent": "" },
			{ data: 'firmatipi.name' , "defaultContent": "" },
			{ data: 'hareketturu.name' , "defaultContent": ""},
			{ data: 'firma.name' , "defaultContent": ""},
//			{ data: 'order.order_no' , "defaultContent": ""},
			{ data: 'gtrh' },
			{ data: 'ctrh' },
			{ data: 'irsaliye_no' },
			{ data: 'fatura_no' },
//			{ data: 'iplikirsaliyedetail.0.iplikcins.name' , "defaultContent": ""},
//			{ data: 'iplikirsaliyedetail.0.iplikmarka' , "defaultContent": ""},
//			{ data: 'iplikirsaliyedetail.0.renk' , "defaultContent": ""},
			//{ data: 'iplikirsaliyedetail.[,].iplikcins.name' , "defaultContent": ""},
/*			{
			
					data:'iplikirsaliyedetail.0.iplikno' ,
					render:function (data,type,row) {
						if(data != null)
				return row.iplikirsaliyedetail[0].iplikno + '/' + row.iplikirsaliyedetail[0].ne;
			},"defaultContent": " "
			},
*/			{ data: 'aciklama' },
			{data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});

	});
</script>
@endsection