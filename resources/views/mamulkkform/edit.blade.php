@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mamul KK Form Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('mamulkkform.update', $mamulkkform->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                                <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Departman') }}</label>

                                <div class="col-md-6">
                                    <select name='order_id' class="form-control  @error('order_id') is-invalid @enderror" required>
                                            <option value="{{$mamulkkform->order_id}}">{{$mamulkkform->order->order_no}}</option>
                                        @foreach ($order as $list)
                                            <option value="{{$list->id}}" id="order_id">{{$list->order_no}}</option>
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
                            <label for="topno" class="col-md-4 col-form-label text-md-right">{{ ('Top No') }}</label>

                            <div class="col-md-6">
                                <input id="topno" type="text" class="form-control @error('topno') is-invalid @enderror" name="topno" autocomplete="topno" value="{{$mamulkkform->topno}}" autofocus>

                                @error('topno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="metre" class="col-md-4 col-form-label text-md-right">{{ ('Metre') }}</label>

                            <div class="col-md-6">
                                <input id="metre" type="text" class="form-control @error('metre') is-invalid @enderror" name="metre" autocomplete="metre" value="{{$mamulkkform->metre}}" autofocus>

                                @error('metre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="brutmetre" class="col-md-4 col-form-label text-md-right">{{ ('Brüt Metre') }}</label>

                            <div class="col-md-6">
                                <input id="brutmetre" type="text" class="form-control @error('brutmetre') is-invalid @enderror" name="brutmetre" autocomplete="brutmetre" value="{{$mamulkkform->brutmetre}}" autofocus>

                                @error('brutmetre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kumaseni" class="col-md-4 col-form-label text-md-right">{{ ('Kumaş Eni') }}</label>

                            <div class="col-md-6">
                                <input id="kumaseni" type="text" class="form-control @error('kumaseni') is-invalid @enderror" name="kumaseni" autocomplete="kumaseni" value="{{$mamulkkform->kumaseni}}" autofocus>

                                @error('kumaseni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kg" class="col-md-4 col-form-label text-md-right">{{ ('KG') }}</label>

                            <div class="col-md-6">
                                <input id="kg" type="text" class="form-control @error('kg') is-invalid @enderror" name="kg" autocomplete="kg" value="{{$mamulkkform->kg}}" autofocus>

                                @error('kg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ebat" class="col-md-4 col-form-label text-md-right">{{ ('Ebat') }}</label>

                            <div class="col-md-6">
                                <input id="ebat" type="text" class="form-control @error('ebat') is-invalid @enderror" name="ebat" autocomplete="ebat" value="{{$mamulkkform->ebat}}" autofocus>

                                @error('ebat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="trh" class="col-md-4 col-form-label text-md-right">{{ ('Tarih') }}</label>

                            <div class="col-md-6">
                                <input id="trh" type="date" class="form-control @error('trh') is-invalid @enderror" name="trh" autocomplete="trh" value="{{$mamulkkform->trh}}" autofocus>

                                @error('trh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="makina" class="col-md-4 col-form-label text-md-right">{{ ('Makina No') }}</label>

                            <div class="col-md-6">
                                <input id="makina" type="text" class="form-control @error('makina') is-invalid @enderror" name="makina" autocomplete="makina" value="{{$mamulkkform->makina}}" autofocus>

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
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama" autocomplete="aciklama" autofocus>{{$mamulkkform->aciklama}}
                                    </textarea>
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
