@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-auto">
			<div class="card">
				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<div class="card-header text-md-center"><H3>{{ __('Mamul Kalite Kontrol Detayı') }}</H3></div>
							<div class="card-body">
								<table id="datatable" class="table">
									<thead>
										<tr>
											<div class="col-md-6">
												<td><h5>Sipariş No </h5></td>
												<td><h5>Top no </h5></td>
												<td><h5>Metre</h5></td>
												<td><h5>Brut Metre</h5></td>
												<td><h5>Kumaş Eni</h5></td>
												<td><h5>KG</h5></td>
												<td><h5>Makina No</h5></td>
												<td><h5>Ebat</h5></td>
												<td><h5>Tarih</h5></td>
												<td><h5>Açıklama</h5></td>
												<td><h5></h5></td>
											</div>
										</tr>
									</thead>
									<tbody> @php $toplam=0; $bruttoplam=0; @endphp 
										@isset($mamulkkform)
										@foreach ($mamulkkform as $list)
										<tr>
											<td>{{ $list->order->order_no }}</td>
											<td>{{ $list->topno }}</td>
											<td>{{ $list->metre }}</td>
											<td>{{ $list->brutmetre }}</td>
											<td>{{ $list->kumaseni }}</td>
											<td>{{ $list->kg }}</td>
											<td>{{ $list->makina }}</td>
											<td>{{ $list->ebat }}</td>
											<td>{{ $list->trh }}</td>
											<td>{{ $list->aciklama }}</td>
											<td align="right">
                                    <a href="{{route('mamulkkform.edit',$list->id)}}" style="color:black"><i class="far fa-edit fa-2x"></i></a>
	                                </td>
	                                 <td>
	                                        <form action="{{route('mamulkkform.destroy', $list->id)}}" method="POST">
	                                            @csrf
	                                            @method('DELETE')
	                                            <button class="btn btn-danger" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
	                                        </form>
	                                    </div> 
	                                </td>
										</tr>
										@php $toplam += $list->metre; $bruttoplam +=$list->brutmetre; @endphp
										@endforeach @endisset

										<tr>
											<td colspan="2">TOPLAM</td> 
											<td> {{$toplam}}mt </td> 
											<td> {{$bruttoplam}}mt </td> 
											<td colspan="4"></td> 
										</tr>
									</tbody>
								</table>		
							</div>    
						</div>
					</div>
				</div>
			</div>
			@endsection
