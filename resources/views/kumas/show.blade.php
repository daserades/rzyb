@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-auto">
			<div class="card">
				<div class="card-header text-md-center"><H3>{{ __('KUMAŞ KABUL RAPURU') }}</H3></div>
							<div class="card-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<div class="col-md-6">
												<td><h5></h5></td>
												<td><h5>Sipariş No</h5></td>
												<td><h5>Barcode</h5></td>
												<td><h5>Top no </h5></td>
												<td><h5>Metre</h5></td>
												<td><h5>Kumaş Eni</h5></td>
												<td><h5>KG</h5></td>
												<td><h5>Ebat</h5></td>
											</div>
										</tr>
									</thead>
									<tbody> @php $toplam=0; $bruttoplam=0; @endphp 
										@isset($ball)
										@foreach ($ball as $list)
										<tr>
											<td>{{$loop->iteration}} </td>
											<td>{{ $list->order->order_no }}</td>
											<td>{{ $list->barcode }}</td>
											<td>{{ $list->type }}</td>
											<td>{{ $list->metre }}</td>
											<td>{{ $list->kumaseni }}</td>
											<td>{{ $list->kg }}</td>
											<td>{{ $list->ebat }}</td>
										</tr>
										@php $toplam += $list->metre;  @endphp
										@endforeach @endisset

										<tr>
											<td colspan="4">TOPLAM</td> 
											<td> {{$toplam}}mt </td> 
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
