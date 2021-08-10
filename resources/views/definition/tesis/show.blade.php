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
				<div class="card-header">{{ __('Tesis Detayı') }}</div>

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
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('tesis Adı:  ') }}{{ $tesis->name }}</label>	
					</div></td><td>
					<div class="form-group row">
						<label for="unvan" class="col-md-6 col-form-label text-md-center">{{ __('Ünvan:  ') }}{{ $tesis->unvan }}</label>	
					</div></td></tr>
					<tr><td>
					<div class="form-group row">
						<label for="vergidairesi" class="col-md-6 col-form-label text-md-center">{{ __('Vergi Dairesi:  ') }}{{ $tesis->vergidairesi }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="verginumarasi" class="col-md-6 col-form-label text-md-center">{{ __('Vergi Numarası:  ') }}{{ $tesis->verginumarasi }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="tel1" class="col-md-6 col-form-label text-md-center">{{ __('Telefon 1  :')   }}{{ $tesis->tel1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="tel2" class="col-md-6 col-form-label text-md-center">{{ __('Telefon 2  :')   }}{{ $tesis->tel2 }}</label>	
					</div></td></tr>
					<tr><td>
					<div class="form-group row">
						<label for="fax1" class="col-md-6 col-form-label text-md-center">{{ __('Fax 1  :  ') }}{{ $tesis->fax1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="fax2" class="col-md-6 col-form-label text-md-center">{{ __('Fax 2  :  ') }}{{ $tesis->fax2 }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="email1" class="col-md-6 col-form-label text-md-center">{{ __('Email 1  :  ') }}{{ $tesis->email1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="email2" class="col-md-6 col-form-label text-md-center">{{ __('Email 2  :  ') }}{{ $tesis->email2 }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="adres1" class="col-md-6 col-form-label text-md-center">{{ __('Adres 1  :  ') }}{{ $tesis->adres1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="adres2" class="col-md-6 col-form-label text-md-center">{{ __('Adres 2  :  ') }}{{ $tesis->adres2 }}</label>	
					</div></td></tr>	
					<tr><td>	
					<div class="form-group row">
						<label for="banka" class="col-md-6 col-form-label text-md-center">{{ __('Banka  :  ') }}{{ $tesis->banka }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="sube" class="col-md-6 col-form-label text-md-center">{{ __('Şube  :  ') }}{{ $tesis->sube }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="hesapno" class="col-md-6 col-form-label text-md-center">{{ __('Hesap NO  :  ') }}{{ $tesis->hesapno }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="iban" class="col-md-6 col-form-label text-md-center">{{ __('İban  :  ') }}{{ $tesis->iban }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="website" class="col-md-6 col-form-label text-md-center">{{ __('Web Site  :  ') }}{{ $tesis->website }}</label>	
					</div></td><td>		
					<div class="form-group row">
						<label for="aciklama" class="col-md-6 col-form-label text-md-center">{{ __('Açıklama  :  ') }}{{ $tesis->aciklama }}</label>	
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
