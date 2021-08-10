@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('KKForm Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('kkform.update', $kkform->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                                <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş No') }}</label>

                                <div class="col-md-6">
                                    <select name='order_id' class="form-control  @error('order_id') is-invalid @enderror" >
                                            <option value="{{$kkform->order_id}}">{{$kkform->order->order_no}}</option>
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
                            <label for="barcode" class="col-md-4 col-form-label text-md-right">{{ ('Top No') }}</label>

                            <div class="col-md-6">
                                <input id="barcode" type="text" class="form-control @error('barcode') is-invalid @enderror" name="barcode" autocomplete="barcode" value="{{$kkform->barcode}}" autofocus>

                                @error('barcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="brutmetre" class="col-md-4 col-form-label text-md-right">{{ ('Brüt Metre') }}</label>

                            <div class="col-md-6">
                                <input id="brutmetre" type="text" class="form-control @error('brutmetre') is-invalid @enderror" name="brutmetre" autocomplete="brutmetre" value="{{$kkform->brutmetre}}" autofocus>

                                @error('brutmetre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="metre" class="col-md-4 col-form-label text-md-right">{{ ('Net Metre') }}</label>

                            <div class="col-md-6">
                                <input id="metre" type="text" class="form-control @error('metre') is-invalid @enderror" name="metre" autocomplete="metre" value="{{$kkform->metre}}" autofocus>

                                @error('metre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kumaseni" class="col-md-4 col-form-label text-md-right">{{ ('Kumaş Eni') }}</label>

                            <div class="col-md-6">
                                <input id="kumaseni" type="text" class="form-control @error('kumaseni') is-invalid @enderror" name="kumaseni" autocomplete="kumaseni" value="{{$kkform->kumaseni}}" autofocus>

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
                                <input id="kg" type="text" class="form-control @error('kg') is-invalid @enderror" name="kg" autocomplete="kg" value="{{$kkform->kg}}" autofocus>

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
                                <input id="ebat" type="text" class="form-control @error('ebat') is-invalid @enderror" name="ebat" autocomplete="ebat" value="{{$kkform->ebat}}" autofocus>

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
                                <input id="trh" type="date" class="form-control @error('trh') is-invalid @enderror" name="trh" autocomplete="trh" value="{{$kkform->trh}}" autofocus>

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
                                <input id="makina" type="text" class="form-control @error('makina') is-invalid @enderror" name="makina" autocomplete="makina" value="{{$kkform->makina}}" autofocus>

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
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama" autocomplete="aciklama" autofocus>{{$kkform->aciklama}}
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
