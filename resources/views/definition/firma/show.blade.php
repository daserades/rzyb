@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
				<div class="card-header">{{ __('Firma Detayı') }}</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<div class="card-body">
					<table class="table"> 
					<tr><td>
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Firma Adı:  ') }}@isset($firma->name){{ $firma->name }}@endisset</label>	
					</div></td><td>
					<div class="form-group row">
						<label for="unvan" class="col-md-6 col-form-label text-md-center">{{ __('Ünvan:  ') }}@isset($firma->unvan){{ $firma->unvan }}@endisset</label>	
					</div></td></tr>
					<tr><td>
					<div class="form-group row">
						<label for="vergidairesi" class="col-md-6 col-form-label text-md-center">{{ __('Vergi Dairesi:  ') }}@isset($firma->vergidairesi){{ $firma->vergidairesi }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="verginumarasi" class="col-md-6 col-form-label text-md-center">{{ __('Vergi Numarası:  ') }}@isset($firma->verginumarasi){{ $firma->verginumarasi }}@endisset</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="tel1" class="col-md-6 col-form-label text-md-center">{{ __('Telefon 1  :')   }}@isset($firma->tel1){{ $firma->tel1 }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="tel2" class="col-md-6 col-form-label text-md-center">{{ __('Telefon 2  :')   }}@isset($firma->tel2){{ $firma->tel2 }}@endisset</label>	
					</div></td></tr>
					<tr><td>
					<div class="form-group row">
						<label for="fax1" class="col-md-6 col-form-label text-md-center">{{ __('Fax 1  :  ') }}@isset($firma->fax1){{ $firma->fax1 }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="fax2" class="col-md-6 col-form-label text-md-center">{{ __('Fax 2  :  ') }}@isset($firma->fax2){{ $firma->fax2 }}@endisset</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="email1" class="col-md-6 col-form-label text-md-center">{{ __('Email 1  :  ') }}@isset($firma->email1){{ $firma->email1 }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="email2" class="col-md-6 col-form-label text-md-center">{{ __('Email 2  :  ') }} @isset($firma->email2){{ $firma->email2 }}@endisset</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="adres1" class="col-md-6 col-form-label text-md-center">{{ __('Adres 1  :  ') }}@isset($firma->adres1){{ $firma->adres1 }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="adres2" class="col-md-6 col-form-label text-md-center">{{ __('Adres 2  :  ') }}@isset($firma->adres2){{ $firma->adres2 }}@endisset</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="country" class="col-md-6 col-form-label text-md-center">{{ __('Ülke  :  ') }}@isset($firma->country->name){{ $firma->country->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="city" class="col-md-6 col-form-label text-md-center">{{ __('Şehir  :  ') }}@isset($firma->city->name){{ $firma->city->name }}@endisset</label>	
					</div></td></tr>	
					<tr><td>	
					<div class="form-group row">
						<label for="banka" class="col-md-6 col-form-label text-md-center">{{ __('Banka  :  ') }}@isset($firma->banka){{ $firma->banka }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="sube" class="col-md-6 col-form-label text-md-center">{{ __('Şube  :  ') }}@isset($firma->sube){{ $firma->sube }}@endisset</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="hesapno" class="col-md-6 col-form-label text-md-center">{{ __('Hesap NO  :  ') }}@isset($firma->hesapno){{ $firma->hesapno }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="iban" class="col-md-6 col-form-label text-md-center">{{ __('İban  :  ') }}@isset($firma->iban){{ $firma->iban }}@endisset</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="website" class="col-md-6 col-form-label text-md-center">{{ __('Web Site  :  ') }} @isset($firma->website) {{ $firma->website }}@endisset</label>	
					</div></td><td>		
					<div class="form-group row">
						<label for="aciklama" class="col-md-6 col-form-label text-md-center">{{ __('Açıklama  :  ') }}@isset($firma->aciklama){{ $firma->aciklama }}@endisset</label>	
					</div></td></tr>
					<tr><td colspan="2">	
					<div class="form-group row">
						<a href="javascript:history.back()" class="btn btn-primary">Geri</a>
					</div></td></tr>					
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
