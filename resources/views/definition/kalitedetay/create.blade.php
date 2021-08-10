@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kalite Detay Ekleme') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('kalitedetay.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kalite Detay İsmi') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cozgu_iplik" class="col-md-4 col-form-label text-md-right">{{ __('Çözgü İplik') }}</label>

                            <div class="col-md-6">
                                <input id="cozgu_iplik" type="text" class="form-control @error('cozgu_iplik') is-invalid @enderror" name="cozgu_iplik" value="{{ old('cozgu_iplik') }}" autocomplete="cozgu_iplik" autofocus>

                                @error('cozgu_iplik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cozgu_siklik" class="col-md-4 col-form-label text-md-right">{{ __('Çözgü Sıklık') }}</label>

                            <div class="col-md-6">
                                <input id="cozgu_siklik" type="text" class="form-control @error('cozgu_siklik') is-invalid @enderror" name="cozgu_siklik" value="{{ old('cozgu_siklik') }}" autocomplete="cozgu_siklik" autofocus>

                                @error('cozgu_siklik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="atki_iplik" class="col-md-4 col-form-label text-md-right">{{ __('Atkı İplik') }}</label>

                            <div class="col-md-6">
                                <input id="atki_iplik" type="text" class="form-control @error('atki_iplik') is-invalid @enderror" name="atki_iplik" value="{{ old('atki_iplik') }}" autocomplete="atki_iplik" autofocus>

                                @error('atki_iplik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="atki_siklik" class="col-md-4 col-form-label text-md-right">{{ __('Atkı Sıklık') }}</label>

                            <div class="col-md-6">
                                <input id="atki_siklik" type="text" class="form-control @error('atki_siklik') is-invalid @enderror" name="atki_siklik" value="{{ old('atki_siklik') }}" autocomplete="atki_siklik" autofocus>

                                @error('atki_siklik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gsm" class="col-md-4 col-form-label text-md-right">{{ __('Gsm(Ağırlık)') }}</label>

                            <div class="col-md-6">
                                <input id="gsm" type="text" class="form-control @error('gsm') is-invalid @enderror" name="gsm" value="{{ old('gsm') }}" autocomplete="gsm" autofocus>

                                @error('gsm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Kalite Detay Ekle') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
