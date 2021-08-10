@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Levent  Güncelle') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('leventdepostore') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$leventdepo->id}}">
                        <div class="form-group row">
                            <label for="telsayi" class="col-md-4 col-form-label text-md-right">{{ (' Levent Barcode ') }}</label>
                            <label class="col-md-4 col-form-label text-md-right">
                            {{$leventdepo->barcode}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="telsayi" class="col-md-4 col-form-label text-md-right">{{ (' Tel Sayısı ') }}</label>

                            <div class="col-md-6">
                                <input id="telsayi" type="text" class="form-control @error('telsayi') is-invalid @enderror" name="telsayi"  autocomplete="telsayi" value="{{$leventdepo->telsayi}}" autofocus>

                                @error('telsayi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="leventeni" class="col-md-4 col-form-label text-md-right">{{ __('Eni') }}</label>

                               <div class="col-md-6">
                                <input id="leventeni" type="text" class="form-control @error('leventeni') is-invalid @enderror" name="leventeni"  autocomplete="leventeni" value="{{$leventdepo->leventeni}}" autofocus>

                                @error('leventeni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="metraj" class="col-md-4 col-form-label text-md-right">{{ __('Metraj') }}</label>

                               <div class="col-md-6">
                                <input id="metraj" type="text" class="form-control @error('metraj') is-invalid @enderror" name="metraj"  autocomplete="metraj" value="{{$leventdepo->metraj}}" autofocus>

                                @error('metraj')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="kg" class="col-md-4 col-form-label text-md-right">{{ __('KG') }}</label>

                               <div class="col-md-6">
                                <input id="kg" type="text" class="form-control @error('kg') is-invalid @enderror" name="kg"  autocomplete="kg" value="{{$leventdepo->kg}}" autofocus>

                                @error('kg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="durum_id" class="col-md-4 col-form-label text-md-right">{{ __('Durum') }}</label>

                                <div class="col-md-6">
                                    <select name='durum_id' class="form-control  @error('durum_id') is-invalid @enderror" >
                                            <option value="{{$leventdepo->durum_id}}">{{$leventdepo->durum->name}}</option>
                                        @foreach ($durum as $list)
                                            <option value="{{$list->id}}" id="durum_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('durum_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
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
