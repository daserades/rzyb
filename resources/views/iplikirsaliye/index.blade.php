@extends('layouts.app')

@section('content')
	<div>
		<div >
			@if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
			 <div align="center">{{ __('İPLİK İRSALİYE LİSTESİ') }}
				<button type="button" onclick="location.href='{{ route('iplikirsaliye.create') }}'"class="btn btn-outline-info">Yeni</button>
			</div>
			<div class="col-md-12">
                        <form action="{{route('iplikirsaliyesearch')}}" method="post">
                        	@csrf
                            <div class="input-group">
                                <input type="firmatipi" name="firmatipi" class="form-control" placeholder="Yer">
                                <input type="hareket" name="hareket" class="form-control" placeholder="Hareket Türü">
                                <input type="firma" name="firma" class="form-control" placeholder="Firma Adı">
                                <input type="order" name="order" class="form-control" placeholder="Sipariş No">
                                <input type="date" name="gtrh" class="form-control" placeholder="Sipariş No">
                                <input type="date" name="ctrh" class="form-control" placeholder="Sipariş No">
                                <input type="irsaliye_no" name="irsaliye_no" class="form-control" placeholder="İrsaliye No">
                                <input type="iplikcins" name="iplikcins" class="form-control" placeholder="İplik Cins">
                                <input type="iplikmarka" name="iplikmarka" class="form-control" placeholder="İplik Marka">
                                <input type="renk" name="renk" class="form-control" placeholder="Renk">
                                <input type="iplikno" name="iplikno" class="form-control" placeholder="İplikno (ÖR=30)">
                                <input type="ne" name="ne" class="form-control" placeholder="NE (ÖR=1)">
                                <input type="aciklama" name="aciklama" class="form-control" placeholder="Açıklama">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
			<li align="center" type=none>
				<!--<input type="date" name="date" class="form control">
				<input type="date" name="to_date">
				<button type="submit" class="btn btn-outline-info">Ara</button>
			-->
			</li>
				<div class="panel body">
					<table id="table" class="table-hover table-striped" border="1">
						<thead>
							<tr>
								<th>No</th>
								<th>Yer</th>
								<th>Hareket Türü</th>
								<th>Firma</th>
								<th>Sipariş No </th>
								<th>Giriş Tarihi </th>
								<th>Çıkış Tarihi </th>
								<th>İrsaliye No</th>
								<th>Fatura No</th>
								<th>İplik Cinsi</th>
								<th>İplik Marka</th>
								<th>Renk</th>
								<th>Ne/No</th>
								<th>Açıklama</th>
								<th colspan="4"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($iplikirsaliye as $list)
							<tr> 
								<td>{{$list->id ?? ''}} </td>
								<td>{{$list->firmatipi ?? ''}} </td>
								<td>{{$list->hareket ?? ''}} </td>
								<td>{{$list->firma ?? ''}} </td>
								<td>{{$list->order ?? ''}} </td>
								<td>{{$list->gtrh ?? ''}} </td>
								<td>{{$list->ctrh ?? ''}} </td>
								<td>{{$list->irsaliye_no ?? ''}} </td>
								<td>{{$list->fatura_no ?? ''}} </td>
								<td>{{$list->iplikirsaliyedetail[0]->iplikcins->name ?? ''}} </td>
								<td>{{$list->iplikirsaliyedetail[0]->iplikmarka ?? ''}} </td>
								<td>{{$list->iplikirsaliyedetail[0]->renk ?? ''}} </td>
								<td>{{$list->iplikirsaliyedetail[0]->iplikno ?? ''}}/{{$list->iplikirsaliyedetail[0]->ne ?? ''}} </td>
								<td>{{$list->aciklama ?? ''}} </td>
								
									@if($list['hareketturu_id']==1) 
							          <td><a href="{{ route('iplikirsaliye.show',$list->id)}}" title="Detay" target="_blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>
							          @if(auth()->user()->can('delete')) <td><a href="{{ route('iplikgiris',$list->id)}}" title="İplik Giriş" target="_blank" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td> 
							          @elseif(empty($list['irsaliye_no'])) <td><a href="{{ route('iplikgiris',$list->id)}}" title="İplik Giriş" target="_blank" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>
							          @endif
						            @elseif($list['hareketturu_id']==2) 
							        <td><a href="{{ route('iplikshow2',$list->id)}}" title="Detay" target="_blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>
							         @if(auth()->user()->can('delete')) <td><a href="{{ route('iplikcikis',$list->id)}}" title="İplik Çıkış" target="_blank" style="color:black"><i class="fas fa-truck-loading fa-1x"></i></a></td>
							         @elseif(empty($list['irsaliye_no'])) <td><a href="{{ route('iplikcikis',$list->id)}}" title="İplik Çıkış" target="_blank" style="color:black"><i class="fas fa-truck-loading fa-1x"></i></a></td>
							       	 @endif
							       	@endif 
							        @if(auth()->user()->can('delete')) <td><a href="{{route('iplikirsaliye.edit',$list->id)}}" style="color:black" target="_blank" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>
							        @elseif(empty($list['irsaliye_no'])) <td><a href="{{route('iplikirsaliye.edit',$list->id)}}" style="color:black" target="_blank" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>
							        @endif
							    <td>
							        @if(auth()->user()->can('delete'))
							            <div class="delete-form">
							                    <form action="{{route('iplikirsaliye.destroy', $list->id)}}" method="POST">
							                    <input type="hidden" name="_token" value="'.csrf_token().'">
							                    <input type="hidden" name="_method" value="DELETE">
							                     <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
							                    </form>
							                 </div>
							        @endif         
								</td>
							</tr>
							@endforeach
						</tbody>
					
					</table>
                    {{$iplikirsaliye->appends($_GET)->links()}}
				</div>
			</div>
		</div>
	</div>
@endsection
@section('css')
<style type="text/css">
    	/*th { font-size: 12px; }
    	td {
    		 font-size: 12px; 
    		font-weight: bold;
    	}*/
    	tr:hover td {background:#FF7F50}
    	
			
    </style>
@endsection
@section('js')
<script>

</script>
@endsection



{{-- @extends('layouts.app')

@section('content')
	<div>
		<div >
			@if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
			 <div align="center">{{ __('İPLİK İRSALİYE LİSTESİ') }}
				<button type="button" onclick="location.href='{{ route('iplikirsaliye.create') }}'"class="btn btn-outline-info">Yeni</button>
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
								<th>No</th>
								<th>Yer</th>
								<th>Hareket Türü</th>
								<th>Firma</th>
								<th>Sipariş No </th>
								<th>Giriş Tarihi </th>
								<th>Çıkış Tarihi </th>
								<th>İrsaliye No</th>
								<th>Fatura No</th>
								<th>İplik Cinsi</th>
								<th>İplik Marka</th>
								<th>Renk</th>
								<th>Ne/No</th>
								<th>Açıklama</th>
								<th></th>
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

		var table= $('#table').DataTable({
			//order : //['5','desc'],    
			order:[],    
			processing: true,
			serverSide: true,
			ajax: '{{ route('iplikirsaliyejs') }}',
			columns: [
			{ data: 'id' , "defaultContent": "" },
			{ data: 'firmatipi.name' , "defaultContent": "" },
			{ data: 'hareketturu.name' , "defaultContent": ""},
			{ data: 'firma.name' , "defaultContent": ""},
			{ data: 'order.order_no' , "defaultContent": ""},
			{ data: 'gtrh' },
			{ data: 'ctrh' },
			{ data: 'irsaliye_no' },
			{ data: 'fatura_no' },
			{ data: 'iplikirsaliyedetail.0.iplikcins.name' , "defaultContent": ""},
			{ data: 'iplikirsaliyedetail.0.iplikmarka' , "defaultContent": ""},
			{ data: 'iplikirsaliyedetail.0.renk' , "defaultContent": ""},
			{
			
					data:'iplikirsaliyedetail.0.iplikno' ,
					render:function (data,type,row) {
						if(data != null)
				return row.iplikirsaliyedetail[0].iplikno + '/' + row.iplikirsaliyedetail[0].ne;
			},"defaultContent": " "
			},
			{ data: 'aciklama' },
			{data: 'action', name: 'action', orderable: false, searchable: false}
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
@endsection --}}