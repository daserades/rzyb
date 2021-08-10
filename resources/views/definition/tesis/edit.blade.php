@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tesis Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('tesis.update', $tesis->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Ad') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" value="{{$tesis->name}}" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="firmas_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                <div class="col-md-6">
                                    <select name='firmas_id' class="form-control  @error('firmas_id') is-invalid @enderror" required>
                                            <option value="{{$tesis->firmas_id}}">{{$tesis->firma->name}}</option>
                                        @foreach ($firma as $list)
                                            <option value="{{$list->id}}" id="firmas_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('firmas_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="firmatipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma Tipi') }}</label>

                                <div class="col-md-6">
                                    <select name='firmatipi_id' class="form-control  @error('firmatipi_id') is-invalid @enderror" required>
                                            <option value="{{$tesis->firmatipi_id}}">{{$tesis->firmatipi->name}}</option>
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
                            <label for="unvan" class="col-md-4 col-form-label text-md-right">{{ ('Ünvan') }}</label>

                            <div class="col-md-6">
                                <input id="unvan" type="text" class="form-control @error('unvan') is-invalid @enderror" name="unvan" autocomplete="unvan" value="{{$tesis->unvan}}" autofocus>

                                @error('unvan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vergidairesi" class="col-md-4 col-form-label text-md-right">{{ ('Vergi Dairesi') }}</label>

                            <div class="col-md-6">
                                <input id="vergidairesi" type="text" class="form-control @error('vergidairesi') is-invalid @enderror" name="vergidairesi" autocomplete="vergidairesi" value="{{$tesis->vergidairesi}}" autofocus>

                                @error('vergidairesi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="verginumarasi" class="col-md-4 col-form-label text-md-right">{{ ('Vergi Numarası') }}</label>

                            <div class="col-md-6">
                                <input id="verginumarasi" type="text" class="form-control @error('verginumarasi') is-invalid @enderror" name="verginumarasi" autocomplete="verginumarasi" value="{{$tesis->verginumarasi}}" autofocus>

                                @error('verginumarasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel1" class="col-md-4 col-form-label text-md-right">{{ ('Telefon 1') }}</label>

                            <div class="col-md-6">
                                <input id="tel1" type="text" class="form-control @error('tel1') is-invalid @enderror" name="tel1"  autocomplete="tel1" value="{{$tesis->tel1}}" autofocus>

                                @error('tel1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel2" class="col-md-4 col-form-label text-md-right">{{ ('Telefon 2') }}</label>

                            <div class="col-md-6">
                                <input id="tel2" type="text" class="form-control @error('tel2') is-invalid @enderror" name="tel2"  autocomplete="tel2" value="{{$tesis->tel2}}" autofocus>

                                @error('tel2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax1" class="col-md-4 col-form-label text-md-right">{{ ('Fax 1') }}</label>

                            <div class="col-md-6">
                                <input id="fax1" type="text" class="form-control @error('fax1') is-invalid @enderror" name="fax1" autocomplete="fax1" value="{{$tesis->fax1}}" autofocus>

                                @error('fax1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax2" class="col-md-4 col-form-label text-md-right">{{ ('Fax 2') }}</label>

                            <div class="col-md-6">
                                <input id="fax2" type="text" class="form-control @error('fax2') is-invalid @enderror" name="fax2" autocomplete="fax2" value="{{$tesis->fax2}}" autofocus>

                                @error('fax2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="adres1" class="col-md-4 col-form-label text-md-right">{{ __('Adres 1') }}</label>
                                <div class="col-md-6">
                                     <textarea id="adres1" type="text" class="form-control"  name="adres1" autocomplete="adres1" autofocus>{{$tesis->adres1}}
                                    </textarea>
                                    </div>
                        </div>
                        <div class="form-group row">
                                <label for="adres2" class="col-md-4 col-form-label text-md-right">{{ __('Adres 2') }}</label>
                                <div class="col-md-6">
                                     <textarea id="adres2" type="text" class="form-control"  name="adres2" autocomplete="adres2" autofocus>{{$tesis->adres2}}
                                    </textarea>
                                    </div>
                        </div>
                        <div class="form-group row">
                            <label for="banka" class="col-md-4 col-form-label text-md-right">{{ ('Banka') }}</label>

                            <div class="col-md-6">
                                <input id="banka" type="text" class="form-control @error('banka') is-invalid @enderror" name="banka" autocomplete="banka" value="{{$tesis->banka}}" autofocus>

                                @error('banka')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sube" class="col-md-4 col-form-label text-md-right">{{ ('Şube') }}</label>

                            <div class="col-md-6">
                                <input id="sube" type="text" class="form-control @error('sube') is-invalid @enderror" name="sube" autocomplete="sube" value="{{$tesis->sube}}" autofocus>

                                @error('sube')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hesapno" class="col-md-4 col-form-label text-md-right">{{ ('Hesap No') }}</label>

                            <div class="col-md-6">
                                <input id="hesapno" type="text" class="form-control @error('hesapno') is-invalid @enderror" name="hesapno" autocomplete="hesapno" value="{{$tesis->hesapno}}" autofocus>

                                @error('hesapno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iban" class="col-md-4 col-form-label text-md-right">{{ ('İban') }}</label>

                            <div class="col-md-6">
                                <input id="iban" type="text" class="form-control @error('iban') is-invalid @enderror" name="iban" autocomplete="iban" value="{{$tesis->iban}}" autofocus>

                                @error('iban')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">{{ ('Web Site') }}</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" autocomplete="website" value="{{$tesis->website}}" autofocus>

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
                                    <select name='durums_id' class="form-control  @error('durums_id') is-invalid @enderror">
                                            <option value="{{$tesis->durums_id}}">{{$tesis->durum->name}}</option>
                                        @foreach ($durum as $list)
                                            <option value="{{$list->id}}" id="durums_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('durums_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama" autocomplete="aciklama" autofocus>{{$tesis->aciklama}}
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
