@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('İplik Girişi') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('patterndetail.update', $patterndetail->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                                <label for="iplikseridi_id" class="col-md-4 col-form-label text-md-right">{{ __('Desen') }}</label>

                             <div class="col-md-6">
                            @foreach ($desen as $list)
                            <label  for="desen_id" value="{{$list->id}}"><h3>{{$list->name}}</h3></label>
                            <input type="hidden" class="form-control" id="desen_id" name='desen_id' value="{{$list->id}}">
                            @endforeach
                        </div>
                    </div>
                        <div class="form-group row">
                                <label for="iplikseridi_id" class="col-md-4 col-form-label text-md-right">{{ __('İplik') }}</label>

                                <div class="col-md-6">
                                    <select name='iplikseridi_id' class="form-control  @error('iplikseridi_id') is-invalid @enderror" >
                                            <option value="{{$patterndetail->iplikseridi_id}}">{{$patterndetail->iplikseridi->name}}</option>
                                        @foreach ($iplikseridi as $list)
                                            <option value="{{$list->id}}" id="iplikseridi_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('iplikseridi_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="iplik_no" class="col-md-4 col-form-label text-md-right">{{ ('İplik NO-NE') }}</label>

                            <div class="col-md-4">
                                <input id="iplik_no" type="text" class="form-control @error('iplik_no') is-invalid @enderror" name="iplik_no"  autocomplete="iplik_no" value="{{$patterndetail->iplik_no}}" autofocus>

                                @error('iplik_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input id="iplik_kalin" type="text" class="form-control @error('iplik_kalin') is-invalid @enderror" name="iplik_kalin"  autocomplete="iplik_kalin" value="{{$patterndetail->iplik_kalin}}" autofocus>

                                @error('iplik_kalin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iplikcins_id" class="col-md-4 col-form-label text-md-right">{{ __('İplik Cinsi') }}</label>

                            <div class="col-md-6">
                                <select name='iplikcins_id' class="form-control  @error('iplikcins_id') is-invalid @enderror" >
                                        <option value="{{$patterndetail->iplikcins_id}}">{{$patterndetail->iplikcins->name}}</option>
                                    @foreach ($iplikcins as $list)
                                        <option value="{{$list->id}}" id="iplikcins_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                 @error('iplikcins_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="boyacins" class="col-md-4 col-form-label text-md-right">{{ __('İplik Boya Cinsi') }}</label>

                            <div class="col-md-6">
                                <select name='boyacins' class="form-control  @error('boyacins') is-invalid @enderror" >
                                        <option value="{{$patterndetail->boyacins}}">@isset($patterndetail->boyacins->name){{$patterndetail->boyacins->name}} @endisset</option>
                                    @foreach ($boyacins as $list)
                                        <option value="{{$list->id}}" id="boyacins">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                 @error('boyacins')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="renk_no" class="col-md-4 col-form-label text-md-right">{{ ('Renk No') }}</label>

                            <div class="col-md-6">
                                <input id="renk_no" type="text" class="form-control @error('renk_no') is-invalid @enderror" name="renk_no"  autocomplete="renk_no" value="{{$patterndetail->renk_no}}" autofocus>

                                @error('renk_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="renk" class="col-md-4 col-form-label text-md-right">{{ ('Renk') }}</label>

                            <div class="col-md-6">
                                <input id="renk" type="text" class="form-control @error('renk') is-invalid @enderror" name="renk"  autocomplete="renk" value="{{$patterndetail->renk}}" autofocus>

                                @error('renk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="renk_sayisi" class="col-md-4 col-form-label text-md-right">{{ ('K.Tel Sayısı') }}</label>

                            <div class="col-md-6">
                                <input id="renk_sayisi" type="text" class="form-control @error('renk_sayisi') is-invalid @enderror" name="renk_sayisi"  autocomplete="renk_sayisi" value="{{$patterndetail->renk_sayisi}}" autofocus>

                                @error('renk_sayisi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="atki_sikligi" class="col-md-4 col-form-label text-md-right">{{ ('Atkı Sıklığı') }}</label>

                            <div class="col-md-6">
                                <input id="atki_sikligi" type="text" class="form-control @error('atki_sikligi') is-invalid @enderror" name="atki_sikligi"  autocomplete="atki_sikligi" value="{{$patterndetail->atki_sikligi}}" autofocus>

                                @error('atki_sikligi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cozgu_sikligi" class="col-md-4 col-form-label text-md-right">{{ ('Çözgü Sıklığı') }}</label>

                            <div class="col-md-6">
                                <input id="cozgu_sikligi" type="text" class="form-control @error('cozgu_sikligi') is-invalid @enderror" name="cozgu_sikligi"  autocomplete="cozgu_sikligi" value="{{$patterndetail->cozgu_sikligi}}" autofocus>

                                @error('cozgu_sikligi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tekrar" class="col-md-4 col-form-label text-md-right">{{ ('Tekrar') }}</label>

                            <div class="col-md-6">
                                <input id="tekrar" type="text" class="form-control @error('tekrar') is-invalid @enderror" name="tekrar"  autocomplete="tekrar" value="{{$patterndetail->tekrar}}" autofocus>

                                @error('tekrar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bos_atki_sayisi" class="col-md-4 col-form-label text-md-right">{{ ('Boş Atkı S.') }}</label>

                            <div class="col-md-6">
                                <input id="bos_atki_sayisi" type="text" class="form-control @error('bos_atki_sayisi') is-invalid @enderror" name="bos_atki_sayisi"  autocomplete="bos_atki_sayisi" value="{{$patterndetail->bos_atki_sayisi}}" autofocus>

                                @error('bos_atki_sayisi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ayni_agiza_atilan_atki_sayisi" class="col-md-4 col-form-label text-md-right">{{ ('Aynı Ağıza Atılan A.S.') }}</label>

                            <div class="col-md-6">
                                <input id="ayni_agiza_atilan_atki_sayisi" type="text" class="form-control @error('ayni_agiza_atilan_atki_sayisi') is-invalid @enderror" name="ayni_agiza_atilan_atki_sayisi"  autocomplete="ayni_agiza_atilan_atki_sayisi" value="{{$patterndetail->ayni_agiza_atilan_atki_sayisi}}" autofocus>

                                @error('ayni_agiza_atilan_atki_sayisi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div class="col-md-6">
                                <textarea id="aciklama" type="text" class="form-control @error('aciklama') is-invalid @enderror" name="aciklama"  autocomplete="aciklama"autofocus rows="5">{{$patterndetail->aciklama}}

                                @error('aciklama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
