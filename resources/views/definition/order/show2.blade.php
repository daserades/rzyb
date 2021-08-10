@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
				<div class="card-header">{{ __('Sipariş Detayı') }}</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<div class="card-body">
					<table class="table" border="2"> 
					<tr><td colspan="3">
					<div class="form-group row">
						<label for="order_no" class="col-md-12 col-form-label text-md-center"><font size="6">{{ __('Sipariş No:  ') }} {{ mb_substr($order->order_no,0,4).'-'.mb_substr($order->order_no,4,2).'-'.mb_substr($order->order_no,6) }}</font></label>
					</div></td></tr><tr><td>
					<div class="form-group row">
						<label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('Firma Adı:  ') }}{{ $order->firma->name }}</label>	
					</div></td><td>
					<div class="form-group row">
						<label for="firma_no" class="col-md-12 col-form-label text-md-left">{{ __('Firma No:  ') }}{{ $order->firma_no }}</label>	
					</div></td>
					<td><div class="form-group row">
						<label for="tesis_id" class="col-md-12 col-form-label text-md-left">{{ __('Tesis Adı:  ') }}@isset($order->tesis->name){{ $order->tesis->name }}@endisset</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="ordertur_id" class="col-md-12 col-form-label text-md-left">{{ __('Sipariş Türü  :')   }} @isset($order->ordertur->name){{ $order->ordertur->name }} @endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="en" class="col-md-12 col-form-label text-md-left">{{ __('En  :')   }}{{ $order->en }}</label>	
					</div></td><td>
					<div class="form-group row">
						<label for="boy" class="col-md-12 col-form-label text-md-left">{{ __('Boy  :  ') }}{{ $order->boy }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="ebatcinsi_id" class="col-md-12 col-form-label text-md-left">{{ __('Ebat Cinsi  :  ') }} @isset($order->ebatcins->name) {{ $order->ebatcins->name }} @endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="kenarcinsi_id" class="col-md-12 col-form-label text-md-left">{{ __('Kenar Cinsi  :  ') }} @isset($order->kenarcinsi->name){{ $order->kenarcinsi->name }} @endisset</label>	
					</div></td>
						<td>	
					<div class="form-group row">
						<label for="kenartipi_id" class="col-md-12 col-form-label text-md-left">{{ __('Kenar Tipi  :  ') }} @isset($order->kenartipi->name){{ $order->kenartipi->name }} @endisset</label>	
					</div></td><tr>
					<td>	
					<div class="form-group row">
						<label for="miktar" class="col-md-12 col-form-label text-md-left">{{ __('Miktar  :  ') }}{{ $order->miktar }} @isset($order->unit->name){{ $order->unit->name}} @endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="termin" class="col-md-12 col-form-label text-md-left">{{ __('Termin  :  ') }}{{ date('d-m-Y', strtotime($order->termin)) }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="const" class="col-md-12 col-form-label text-md-left">{{ __('Konstruksiyon  :  ') }}{{ $order->const }}</label>
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="renk" class="col-md-12 col-form-label text-md-left">{{ __('Çözgü Renk  :  ') }}{{ $order->renk }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="renk2" class="col-md-12 col-form-label text-md-left">{{ __('Atkı Renk:  ') }}{{ $order->renk2 }}</label>	
					</div></td>
						<td>	
					<div class="form-group row">
						<label for="odemesekli" class="col-md-12 col-form-label text-md-left">{{ __('Ödeme Şekli  :  ') }}{{ $order->odemesekli }}</label>	
					</div></td></tr>
					<tr><td>@role('admin|genel mudur|muhasebe')	
					<div class="form-group row">
						<label for="fiyat" class="col-md-12 col-form-label text-md-left">{{ __('Fiyat  :  ') }}{{ $order->fiyat }}@isset($order->kur->name){{ $order->kur->name }}@endisset</label>	
					</div> @endrole </td><td>	
					<div class="form-group row">
						<label for="vade" class="col-md-12 col-form-label text-md-left">{{ __('Vade  :  ') }}{{ $order->vade }}</label>	
					</div></td><td>		
					<div class="form-group row">
						<label for="bazkur" class="col-md-12 col-form-label text-md-left">{{ __('Sabitlenen Kur  :  ') }}{{ $order->bazkur }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="orderadres" class="col-md-12 col-form-label text-md-left">{{ __('Teslimat Adresi  :  ') }}{{ $order->orderadres }}</label>	
					</div></td><td colspan="2">		
					<div class="form-group row">
						<label for="sevkiyat" class="col-md-12 col-form-label text-md-left">{{ __('Sevkiyat Şekli  :  ') }}{{ $order->sevkiyat }}</label>	
					</div></td></tr>
					<tr><td colspan="3">	
					<div class="form-group row">
						<label for="aciklama1" class="col-md-12 col-form-label text-md-left">{{ __('Açıklama1  :  ') }}{{ $order->aciklama1 }}</label>	
					</div></td></tr><tr><td colspan="3">	
					<div class="form-group row">
						<label for="aciklama2" class="col-md-12 col-form-label text-md-left">{{ __('Açıklama2  :  ') }}{{ $order->aciklama2 }}</label>	
					</div></td></tr>					
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
