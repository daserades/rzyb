@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <div class="card">
                    <div class="card-header">{{ __('Sipariş Ekle') }}</div>

                     @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('order.store') }}" enctype="multipart/form-data">
                        <table align="center">
                            @csrf
                            <tr><td>
                            <div class="form-group row">
                                <label for="firma_id" id="sipno" class="col-md-6 col-form-label text-md-center">{{ __('Firma') }}</label>

                                 <div class="col-md-6">
                                    <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($firma as $list)
                                            <option value="{{$list->id}}" id="firma_id">{{$list->zarano}}</option>
                                        @endforeach
                                    </select>
                                     @error('firma_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </td><td>
                            <div class="form-group row">
                                <label for="tesis_id" class="col-md-6 col-form-label text-md-center">{{ __('Tesis') }}</label>

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
                        </td><td>
                            <div class="form-group row">
                                <label for="ordertur_id" class="col-md-6 col-form-label text-md-center">{{ __('Sipariş Türü') }}</label>

                                 <div class="col-md-6">
                                       <select name='ordertur_id' class="form-control  @error('ordertur_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($ordertur as $list)
                                            <option value="{{$list->id}}" id="ordertur_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('ordertur_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </td></tr><tr><td>
                             <div class="form-group row">
                                <label for="desen_id" class="col-md-6 col-form-label text-md-center">{{ __('Desen No') }}</label>

                                 <div class="col-md-6">
                                       <select name='desen_id' id="desen_id" class="form-control  @error('desen_id') is-invalid @enderror">
                                            <option value="">Seçiniz..</option>
                                        @foreach ($desen as $list)
                                            <option value="{{$list->id}}" >{{$list->no}}</option>
                                        @endforeach
                                    </select>
                                    @error('desen_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="firma_no" class="col-md-6 col-form-label text-md-center">{{ __('Firma Sip. No') }}</label>

                                <div class="col-md-6">
                                    <input id="firma_no" type="text" class="form-control @error('firma_no') is-invalid @enderror" name="firma_no" value="{{ old('firma_no') }}"  autocomplete="firma_no" autofocus>

                                    @error('firma_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="kalite" class="col-md-6 col-form-label text-md-center">{{ __('Kalite') }}</label>

                                <div class="col-md-6">
                                    <input id="kalite" type="text" class="form-control @error('kalite') is-invalid @enderror" name="kalite" value="{{ old('kalite') }}"  autocomplete="kalite" autofocus>

                                    @error('kalite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td></tr><tr><td>
                             <div class="form-group row">
                                <label for="leventgenisligi" class="col-md-6 col-form-label text-md-center">{{ __('Levent Genişliği') }}</label>

                                <div class="col-md-6">
                                    <input id="leventgenisligi" type="text" class="form-control @error('leventgenisligi') is-invalid @enderror" name="leventgenisligi" value="{{ old('leventgenisligi') }}"  autocomplete="leventgenisligi" autofocus>

                                    @error('leventgenisligi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="cts" class="col-md-6 col-form-label text-md-center">{{ __('Top Tel Sayısı') }}</label>

                                <div class="col-md-6">
                                    <input id="cts" type="text" class="form-control @error('cts') is-invalid @enderror" name="cts" value="{{ old('cts') }}"  autocomplete="cts" autofocus>

                                    @error('cts')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                            <div class="form-group row">
                                <label for="irsaliyesekli_id" class="col-md-6 col-form-label text-md-center">{{ __('İrsaliye Şekli') }}</label>

                                 <div class="col-md-6">
                                    <select name='irsaliyesekli_id' class="form-control  @error('irsaliyesekli_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($irsaliyesekli as $list)
                                            <option value="{{$list->id}}" id="irsaliyesekli_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('irsaliyesekli_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </td></tr><tr><td>
                             <div class="form-group row">
                                <label for="tarakeni" class="col-md-6 col-form-label text-md-center">{{ __('Tarak Eni') }}</label>

                                <div class="col-md-6">
                                    <input id="tarakeni" type="text" class="form-control @error('tarakeni') is-invalid @enderror" name="tarakeni" value="{{ old('tarakeni') }}"  autocomplete="tarakeni" autofocus>

                                    @error('tarakeni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="tarakno" class="col-md-6 col-form-label text-md-center">{{ __('Tarak No') }}</label>

                               
                                <div class="col-md-6">
                                    <input id="tarakno" type="text" class="form-control @error('tarakno') is-invalid @enderror" name="tarakno" value="{{ old('tarakno') }}"  autocomplete="tarakno" autofocus>

                                    @error('tarakno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="makinatip" class="col-md-6 col-form-label text-md-center">{{ __('Makina Tipi') }}</label>

                                <div class="col-md-6">
                                    <input id="makinatip" type="text" class="form-control @error('makinatip') is-invalid @enderror" name="makinatip" value="{{ old('makinatip') }}"  autocomplete="makinatip" autofocus>

                                    @error('makinatip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td></tr><tr><td>
                             <div class="form-group row">
                                <label for="atkisikligi" class="col-md-6 col-form-label text-md-center">{{ __('ORT Sıklığı') }}</label>

                                <div class="col-md-6">
                                    <input id="atkisikligi" type="text" class="form-control @error('atkisikligi') is-invalid @enderror" name="atkisikligi" value="{{ old('atkisikligi') }}"  autocomplete="atkisikligi" autofocus>

                                    @error('atkisikligi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="cozgumetraji" class="col-md-6 col-form-label text-md-center">{{ __('Çözgü Metrajı') }}</label>

                                <div class="col-md-6">
                                    <input id="cozgumetraji" type="text" class="form-control @error('cozgumetraji') is-invalid @enderror" name="cozgumetraji" value="{{ old('cozgumetraji') }}"  autocomplete="cozgumetraji" autofocus>

                                    @error('cozgumetraji')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="ortakcozgumetraji" class="col-md-6 col-form-label text-md-center">{{ __('Ortak Çözgü Metrajı') }}</label>

                                <div class="col-md-6">
                                    <input id="ortakcozgumetraji" type="text" class="form-control @error('ortakcozgumetraji') is-invalid @enderror" name="ortakcozgumetraji" value="{{ old('ortakcozgumetraji') }}"  autocomplete="ortakcozgumetraji" autofocus>

                                    @error('ortakcozgumetraji')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td></tr><tr><td>
                             <div class="form-group row">
                                <label for="desenadi" class="col-md-6 col-form-label text-md-center">{{ __('Desen Adı - Varyant ') }}</label>

                                <div class="col-md-4">
                                    <input id="desenadi" type="text" class="form-control @error('desenadi') is-invalid @enderror" name="desenadi" value="{{ old('desenadi') }}"  autocomplete="desenadi" autofocus>

                                    @error('desenadi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <input id="varyant" type="text" class="form-control @error('varyant') is-invalid @enderror" name="varyant" value="{{ old('varyant') }}"  autocomplete="varyant" autofocus>

                                    @error('varyant')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="en" class="col-md-6 col-form-label text-md-center">{{ __('En (cm)') }}</label>

                                <div class="col-md-6">
                                    <input id="en" type="text" class="form-control @error('en') is-invalid @enderror" name="en" value="{{ old('en') }}"  autocomplete="en" autofocus>

                                    @error('en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="hamen" class="col-md-6 col-form-label text-md-center">{{ __('Ham En (cm)') }}</label>

                                <div class="col-md-6">
                                    <input id="hamen" type="text" class="form-control @error('hamen') is-invalid @enderror" name="hamen" value="{{ old('hamen') }}"  autocomplete="hamen" autofocus>

                                    @error('hamen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td></tr><tr><td>
                             <div class="form-group row">
                                <label for="boy" class="col-md-6 col-form-label text-md-center">{{ __('Boy (cm)') }}</label>

                                <div class="col-md-6">
                                    <input id="boy" type="text" class="form-control @error('boy') is-invalid @enderror" name="boy" value="{{ old('boy') }}"  autocomplete="boy" autofocus>

                                    @error('boy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                            <div class="form-group row">
                                <label for="ebatcins_id" class="col-md-6 col-form-label text-md-center">{{ __('Ebat Cinsi') }}</label>

                                 <div class="col-md-6">
                                       <select name='ebatcins_id' class="form-control  @error('ebatcins_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($ebatcins as $list)
                                            <option value="{{$list->id}}" id="ebatcins_id">{{$list->code}}</option>
                                        @endforeach
                                    </select>
                                     @error('ebatcins_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                            <div class="form-group row">
                                <label for="kenartipi_id" class="col-md-6 col-form-label text-md-center">{{ __('Kenar Tipi') }}</label>

                                 <div class="col-md-6">
                                       <select name='kenartipi_id' class="form-control  @error('kenartipi_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($kenartipi as $list)
                                            <option value="{{$list->id}}" id="kenartipi_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('kenartipi_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td></tr><tr><td>
                            <div class="form-group row">
                                <label for="kenarcinsi_id" class="col-md-6 col-form-label text-md-center">{{ __('Kenar Cinsi') }}</label>

                                 <div class="col-md-6">
                                       <select name='kenarcinsi_id' class="form-control  @error('kenarcinsi_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($kenarcinsi as $list)
                                            <option value="{{$list->id}}" id="kenarcinsi_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('kenarcinsi_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                            <div class="form-group row">
                                <label for="kalitedetay_id" class="col-md-6 col-form-label text-md-center">{{ __('Kalite Detay') }}</label>

                                 <div class="col-md-6">
                                       <select name='kalitedetay_id' class="form-control  @error('kalitedetay_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($kalitedetay as $list)
                                            <option value="{{$list->id}}" id="kalitedetay_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('kalitedetay_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="miktar" class="col-md-5 col-form-label text-md-center">{{ __('Sipariş Miktarı') }}</label>

                                <div class="col-md-3">
                                    <input id="miktar" type="text" class="form-control @error('en') is-invalid @enderror" name="miktar" value="{{ old('miktar') }}"  autocomplete="miktar" autofocus>

                                    @error('miktar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                 <div class="col-md-4">
                                        <select name='munit_id'  class="form-control  @error('munit_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($unit as $list)
                                            <option value="{{$list->id}}" >{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('munit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td></tr><tr><td>
                             <div class="form-group row">
                                <label for="termin" class="col-md-6 col-form-label text-md-center">{{ __('Termin') }}</label>

                                <div class="col-md-6">
                                    <input id="termin" type="date" class="form-control @error('en') is-invalid @enderror" name="termin" value="{{ old('termin') }}"  autocomplete="termin" autofocus>

                                    @error('termin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="renk" class="col-md-6 col-form-label text-md-center">{{ __('Çözgü Renk') }}</label>

                                <div class="col-md-6">
                                    <input id="renk" type="text" class="form-control @error('en') is-invalid @enderror" name="renk" value="{{ old('renk') }}"  autocomplete="renk" autofocus>

                                    @error('renk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                             <div class="form-group row">
                                <label for="renk2" class="col-md-6 col-form-label text-md-center">{{ __('Atkı Renk') }}</label>

                                <div class="col-md-6">
                                    <input id="renk2" type="text" class="form-control @error('en') is-invalid @enderror" name="renk2" value="{{ old('renk2') }}"  autocomplete="renk2" autofocus>

                                    @error('renk2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td></tr><tr><td>
                             <div class="form-group row">
                                <label for="const" class="col-md-6 col-form-label text-md-center">{{ __('Konstrüksiyon') }}</label>

                                <div class="col-md-6">
                                    <input id="const" type="text" class="form-control @error('en') is-invalid @enderror" name="const" value="{{ old('const') }}"  autocomplete="const" autofocus>

                                    @error('const')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td><td>
                            <div class="form-group row">
                                <label for="fiyat" class="col-md-3 col-form-label text-md-center">{{ __('Fiyat') }}</label>

                                <div class="col-md-5">

                                    <input id="fiyat" type="text" class="form-control @error('fiyat') is-invalid @enderror" name="fiyat" value="{{ old('fiyat') }}"  autocomplete="fiyat" autofocus >
                                    @error('fiyat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                 <div class="col-md-4">
                                    <select name='unit_id' class="form-control  @error('unit_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($unit as $list)
                                            <option value="{{$list->id}}" id="unit_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('unit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div> </td><td>
                            <div class="form-group row">
                                <label for="kur_id" class="col-md-6 col-form-label text-md-center">{{ __('Para Birimi') }}</label>

                                 <div class="col-md-6">
                                    <select name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror" >
                                            <option value="">Seçiniz..</option>
                                        @foreach ($kur as $list)
                                            <option value="{{$list->id}}" id="kur_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('kur_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td></tr><tr><td>
                            <div class="form-group row">
                                <label for="vade" class="col-md-6 col-form-label text-md-center">{{ __('Vade') }}</label>

                                <div class="col-md-6">

                                    <input id="vade" type="text" class="form-control @error('vade') is-invalid @enderror" name="vade" value="{{ old('vade') }}"  autocomplete="vade" autofocus >
                                    @error('vade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> </td><td>
                            <div class="form-group row">
                                <label for="bazkur" class="col-md-6 col-form-label text-md-center">{{ __('Baz Alınan Kur') }}</label>

                                <div class="col-md-6">

                                    <input id="bazkur" type="text" class="form-control @error('bazkur') is-invalid @enderror" name="bazkur" value="{{ old('bazkur') }}"  autocomplete="bazkur" autofocus >
                                    @error('bazkur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> </td><td>
                            <div class="form-group row">
                                <label for="odemesekli" class="col-md-6 col-form-label text-md-center">{{ __('Ödeme Şekli') }}</label>

                                <div class="col-md-6">

                                    <input id="odemesekli" type="text" class="form-control @error('odemesekli') is-invalid @enderror" name="odemesekli" value="{{ old('odemesekli') }}"  autocomplete="odemesekli" autofocus>
                                    @error('odemesekli')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> </td></tr>
                            <tr><td>
                            <div class="form-group row">
                                <label for="hamsip" class="col-md-6 col-form-label text-md-center">{{ __('Ham Sip. Metrajı') }}</label>

                                <div class="col-md-6">

                                    <input id="hamsip" type="text" class="form-control @error('hamsip') is-invalid @enderror" name="hamsip" value="{{ old('hamsip') }}"  autocomplete="hamsip" autofocus >
                                    @error('hamsip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> </td><td>
                            <div class="form-group row">
                                <label for="mamulsip" class="col-md-6 col-form-label text-md-center">{{ __('Mamul Sip. Metrajı') }}</label>

                                <div class="col-md-6">

                                    <input id="mamulsip" type="text" class="form-control @error('mamulsip') is-invalid @enderror" name="mamulsip" value="{{ old('mamulsip') }}"  autocomplete="mamulsip" autofocus >
                                    @error('mamulsip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> </td><td>
                            <div class="form-group row">
                                <label for="gelencozgumetre" class="col-md-6 col-form-label text-md-center">{{ __('Gelen Çözgü Metrajı') }}</label>

                                <div class="col-md-6">

                                    <input id="gelencozgumetre" type="text" class="form-control @error('gelencozgumetre') is-invalid @enderror" name="gelencozgumetre" value="{{ old('gelencozgumetre') }}"  autocomplete="gelencozgumetre" autofocus>
                                    @error('gelencozgumetre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> </td></tr>
                              <tr><td>
                            <div class="form-group row">
                                <label for="dokumaadet" class="col-md-6 col-form-label text-md-center">{{ __('Yan Yana Dokuma Adeti') }}</label>

                                <div class="col-md-6">

                                    <input id="dokumaadet" type="text" class="form-control @error('dokumaadet') is-invalid @enderror" name="dokumaadet" value="{{ old('dokumaadet') }}"  autocomplete="dokumaadet" autofocus >
                                    @error('dokumaadet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> </td><td>
                            <div class="form-group row">
                                <label for="dokumatelsayi" class="col-md-6 col-form-label text-md-center">{{ __('Dokunan Tel Sayısı(adet)') }}</label>

                                <div class="col-md-6">

                                    <input id="dokumatelsayi" type="text" class="form-control @error('dokumatelsayi') is-invalid @enderror" name="dokumatelsayi" value="{{ old('dokumatelsayi') }}"  autocomplete="dokumatelsayi" autofocus >
                                    @error('dokumatelsayi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> </td><td>
                            <div class="form-group row">
                                <label for="dokumateleni" class="col-md-6 col-form-label text-md-center">{{ __('Dokunan Tel Eni(adet-cm)') }}</label>

                                <div class="col-md-6">

                                    <input id="dokumateleni" type="text" class="form-control @error('dokumateleni') is-invalid @enderror" name="dokumateleni" value="{{ old('dokumateleni') }}"  autocomplete="dokumateleni" autofocus>
                                    @error('dokumateleni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> </td></tr>
                             <tr>
                            <td>
                             <div class="form-group row">
                                <label for="siptrh" class="col-md-6 col-form-label text-md-center">{{ __('Sipariş Tarihi') }}</label>

                                <div class="col-md-6">
                                    <input id="siptrh" type="date" class="form-control @error('en') is-invalid @enderror" name="siptrh" value="{{ old('siptrh') }}"  autocomplete="siptrh" autofocus>

                                    @error('siptrh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div></td>
                            <td>
                            <div class="form-group row">
                                <label for="duzboyarenkno" class="col-md-6 col-form-label text-md-center">{{ __('Düz Boya Renk No') }}</label>

                                <div class="col-md-6">

                                    <input id="duzboyarenkno" type="text" class="form-control @error('duzboyarenkno') is-invalid @enderror" name="duzboyarenkno" value="{{ old('duzboyarenkno') }}"  autocomplete="duzboyarenkno" autofocus>
                                    @error('duzboyarenkno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> </td>
                              <td>
                            <div class="form-group row">
                                <label for="sevkiyat" class="col-md-3 col-form-label text-md-center">{{ __('Sevkiyat Şekli') }}</label>
                                <div class="col-md-9">
                                     <textarea id="sevkiyat" type="text" class="form-control"  name="sevkiyat"  autocomplete="sevkiyat" autofocus>
                                    </textarea>
                                    </div>
                            </div> </td></tr>
                            <tr>
                                  <td colspan="3">
                            <div class="form-group row">
                                <label for="orderadres" class="col-md-3 col-form-label text-md-center">{{ __('Teslimat Adresi') }}</label>
                                <div class="col-md-9">
                                     <textarea id="orderadres" type="text" class="form-control"  name="orderadres"  autocomplete="orderadres" autofocus>
                                    </textarea>
                                    </div>
                            </div> </td>
                            </tr>
                            <tr><td colspan="2">
                             <div class="form-group row">
                                <label for="orderproses" class="col-md-3 col-form-label text-md-center">{{ __('Boyahane Firma/Proses') }}</label>
                                <div class="col-md-9">
                                     <textarea id="orderproses" type="text" class="form-control"  name="orderproses"  autocomplete="orderproses" autofocus>
                                    </textarea>
                                    </div>
                            </div> </td>
                             <td colspan="2">
                             <div class="form-group row">
                                <label for="aciklama1" class="col-md-3 col-form-label text-md-center">{{ __('Açıklama 1') }}</label>
                                <div class="col-md-9">
                                     <textarea id="aciklama1" type="text" class="form-control"  name="aciklama1"  autocomplete="aciklama1" autofocus>
                                    </textarea>
                                    </div>
                            </div> </td></tr>
                            <tr><td colspan="2">
                             <div class="form-group row">
                                <label for="aciklama2" class="col-md-3 col-form-label text-md-center">{{ __('Açıklama 2') }}</label>
                                <div class="col-md-9">
                                     <textarea id="aciklama2" type="text" class="form-control"  name="aciklama2"  autocomplete="aciklama2" autofocus>
                                    </textarea>
                                    </div>
                            </div> </td><td>
                             <div class="form-group row">
                                <label for="aciklama3" class="col-md-3 col-form-label text-md-center">{{ __('Açıklama 3') }}</label>
                                <div class="col-md-9">
                                     <textarea id="aciklama3" type="text" class="form-control"  name="aciklama3"  autocomplete="aciklama3" autofocus>
                                    </textarea>
                                    </div>
                            </div> </td></tr>
                             <tr>
                <td colspan="3">
                <div class="form-check">
                <input type="checkbox" class="form-check-input" name="numune">
                <label class="form-check-label" for="exampleCheck1">Numune Sipariş mi?</label>
              </div>
                </td>
            </tr>
<tr><td colspan="3">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Resimleri Seç</label>
                <input type="file" class="form-control" name='resimler[]' multiple >
            </div></td></tr>
                        </table>
                            <div class="row">
                            <div class="left">
                              <table>
                                 <thead>
                                    <th>Ç</th>
                                    <th>İplik No/Ne</th>
                                    <th>Renk No</th>
                                    <th>Renk Adı</th>
                                    <th>B.İplik KG</th>
                                    <th>G.İplik KG</th>
                                </thead>
                                <tbody>
                                    @for($i=1; $i <= 12; $i++)
                                    <tr>
                                    <td>{{$i}}</td>
                                    <td><input type="text" size="15" class="form-control" name="cinsne{{$i}}"></td>
                                    <td><input type="text" size="15" class="form-control" name="crenkno{{$i}}"></td>
                                    <td><input type="text" size="15" class="form-control" name="crenk{{$i}}"></td>  
                                    <td><input type="text" size="15" class="form-control" name="boyanankg{{$i}}"></td> 
                                    <td><input type="text" size="15" class="form-control" name="gelenkg{{$i}}"></td>   
                                    </tr>
                                    @endfor
                                </tbody>
                                </table>
                            </div>
                            <div class="right">
                                <table>
                                   <thead>
                                    <th>A</th>
                                    <th>İplik No/Ne</th>
                                    <th>Renk No</th>
                                    <th>Renk Adı</th>
                                    <th>B.İplik KG</th>
                                    <th>G.İplik KG</th>
                                    <th>Atkı Sıklık</th>
                                   </thead>
                                   <tbody>
                                   @for($i=1; $i <= 12; $i++)
                                    <tr>
                                    <td>{{$i}}</td>
                                    <td><input type="text" size="15" class="form-control" name="acinsne{{$i}}"></td>
                                    <td><input type="text" size="15" class="form-control" name="arenkno{{$i}}"></td>
                                    <td><input type="text" size="15" class="form-control" name="ar{{$i}}"></td>  
                                    <td><input type="text" size="15" class="form-control" name="aboyanankg{{$i}}"></td> 
                                    <td><input type="text" size="15" class="form-control" name="agelenkg{{$i}}"></td>   
                                    <td><input type="text" size="15" class="form-control" name="asiklik{{$i}}"></td>   
                                    </tr>   
                                    @endfor
                                   </tbody>
                                </table>
                            </div>
                        </div>                          
                             <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-6 text-md-left">
                                    <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                    <button type="submit" id="ekle" class="btn btn-success">
                                        {{ __('Sipariş Ekle') }}
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

@section('css') 
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
    $("select[name=firma_id]").change(function() {
         fid = $("select[name=firma_id").children(":selected").val();
        if(fid){
            $.ajax({
             type:"get",
             url:'{{url('order/orderno')}}/'+fid, 
             success:function(res)
             {     
                $("#sipno").empty();
                $("#sipno").text('Firma '+res);
            }
           });
        }

        $('#ekle').click(function(){
            $(this).hide();
        });
});
    
$( function() {
    $('#desen_id').select2({ width: '270px' });
});

</script>
@endsection