@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sevkiyat Ham Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('sevkham.update', $sevkham->id) }}">
                        @method('PATCH')
                        @csrf
                      <div class="form-group row">
                                <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma Tipi') }}</label>

                                <div class="col-md-6">
                                    <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror">
                                            <option value="{{$sevkham->firma_id}}">{{$sevkham->firma->name}}</option>
                                        @foreach ($firma as $list)
                                            <option value="{{$list->id}}" id="firma_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('firma_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="firmatipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma Tipi') }}</label>

                                <div class="col-md-6">
                                    <select name='firmatipi_id' class="form-control  @error('firmatipi_id') is-invalid @enderror">
                                            <option value="{{$sevkham->firmatipi_id}}">{{$sevkham->firmatipi->name}}</option>
                                        @foreach ($firmatipi as $list)
                                            <option value="{{$list->id}}" id="firmatipi_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('firmatipi_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                              <div class="form-group row">
                            <label for="irsaliyeno" class="col-md-4 col-form-label text-md-right">{{ ('İrsaliye No') }}</label>

                            <div class="col-md-6">
                                <input id="irsaliyeno" type="text" class="form-control @error('irsaliyeno') is-invalid @enderror" name="irsaliyeno" required autocomplete="irsaliyeno" value="{{$sevkham->irsaliyeno}}" autofocus>

                                @error('irsaliyeno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="trh" class="col-md-4 col-form-label text-md-right">{{ ('Tarih') }}</label>

                            <div class="col-md-6">
                                <input id="trh" type="date" class="form-control @error('trh') is-invalid @enderror" name="trh" autocomplete="trh" value="{{$sevkham->trh}}" autofocus>

                                @error('trh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="adres" class="col-md-4 col-form-label text-md-right">{{ __('Adres') }}</label>
                                <div class="col-md-6">
                                     <textarea id="adres" type="text" class="form-control"  name="adres" autocomplete="adres" autofocus>{{$sevkham->adres}}
                                    </textarea>
                                    </div>
                        </div>
                        <div class="form-group row">
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama" autocomplete="aciklama" autofocus>{{$sevkham->aciklama}}
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
