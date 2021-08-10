@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-auto">
			<div class="card">
				<div class="card-header text-md-center"><H3>{{ __('Sipariş Detayı') }}</H3></div>
							<div class="card-body">
								<table id="datatable" class="table">
									<thead>
										<tr>
											<div class="col-md-6">
												<td><h5>Sipariş No </h5></td>
												<td><h5>Desen No</h5></td>
												<td><h5>Sipariş Türü </h5></td>
												<td><h5>Kalite</h5></td>
												<td><h5>Sip. Tarih</h5></td>
												<td><h5>Ham En</h5></td>
												<td><h5>Sip. Miktarı</h5></td>
											</div>
										</tr>
									</thead>
									<tbody> 
										<tr>
											<td>{{ $order->order_no }}</td>
											<td>{{ $order->desen->no ?? ''}}</td>
											<td>{{ $order->ordertur->name ?? ''}}</td>
											<td>{{ $order->kalite }}</td>
											<td>{{ $order->siptrh }}</td>
											<td>{{ $order->hamen }}</td>
											<td>{{ $order->miktar }}{{$order->munit->name ?? ''}}</td>
										</tr>
										<tr>
											<td colspan="10">
				<div class="card-header text-md-center"><H3>{{ __('Sipariş Topları') }}</H3></div>
											</td>
										</tr>
										<tr>
											<div class="col-md-6">
												<td><h5>Barcode</h5></td>
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
										@php $toplam=0;  $hatayuzdesi=0; @endphp 
										@isset($order->ball)
										@foreach ($order->ball as $list)
										<tr>
											<td>{{ $list->barcode }}</td>
											<td>{{ $list->type }}</td>
											<td>{{ $list->metre }}</td>
											<td>{{ $list->brutmetre }}</td>
											<td>{{ $list->kumaseni }}</td>
											<td>{{ $list->kg }}</td>
											<td>{{ $list->machine->name ?? ''}}</td>
											<td>{{ $list->ebat }}</td>
											<td>{{ $list->trh }}</td>
											
										</tr>
										@php $toplam += $list->metre;  @endphp
										@endforeach @endisset

										<tr>
											<td colspan="1">TOPLAM</td> 
											<td> {{ count($order->ball) }} top </td> 
											<td> {{$toplam }} metre </td> 
										</tr>
									</tbody>
								</table>
							</div>    
						</div>
					</div>
				</div>
			</div>
			@endsection
