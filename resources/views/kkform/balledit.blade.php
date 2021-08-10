@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Top  Güncelle') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ballupdate') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$ball->id}}">
                        <div class="form-group row">
                            <label for="barcode" class="col-md-4 col-form-label text-md-right">{{ (' Top Barcode ') }}</label>
                            <label class="col-md-4 col-form-label text-md-right">
                            {{$ball->barcode}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="kumaseni" class="col-md-4 col-form-label text-md-right">{{ (' Kumaş Eni ') }}</label>

                            <div class="col-md-6">
                                <input id="kumaseni" type="text" class="form-control @error('kumaseni') is-invalid @enderror" name="kumaseni"  autocomplete="kumaseni" value="{{$ball->kumaseni}}" autofocus>

                                @error('kumaseni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="ebat" class="col-md-4 col-form-label text-md-right">{{ __('Ebat') }}</label>

                               <div class="col-md-6">
                                <input id="ebat" type="text" class="form-control @error('ebat') is-invalid @enderror" name="ebat"  autocomplete="ebat" value="{{$ball->ebat}}" autofocus>

                                @error('ebat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="metre" class="col-md-4 col-form-label text-md-right">{{ __('Metre') }}</label>

                               <div class="col-md-6">
                                <input id="metre" type="text" class="form-control @error('metre') is-invalid @enderror" name="metre"  autocomplete="metre" value="{{$ball->metre}}" autofocus>

                                @error('metre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="brutmetre" class="col-md-4 col-form-label text-md-right">{{ __('Brüt Metre') }}</label>

                               <div class="col-md-6">
                                <input id="brutmetre" type="text" class="form-control @error('brutmetre') is-invalid @enderror" name="brutmetre"  autocomplete="brutmetre" value="{{$ball->brutmetre}}" autofocus>

                                @error('brutmetre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="kg" class="col-md-4 col-form-label text-md-right">{{ __('KG') }}</label>

                               <div class="col-md-6">
                                <input id="kg" type="text" class="form-control @error('kg') is-invalid @enderror" name="kg"  autocomplete="kg" value="{{$ball->kg}}" autofocus>

                                @error('kg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="hamboy" class="col-md-4 col-form-label text-md-right">{{ __('Hamboy') }}</label>

                               <div class="col-md-6">
                                <input id="hamboy" type="text" class="form-control @error('hamboy') is-invalid @enderror" name="hamboy"  autocomplete="hamboy" value="{{$ball->hamboy}}" autofocus>

                                @error('hamboy')
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
                                    {{ __('Güncelle') }}
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
