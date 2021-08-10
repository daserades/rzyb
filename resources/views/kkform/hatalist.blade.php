@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-auto">
			<div class="card">
				<div class="card-header text-md-center"><H3>{{ __('Kalite Kontrol Detayı') }}</H3></div>
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
											</div>
										</tr>
									</thead>
									<tbody> 
										<tr>
											<td>{{ $ball->order->order_no }}</td>
											<td>{{ $ball->type }}</td>
											<td>{{ $ball->metre }}</td>
											<td>{{ $ball->brutmetre }}</td>
											<td>{{ $ball->kumaseni }}</td>
											<td>{{ $ball->kg }}</td>
											<td>{{ $ball->machine->name }}</td>
											<td>{{ $ball->ebat }}</td>
											<td>{{ $ball->trh }}</td>
										</tr>
										<tr>
											<td colspan="10">
				<div class="card-header text-md-center"><H3>{{ __('Kalite Kontrol Hataları') }}</H3></div>
											</td>
										</tr>
										<tr>
											<div class="col-md-6">
												<th>Hata Metresi</th>
												<th>Hata</th>
												<th>Puan</th>
												<th>Vardiya 1</th>
												<th>Vardiya 2</th>
												<th></th>
											</div>
										</tr>
										@php $toplam=0;  $hatayuzdesi=0; @endphp 
										@isset($ball->kkform->kkformdetail)
										@foreach ($ball->kkform->kkformdetail as $list)
										<tr>
											<td>{{ $list->metre }}</td>
											<td>{{ $list->hatalist->name }}</td>
											<td>{{ $list->hatapuan->name }}</td>
											<td>{{ $list->vardiya1->name }}</td>
											<td>{{ $list->vardiya2->name }}</td>
											
										</tr>
										@php $toplam += $list->hatapuan->name;  $hatayuzdesi = $toplam * 100 / $ball->metre;@endphp
										@endforeach @endisset

										<tr>
											<td colspan="2">TOPLAM</td> 
											<td> {{$toplam}}mt </td> 
										</tr>
										<tr>
											<td colspan="2">Hata Yüzdesi</td> 
											<td> {{number_format($hatayuzdesi,2)}} </td>
										</tr>
									</tbody>
								</table>
							</div>    
						</div>
					</div>
				</div>
			</div>
			@endsection
