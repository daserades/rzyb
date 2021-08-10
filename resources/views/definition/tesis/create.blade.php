@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tesis Ekle') }}</div>

                     @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('tesis.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tesis Adı') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                 <div class="col-md-6">
                                    <select name='firmas_id' class="form-control  @error('firmas_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($firma as $list)
                                            <option value="{{$list->id}}" id="firmas_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('firmas_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="firmatipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma Tipi') }}</label>

                                 <div class="col-md-6">
                                    <select name='firmatipi_id' class="form-control  @error('firmatipi_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($firmatipi as $list)
                                            <option value="{{$list->id}}" id="firmatipi_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('firmatipi_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                             <div class="form-group row">
                                <label for="unvan" class="col-md-4 col-form-label text-md-right">{{ __('Ünvan') }}</label>

                                <div class="col-md-6">

                                    <input id="unvan" type="text" class="form-control @error('unvan') is-invalid @enderror" name="unvan" value="{{ old('unvan') }}"  autocomplete="unvan" autofocus placeholder="unvan">
                                    @error('unvan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="vergidairesi" class="col-md-4 col-form-label text-md-right">{{ __('Vergi Dairesi') }}</label>

                                <div class="col-md-6">

                                    <input id="vergidairesi" type="text" class="form-control @error('vergidairesi') is-invalid @enderror" name="vergidairesi" value="{{ old('vergidairesi') }}"  autocomplete="vergidairesi" autofocus placeholder="vergidairesi">
                                    @error('vergidairesi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="verginumarasi" class="col-md-4 col-form-label text-md-right">{{ __('Vergi Numarası') }}</label>

                                <div class="col-md-6">

                                    <input id="verginumarasi" type="text" class="form-control @error('verginumarasi') is-invalid @enderror" name="verginumarasi" value="{{ old('verginumarasi') }}"  autocomplete="verginumarasi" autofocus placeholder="verginumarasi">
                                    @error('verginumarasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="tel1" class="col-md-4 col-form-label text-md-right">{{ __('Telefon 1') }}</label>

                                <div class="col-md-6">

                                    <input id="tel1" type="text" class="form-control @error('tel1') is-invalid @enderror" name="tel1" value="{{ old('tel1') }}"  autocomplete="tel1" autofocus placeholder="5554443321">
                                    @error('tel1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="tel2" class="col-md-4 col-form-label text-md-right">{{ __('Telefon 2') }}</label>

                                <div class="col-md-6">

                                    <input id="tel2" type="text" class="form-control @error('tel2') is-invalid @enderror" name="tel2" value="{{ old('tel2') }}"  autocomplete="tel2" autofocus placeholder="5554443321">
                                    @error('tel2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="fax1" class="col-md-4 col-form-label text-md-right">{{ __('Fax 1') }}</label>

                                <div class="col-md-6">

                                    <input id="fax1" type="text" class="form-control @error('fax1') is-invalid @enderror" name="fax1" value="{{ old('fax1') }}"  autocomplete="fax1" autofocus placeholder="5554443321">
                                    @error('fax1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="fax2" class="col-md-4 col-form-label text-md-right">{{ __('Fax 2') }}</label>

                                <div class="col-md-6">

                                    <input id="fax2" type="text" class="form-control @error('fax2') is-invalid @enderror" name="fax2" value="{{ old('fax2') }}"  autocomplete="fax2" autofocus placeholder="5554443321">
                                    @error('fax2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="email1" class="col-md-4 col-form-label text-md-right">{{ __('Email 1') }}</label>

                                <div class="col-md-6">

                                    <input id="email1" type="text" class="form-control @error('email1') is-invalid @enderror" name="email1" value="{{ old('email1') }}"  autocomplete="email1" autofocus placeholder="asd@gmail.com">
                                    @error('email1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="email2" class="col-md-4 col-form-label text-md-right">{{ __('Email 2') }}</label>

                                <div class="col-md-6">

                                    <input id="email2" type="text" class="form-control @error('email2') is-invalid @enderror" name="email2" value="{{ old('email2') }}"  autocomplete="email2" autofocus placeholder="asd@gmail.com">
                                    @error('email2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="adres1" class="col-md-4 col-form-label text-md-right">{{ __('Adres 1') }}</label>
                                <div class="col-md-6">
                                     <textarea id="adres1" type="text" class="form-control"  name="adres1"  autocomplete="adres1" autofocus>
                                    </textarea>
                                    </div>
                            </div> 
                            <div class="form-group row">
                                <label for="adres2" class="col-md-4 col-form-label text-md-right">{{ __('Adres 2') }}</label>
                                <div class="col-md-6">
                                     <textarea id="adres2" type="text" class="form-control"  name="adres2"  autocomplete="adres2" autofocus>
                                    </textarea>
                                    </div>
                            </div> 
                            <div class="form-group row">
                                <label for="banka" class="col-md-4 col-form-label text-md-right">{{ __('Banka') }}</label>

                                <div class="col-md-6">

                                    <input id="banka" type="text" class="form-control @error('banka') is-invalid @enderror" name="banka" value="{{ old('banka') }}"  autocomplete="banka" autofocus placeholder="banka">
                                    @error('banka')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="sube" class="col-md-4 col-form-label text-md-right">{{ __('Şube') }}</label>

                                <div class="col-md-6">

                                    <input id="sube" type="text" class="form-control @error('sube') is-invalid @enderror" name="sube" value="{{ old('sube') }}"  autocomplete="sube" autofocus placeholder="sube">
                                    @error('sube')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="hesapno" class="col-md-4 col-form-label text-md-right">{{ __('Hesapno') }}</label>

                                <div class="col-md-6">

                                    <input id="hesapno" type="text" class="form-control @error('hesapno') is-invalid @enderror" name="hesapno" value="{{ old('hesapno') }}"  autocomplete="hesapno" autofocus placeholder="hesapno">
                                    @error('hesapno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="iban" class="col-md-4 col-form-label text-md-right">{{ __('İban No') }}</label>

                                <div class="col-md-6">

                                    <input id="iban" type="text" class="form-control @error('iban') is-invalid @enderror" name="iban" value="{{ old('iban') }}"  autocomplete="iban" autofocus placeholder="iban">
                                    @error('iban')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>

                                <div class="col-md-6">

                                    <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}"  autocomplete="website" autofocus placeholder="www.asd.com">
                                    @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="durums_id" class="col-md-4 col-form-label text-md-right">{{ __('Durum') }}</label>

                                <div class="col-md-6">
                                    <select name='durums_id' class="form-control @error('durums_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($durum as $list)
                                            <option value="{{$list->id}}" id="durums_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                         @error('durums_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>
                                    </textarea>
                                    </div>
                            </div> 
                             <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Firma Ekle') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection