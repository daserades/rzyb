@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Yetkili Ekle') }}</div>

                     @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('yetkili.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Ad') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Soyad') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}"  autocomplete="surname" autofocus>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                <div class="col-md-6">
                                    <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($firma as $list)
                                            <option value="{{$list->id}}" id="firma_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('firma_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tesis_id" class="col-md-4 col-form-label text-md-right">{{ __('Tesis') }}</label>

                                <div class="col-md-6">
                                    <select name='tesis_id' class="form-control  @error('tesis_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($tesis as $list)
                                            <option value="{{$list->id}}" id="tesis_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('tesis_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="gorevlistesi_id" class="col-md-4 col-form-label text-md-right">{{ __('Görev Listesi') }}</label>

                                <div class="col-md-6">
                                    <select name='gorevlistesi_id' class="form-control  @error('gorevlistesi_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($gorevlistesi as $list)
                                            <option value="{{$list->id}}" id="gorevlistesi_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('gorevlistesi_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Telefon') }}</label>

                                <div class="col-md-6">

                                    <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}"  autocomplete="tel" autofocus placeholder="5554443322">
                                    @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                           <div class="form-group row">
                                <label for="ceptel" class="col-md-4 col-form-label text-md-right">{{ __('Cep Telefonu') }}</label>

                                <div class="col-md-6">

                                    <input id="ceptel" type="text" class="form-control @error('ceptel') is-invalid @enderror" name="ceptel" value="{{ old('ceptel') }}"  autocomplete="ceptel" autofocus>
                                    @error('ceptel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"placeholder="asd@gmail.com">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Aciklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>
                                    </textarea>
                                    </div>
                            </div> 
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Yetkili Ekle') }}
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