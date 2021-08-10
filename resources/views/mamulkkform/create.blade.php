@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mamul KK Form Ekleme') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('mamulkkform.store') }}">
                        @csrf
                         <div class="form-group row">
                                <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş No') }}</label>

                                 <div class="col-md-6">
                                    <select name='order_id' class="form-control  @error('order_id') is-invalid @enderror">
                                            <option value="">Seçiniz..</option>
                                        @foreach ($order as $list)
                                            <option value="{{$list->id}}" id="order_id">{{$list->firma->zarano}}-{{mb_substr($list->order_no,6) }}---{{$list->miktar}}mt ---{{$list->desenadi}}</option>
                                        @endforeach
                                    </select>
                                     @error('order_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 

                        <div class="form-group row">
                            <label for="topno" class="col-md-4 col-form-label text-md-right">{{ __('Top No') }}</label>

                            <div class="col-md-6">
                                <input id="topno" type="text" class="form-control @error('topno') is-invalid @enderror" name="topno" value="{{ old('topno') }}" autocomplete="topno" autofocus>

                                @error('topno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="metre" class="col-md-4 col-form-label text-md-right">{{ __('Net Metre') }}</label>

                            <div class="col-md-6">
                                <input id="metre" type="text" class="form-control @error('metre') is-invalid @enderror" name="metre" value="{{ old('metre') }}" autocomplete="metre" autofocus>

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
                                <input id="brutmetre" type="text" class="form-control @error('brutmetre') is-invalid @enderror" name="brutmetre" value="{{ old('brutmetre') }}" autocomplete="brutmetre" autofocus>

                                @error('brutmetre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kumaseni" class="col-md-4 col-form-label text-md-right">{{ __('Kumaş Eni') }}</label>

                            <div class="col-md-6">
                                <input id="kumaseni" type="text" class="form-control @error('kumaseni') is-invalid @enderror" name="kumaseni" value="{{ old('kumaseni') }}" autocomplete="kumaseni" autofocus>

                                @error('kumaseni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kg" class="col-md-4 col-form-label text-md-right">{{ __('KG') }}</label>

                            <div class="col-md-6">
                                <input id="kg" type="text" class="form-control @error('kg') is-invalid @enderror" name="kg" value="{{ old('kg') }}" autocomplete="kg" autofocus>

                                @error('kg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ebat" class="col-md-4 col-form-label text-md-right">{{ __('Ebat') }}</label>

                            <div class="col-md-6">
                                <input id="ebat" type="text" class="form-control @error('ebat') is-invalid @enderror" name="ebat" value="{{ old('ebat') }}" autocomplete="ebat" autofocus>

                                @error('ebat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="trh" class="col-md-4 col-form-label text-md-right">{{ __('Tarih') }}</label>

                            <div class="col-md-6">
                                <input id="trh" type="date" class="form-control @error('trh') is-invalid @enderror" name="trh" value="{{ old('trh') }}" autocomplete="trh" autofocus>

                                @error('trh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="makina" class="col-md-4 col-form-label text-md-right">{{ __('Makina No') }}</label>

                            <div class="col-md-6">
                                <input id="makina" type="text" class="form-control @error('makina') is-invalid @enderror" name="makina" value="{{ old('makina') }}" autocomplete="makina" autofocus>

                                @error('makina')
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
                                    {{ __('Ekle') }}
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
