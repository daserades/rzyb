@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">{{ __('Sipariş Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('order.update', $order->id) }}" enctype="multipart/form-data">
                        <table align="center">
                        @method('PATCH')
                        @csrf
                          <center>
                        <?php 
                    $dosyaSayisi = 1;
                    if(file_exists('storage/uploads/'.$order->order_no)){
                    $klasor = opendir( 'storage/uploads/'.$order->order_no);
                        while (false !== ($girdi = readdir($klasor))) {
                            if ($girdi != "." && $girdi != "..") {
                                $ext = pathinfo($girdi);
                                $uzanti= $ext['extension'];
                                $namedosya=basename($girdi);
                         ?>
                    <img src="{{ Storage::url('uploads/'.$order->order_no.'/'.$namedosya) }}" width="300" height="150"/>   
    @if(auth()->user()->can('delete'))  <a href="{{ route('orderimagedestroy',[$order->order_no,$namedosya]) }}" style="color:red" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt fa-2x"></i></a> @endif
                    <!--<a href="{{-- route('orderimagedestroy',[$order->order_no,$dosyaSayisi]) --}}" style="color:red"><i class="far fa-trash-alt fa-2x"></i></a> -->
                               <?php
                               $dosyaSayisi++;
                            }
                        }
                        closedir($klasor);
                    }
                    ?>
                </center>
                <tr><td colspan="3">
                    <div>
                        <label for="order_no" class="col-md-12 col-form-label text-md-center"><font size="6">{{ __('Sipariş No:  ') }} 
                            @if(Str::length($order->firma->zarano)<=2 )
                            {{ mb_substr($order->order_no,0,4).'-'.mb_substr($order->order_no,4,2).'-'.mb_substr($order->order_no,6) }}
                            @else
                            {{ mb_substr($order->order_no,0,4).'-'.mb_substr($order->order_no,4,3).'-'.mb_substr($order->order_no,7) }}
                            @endif
                        </font></label>   
                    </div>
                </td>
            </tr>
                            @can('delete')

            <tr>
                <td colspan="3">
                     <div class="form-group row">
                            <label for="order_no" class="col-md-4 col-form-label text-md-right">{{ ('Sipariş No') }}</label>

                            <div class="col-md-4">
                                <input id="order_no" type="text" class="form-control @error('order_no') is-invalid @enderror" name="order_no"  autocomplete="order_no" value="{{$order->order_no}}" autofocus>

                                @error('order_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                </td>
            </tr>
            @endcan
                        <tr>
                            <td>
                        <div class="form-group row">
                                <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                <div class="col-md-6">
                                    <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" >
                                            <option value="@isset($order->firma_id){{$order->firma_id}}@endisset">@isset($order->firma->id){{$order->firma->zarano}}@endisset</option>
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
                                <label for="tesis_id" class="col-md-4 col-form-label text-md-right">{{ __('Tesis') }}</label>

                                <div class="col-md-6">
                                    <select name='tesis_id' class="form-control  @error('tesis_id') is-invalid @enderror" >
                                            <option value="@isset($order->tesis_id){{$order->tesis_id}}@endisset">@isset($order->tesis->name){{$order->tesis->name}}@endisset</option>
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
                                <label for="ordertur_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş Türü') }}</label>

                                <div class="col-md-6">
                                    <select name='ordertur_id' class="form-control  @error('ordertur_id') is-invalid @enderror" >
                                            <option value="@isset($order->ordertur_id){{$order->ordertur_id}}@endisset">@isset($order->ordertur->name){{$order->ordertur->name}}@endisset</option>
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
                        </td></tr>
                        <tr><td>
                        <div class="form-group row">
                            <label for="firma_no" class="col-md-4 col-form-label text-md-right">{{ ('Firma Sip. No') }}</label>

                            <div class="col-md-6">
                                <input id="firma_no" type="text" class="form-control @error('firma_no') is-invalid @enderror" name="firma_no"  autocomplete="firma_no" value="{{$order->firma_no}}" autofocus>

                                @error('firma_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td><td>
                        <div class="form-group row">
                            <label for="desen_id" class="col-md-4 col-form-label text-md-right">{{ ('Desen No') }}</label>
                            <div class="col-md-6">
                           <select name='desen_id' id="desen_id" class="form-control  @error('desen_id') is-invalid @enderror" >
                                            <option value="{{$order->desen_id}}">{{$order->desen->no ?? ''}}</option>
                                        @foreach ($desen as $list)
                                            <option value="{{$list->id}}">{{$list->no}}</option>
                                        @endforeach
                                    </select>
                                @error('desen_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td>
                <td>
                            <div class="form-group row">
                                <label for="irsaliyesekli_id" class="col-md-4 col-form-label text-md-right">{{ __('İrsaliye Şekli') }}</label>

                                <div class="col-md-6">
                                    <select name='irsaliyesekli_id' class="form-control  @error('irsaliyesekli_id') is-invalid @enderror" >
                                            <option value="{{$order->irsaliyesekli_id ?? ''}}">{{$order->irsaliyesekli->name ?? ''}}</option>
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
                        </td></tr>
                        <tr><td>
                        <div class="form-group row">
                            <label for="kalite" class="col-md-4 col-form-label text-md-right">{{ ('Kalite') }}</label>

                            <div class="col-md-6">
                                <input id="kalite" type="text" class="form-control @error('kalite') is-invalid @enderror" name="kalite"  autocomplete="kalite" value="{{$order->kalite}}" autofocus>

                                @error('kalite')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td><td>
                        <div class="form-group row">
                            <label for="leventgenisligi" class="col-md-4 col-form-label text-md-right">{{ ('Levent Genişliği') }}</label>

                            <div class="col-md-6">
                                <input id="leventgenisligi" type="text" class="form-control @error('leventgenisligi') is-invalid @enderror" name="leventgenisligi"  autocomplete="leventgenisligi" value="{{$order->leventgenisligi}}" autofocus>

                                @error('leventgenisligi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td><td>
                        <div class="form-group row">
                            <label for="cts" class="col-md-4 col-form-label text-md-right">{{ ('Top Tel Sayısı') }}</label>

                            <div class="col-md-6">
                                <input id="cts" type="text" class="form-control @error('cts') is-invalid @enderror" name="cts"  autocomplete="cts" value="{{$order->cts}}" autofocus>

                                @error('cts')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td></tr>
                    <tr><td>
                        <div class="form-group row">
                            <label for="tarakeni" class="col-md-4 col-form-label text-md-right">{{ ('Tarak Eni') }}</label>

                            <div class="col-md-6">
                                <input id="tarakeni" type="text" class="form-control @error('tarakeni') is-invalid @enderror" name="tarakeni"  autocomplete="tarakeni" value="{{$order->tarakeni}}" autofocus>

                                @error('tarakeni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td><td>
                        <div class="form-group row">
                            <label for="tarakno" class="col-md-4 col-form-label text-md-right">{{ ('Tarak No') }}</label>

                            <div class="col-md-6">
                                <input id="tarakno" type="text" class="form-control @error('tarakno') is-invalid @enderror" name="tarakno"  autocomplete="tarakno" value="{{$order->tarakno}}" autofocus>

                                @error('tarakno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td><td>
                        <div class="form-group row">
                            <label for="makinatip" class="col-md-4 col-form-label text-md-right">{{ ('Makina Tipi') }}</label>

                            <div class="col-md-6">
                                <input id="makinatip" type="text" class="form-control @error('makinatip') is-invalid @enderror" name="makinatip"  autocomplete="makinatip" value="{{$order->makinatip}}" autofocus>

                                @error('makinatip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td></tr>
                    <tr><td>
                        <div class="form-group row">
                            <label for="atkisikligi" class="col-md-4 col-form-label text-md-right">{{ ('ORT. Atkı Sıklığı') }}</label>

                            <div class="col-md-6">
                                <input id="atkisikligi" type="text" class="form-control @error('atkisikligi') is-invalid @enderror" name="atkisikligi"  autocomplete="atkisikligi" value="{{$order->atkisikligi}}" autofocus>

                                @error('atkisikligi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td><td>
                        <div class="form-group row">
                            <label for="cozgumetraji" class="col-md-4 col-form-label text-md-right">{{ ('Çözgü Metrajı') }}</label>

                            <div class="col-md-6">
                                <input id="cozgumetraji" type="text" class="form-control @error('cozgumetraji') is-invalid @enderror" name="cozgumetraji"  autocomplete="cozgumetraji" value="{{$order->cozgumetraji}}" autofocus>

                                @error('cozgumetraji')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td><td>
                        <div class="form-group row">
                            <label for="ortakcozgumetraji" class="col-md-4 col-form-label text-md-right">{{ ('Ortak Çözgü Metrajı') }}</label>

                            <div class="col-md-6">
                                <input id="ortakcozgumetraji" type="text" class="form-control @error('ortakcozgumetraji') is-invalid @enderror" name="ortakcozgumetraji"  autocomplete="ortakcozgumetraji" value="{{$order->ortakcozgumetraji}}" autofocus>

                                @error('ortakcozgumetraji')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td></tr><tr>
                        <td>
                            <div class="form-group row">
                            <label for="desenadi" class="col-md-4 col-form-label text-md-right">{{ 'Desen Adı - Varyant' }}</label>

                            <div class="col-md-4">
                                <input id="desenadi" type="text" class="form-control @error('desenadi') is-invalid @enderror" name="desenadi"  autocomplete="desenadi" value="{{$order->desenadi}}" autofocus>

                                @error('desenadi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input id="varyant" type="text" class="form-control @error('varyant') is-invalid @enderror" name="varyant"  autocomplete="varyant" value="{{$order->varyant}}" autofocus>

                                @error('varyant')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td>        
                        <td>
                            <div class="form-group row">
                            <label for="en" class="col-md-4 col-form-label text-md-right">{{ ('En(cm)') }}</label>

                            <div class="col-md-6">
                                <input id="en" type="text" class="form-control @error('en') is-invalid @enderror" name="en"  autocomplete="en" value="{{$order->en}}" autofocus>

                                @error('en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td><td>
                            <div class="form-group row">
                            <label for="hamen" class="col-md-4 col-form-label text-md-right">{{ ('Ham En(cm)') }}</label>

                            <div class="col-md-6">
                                <input id="hamen" type="text" class="form-control @error('hamen') is-invalid @enderror" name="hamen"  autocomplete="hamen" value="{{$order->hamen}}" autofocus>

                                @error('hamen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td></tr>
                    <tr><td>
                            <div class="form-group row">
                            <label for="boy" class="col-md-4 col-form-label text-md-right">{{ ('Boy(cm)') }}</label>

                            <div class="col-md-6">
                                <input id="boy" type="text" class="form-control @error('boy') is-invalid @enderror" name="boy"  autocomplete="boy" value="{{$order->boy}}" autofocus>

                                @error('boy')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td><td>
                            <div class="form-group row">
                                <label for="ebatcins_id" class="col-md-4 col-form-label text-md-right">{{ __('Ebat Cinsi') }}</label>

                                <div class="col-md-6">
                                    <select name='ebatcins_id' class="form-control  @error('ebatcins_id') is-invalid @enderror" >   
                                            <option value="@isset($order->ebatcins_id){{$order->ebatcins_id}}@endisset">@isset($order->ebatcins->code){{$order->ebatcins->code}}@endisset</option>
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
                            </div>
                        </td><td>
                            <div class="form-group row">
                                <label for="kenartipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Kenar Tipi') }}</label>

                                <div class="col-md-6">
                                    <select name='kenartipi_id' class="form-control  @error('kenartipi_id') is-invalid @enderror" >   
                                            <option value="@isset($order->kenartipi_id){{$order->kenartipi_id}}@endisset">@isset($order->kenartipi->name){{$order->kenartipi->name}}@endisset</option>
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
                            </div>
                        </td></tr>
                        <tr><td>
                            <div class="form-group row">
                                <label for="kenarcinsi_id" class="col-md-4 col-form-label text-md-right">{{ __('Kenar Cinsi') }}</label>

                                <div class="col-md-6">
                                    <select name='kenarcinsi_id' class="form-control  @error('kenarcinsi_id') is-invalid @enderror" >   
                                            <option value="@isset($order->kenarcinsi_id){{$order->kenarcinsi_id}}@endisset">@isset($order->kenarcinsi->name){{$order->kenarcinsi->name}}@endisset</option>
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
                            </div>
                        </td><td>
                            <div class="form-group row">
                                <label for="kalitedetay_id" class="col-md-4 col-form-label text-md-right">{{ __('Kalite Detay') }}</label>

                                <div class="col-md-6">
                                    <select name='kalitedetay_id' class="form-control  @error('kalitedetay_id') is-invalid @enderror" >   
                                            <option value="@isset($order->kalitedetay_id){{$order->kalitedetay_id}}@endisset">@isset($order->kalitedetay->name){{$order->kalitedetay->name}}@endisset</option>
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
                            </div>
                        </td><td>
                        <div class="form-group row">
                            <label for="miktar" class="col-md-3 col-form-label text-md-right">{{ ('Sipariş Miktar') }}</label>

                            <div class="col-md-3">
                                <input id="miktar" type="text" class="form-control @error('miktar') is-invalid @enderror" name="miktar"  autocomplete="miktar" value="{{$order->miktar}}" autofocus>

                                @error('miktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                                <div class="col-md-4">
                                 <select name='munit_id' class="form-control  @error('munit_id') is-invalid @enderror" >
                                            <option value="@isset($order->munit_id){{$order->munit_id}}@endisset">@isset($order->unit->name){{$order->unit->name}}@endisset</option>
                                        @foreach ($unit as $list)
                                            <option value="{{$list->id}}" id="munit_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('munit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                        </div>
                    </td></tr>
                    <tr><td>
                            <div class="form-group row">
                                <label for="termin" class="col-md-4 col-form-label text-md-right">{{ __('Termin') }}</label>

                                <div class="col-md-6">

                                    <input id="termin" type="date" class="form-control @error('termin') is-invalid @enderror" name="termin"  value="{{ date('Y-m-d',strtotime($order->termin))}}" autocomplete="termin" autofocus>
                                    @error('termin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </td><td>
                            <div class="form-group row">
                            <label for="renk" class="col-md-4 col-form-label text-md-right">{{ ('Çözgü Renk') }}</label>

                            <div class="col-md-6">
                                <input id="renk" type="text" class="form-control @error('renk') is-invalid @enderror" name="renk"  autocomplete="renk" value="{{$order->renk}}" autofocus>

                                @error('renk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </td><td>
                        <div class="form-group row">
                            <label for="renk2" class="col-md-4 col-form-label text-md-right">{{ ('Atkı Renk') }}</label>

                            <div class="col-md-6">
                                <input id="renk2" type="text" class="form-control @error('renk2') is-invalid @enderror" name="renka2"  autocomplete="renk2" value="{{$order->renk2}}" autofocus>

                                @error('renk2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         </td></tr>
                    <tr>
                            @role('admin|genel mudur')
                        <td>
                        <div class="form-group row">
                            <label for="fiyat" class="col-md-4 col-form-label text-md-right">{{ ('Fiyat') }}</label>

                            <div class="col-md-6">
                                <input id="fiyat" type="text" class="form-control @error('fiyat') is-invalid @enderror" name="fiyat"  autocomplete="fiyat" value="{{$order->fiyat}}" autofocus>

                                @error('fiyat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td>
                        <td>
                            <div class="form-group row">
                                <label for="kur_id" class="col-md-4 col-form-label text-md-right">{{ __('Para Birimi') }}</label>

                                <div class="col-md-6">
                                    <select name='kur_id' class="form-control @error('kur_id') is-invalid @enderror" >
                                            <option value="@isset($order->kur_id){{$order->kur_id}}@endisset">@isset($order->kur->name){{$order->kur->name}}@endisset</option>
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
                            </div> 
                            </td>
                    <td>
                            <div class="form-group row">
                            <label for="fiyat" class="col-md-4 col-form-label text-md-right">{{ ('Fiyat / Birim') }}</label>
                            <div class="col-md-6">
                                    <select name='unit_id' class="form-control @error('unit_id') is-invalid @enderror" >
                                            <option value="@isset($order->unit_id){{$order->unit_id}}@endisset">@isset($order->unit2->name){{$order->unit2->name}}@endisset</option>
                                        @foreach ($unit2 as $list)
                                            <option value="{{$list->id}}" id="unit_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                         @error('unit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                        </div>
                        </td>
                            @endrole
                        </tr>
                    <tr>
                        <td>
                        <div class="form-group row">
                            <label for="const" class="col-md-4 col-form-label text-md-right">{{ ('Konstrüksiyon') }}</label>

                            <div class="col-md-6">
                                <input id="const" type="text" class="form-control @error('const') is-invalid @enderror" name="const"  autocomplete="const" value="{{$order->const}}" autofocus>

                                @error('const')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vade" class="col-md-4 col-form-label text-md-right">{{ ('vade') }}</label>

                            <div class="col-md-6">
                                <input id="vade" type="text" class="form-control @error('vade') is-invalid @enderror" name="vade"  autocomplete="vade" value="{{$order->vade}}" autofocus>

                                @error('vade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </td><td>
                          <div class="form-group row">
                            <label for="bazkur" class="col-md-4 col-form-label text-md-right">{{ ('Baz Alınan Kur') }}</label>

                            <div class="col-md-6">
                                <input id="bazkur" type="text" class="form-control @error('bazkur') is-invalid @enderror" name="bazkur"  autocomplete="bazkur" value="{{$order->bazkur}}" autofocus>

                                @error('bazkur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </td><td>
                        <div class="form-group row">
                            <label for="odemesekli" class="col-md-4 col-form-label text-md-right">{{ ('Ödeme Şekli') }}</label>

                            <div class="col-md-6">
                                <input id="odemesekli" type="text" class="form-control @error('odemesekli') is-invalid @enderror" name="odemesekli"  autocomplete="odemesekli" value="{{$order->odemesekli}}" autofocus>

                                @error('odemesekli')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td></tr>
                    <tr><td>
                        <div class="form-group row">
                            <label for="hamsip" class="col-md-4 col-form-label text-md-right">{{ ('Ham Sip. Miktar') }}</label>

                            <div class="col-md-6">
                                <input id="hamsip" type="text" class="form-control @error('hamsip') is-invalid @enderror" name="hamsip"  autocomplete="hamsip" value="{{$order->hamsip}}" autofocus>

                                @error('hamsip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </td><td>
                          <div class="form-group row">
                            <label for="mamulsip" class="col-md-4 col-form-label text-md-right">{{ ('Mamul Sip. Miktar') }}</label>

                            <div class="col-md-6">
                                <input id="mamulsip" type="text" class="form-control @error('mamulsip') is-invalid @enderror" name="mamulsip"  autocomplete="mamulsip" value="{{$order->mamulsip}}" autofocus>

                                @error('mamulsip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </td><td>
                        <div class="form-group row">
                            <label for="gelencozgumetre" class="col-md-4 col-form-label text-md-right">{{ ('GElen Çözgü Metrajı') }}</label>

                            <div class="col-md-6">
                                <input id="gelencozgumetre" type="text" class="form-control @error('gelencozgumetre') is-invalid @enderror" name="gelencozgumetre"  autocomplete="gelencozgumetre" value="{{$order->gelencozgumetre}}" autofocus>

                                @error('gelencozgumetre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td></tr>
                     <tr><td>
                        <div class="form-group row">
                            <label for="dokumaadet" class="col-md-4 col-form-label text-md-right">{{ ('Yan Yana Dokuma Adeti') }}</label>

                            <div class="col-md-6">
                                <input id="dokumaadet" type="text" class="form-control @error('dokumaadet') is-invalid @enderror" name="dokumaadet"  autocomplete="dokumaadet" value="{{$order->dokumaadet}}" autofocus>

                                @error('dokumaadet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </td><td>
                          <div class="form-group row">
                            <label for="dokumatelsayi" class="col-md-4 col-form-label text-md-right">{{ ('Dokunan Tel Sayısı(adet)') }}</label>

                            <div class="col-md-6">
                                <input id="dokumatelsayi" type="text" class="form-control @error('dokumatelsayi') is-invalid @enderror" name="dokumatelsayi"  autocomplete="dokumatelsayi" value="{{$order->dokumatelsayi}}" autofocus>

                                @error('dokumatelsayi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </td><td>
                        <div class="form-group row">
                            <label for="dokumateleni" class="col-md-4 col-form-label text-md-right">{{ ('Dokunan Tel Eni(adet-cm)') }}</label>

                            <div class="col-md-6">
                                <input id="dokumateleni" type="text" class="form-control @error('dokumateleni') is-invalid @enderror" name="dokumateleni"  autocomplete="dokumateleni" value="{{$order->dokumateleni}}" autofocus>

                                @error('dokumateleni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td></tr>
                    <tr><td>
                            <div class="form-group row">
                                <label for="siptrh" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş Tarihi') }}</label>

                                <div class="col-md-6">

                                    <input id="siptrh" type="date" class="form-control @error('siptrh') is-invalid @enderror" name="siptrh"  value="{{ date('Y-m-d',strtotime($order->siptrh))}}" autocomplete="siptrh" autofocus>
                                    @error('siptrh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </td>
                        <td>
                        <div class="form-group row">
                            <label for="duzboyarenkno" class="col-md-4 col-form-label text-md-right">{{ ('Düz Boya Renk No') }}</label>

                            <div class="col-md-6">
                                <input id="duzboyarenkno" type="text" class="form-control @error('duzboyarenkno') is-invalid @enderror" name="duzboyarenkno"  autocomplete="duzboyarenkno" value="{{$order->duzboyarenkno}}" autofocus>

                                @error('duzboyarenkno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </td>
                        <td colspan="1">
                            <div class="form-group row">
                                <label for="sevkiyat" class="col-md-4 col-form-label text-md-right">{{ __('Sevkiyat Şekli') }}</label>
                                <div class="col-md-6">
                                     <textarea id="sevkiyat" type="text" class="form-control"  name="sevkiyat"  autocomplete="sevkiyat" autofocus>{{$order->sevkiyat}}
                                    </textarea>
                                    </div>
                            </div> 
                        </td></tr>
                        <tr>
                            <td colspan="3">
                         <div class="form-group row">
                                <label for="orderadres" class="col-md-3 col-form-label text-md-right">{{ __('Teslimat Adresi') }}</label>
                                <div class="col-md-9">
                                     <textarea id="orderadres" type="text" class="form-control"  name="orderadres"  autocomplete="orderadres" autofocus>{{$order->orderadres}}
                                    </textarea>
                                    </div>
                            </div>
                        </td>
                        </tr>
                        <tr><td colspan="2"> 
                            <div class="form-group row">
                                <label for="orderproses" class="col-md-3 col-form-label text-md-right">{{ __('Boyahane Firma/Proses') }}</label>
                                <div class="col-md-9">
                                     <textarea id="orderproses" type="text" class="form-control"  name="orderproses"  autocomplete="orderproses" autofocus>{{$order->orderproses}}
                                    </textarea>
                                    </div>
                            </div>
                        </td><td colspan="1">
                            <div class="form-group row">
                                <label for="aciklama1" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama 1') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama1" type="text" class="form-control"  name="aciklama1"  autocomplete="aciklama1" autofocus>{{$order->aciklama1}}
                                    </textarea>
                                    </div>
                            </div>
                        </td></tr>
                     <tr><td colspan="2">
                            <div class="form-group row">
                                <label for="aciklama2" class="col-md-3 col-form-label text-md-right">{{ __('Açıklama 2') }}</label>
                                <div class="col-md-9">
                                     <textarea id="aciklama2" type="text" class="form-control"  name="aciklama2"  autocomplete="aciklama2" autofocus>{{$order->aciklama2}}
                                    </textarea>
                                    </div>
                            </div> 
                        </td><td colspan="1">
                            <div class="form-group row">
                                <label for="aciklama3" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama 3') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama3" type="text" class="form-control"  name="aciklama3"  autocomplete="aciklama3" autofocus>{{$order->aciklama3}}
                                    </textarea>
                                    </div>
                            </div>  
                        </td></tr>
                    </tr>
                    @can('desendelete')
<tr><td colspan="3">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Resimleri Seç</label>
                <input type="file" class="form-control" name='resimler[]' multiple >
            </div></td></tr>
                    <tr><td>
                        @if($order->onay1 === 'K')
                <div class="form-check">
                <input type="checkbox" class="form-check-input" name="exampleCheck1" checked="">
                <label class="form-check-label" for="exampleCheck1">Kapatma Onayı</label>
              </div>
              @else 
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="exampleCheck1" {{ old('exampleCheck1') ? 'checked' : '' }}>
                <label class="form-check-label" for="exampleCheck1">Kapatma Onayı</label>
              </div>
              @endif
            </td></tr>
            <tr>
                <td colspan="3">
                        @if($order->numune === 'N')
                <div class="form-check">
                <input type="checkbox" class="form-check-input" name="numune" checked="">
                <label class="form-check-label" for="exampleCheck1">Numune Sipariş Mi?</label>
              </div>
              @else 
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="numune" {{ old('numune') ? 'checked' : '' }}>
                <label class="form-check-label" for="exampleCheck1">Numune Sipariş Mi?</label>
              </div>
              @endif
                </td>
            </tr>
             @endcan
        </table>
                @if( $order->id > 412)
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
                                    @for($i=0; $i <= 12; $i++)
                                    <tr>
                                    <td>{{$i}}</td>
                                    <td><input type="text" size="15" class="form-control" value="{{$order->orderdetailwarp->where('sira',$i)->pluck('cinsne')->first()}}" name="cinsne{{$i}}"></td>
                                    <td><input type="text" size="15" class="form-control" value="{{$order->orderdetailwarp->where('sira',$i)->pluck('crenkno')->first()}}" name="crenkno{{$i}}"></td>
                                    <td><input type="text" size="15" class="form-control" value="{{$order->orderdetailwarp->where('sira',$i)->pluck('crenk')->first()}}" name="crenk{{$i}}"></td>  
                                    <td><input type="text" size="15" class="form-control" value="{{$order->orderdetailwarp->where('sira',$i)->pluck('boyanankg')->first()}}" name="boyanankg{{$i}}"></td> 
                                    <td><input type="text" size="15" class="form-control" value="{{$order->orderdetailwarp->where('sira',$i)->pluck('gelenkg')->first()}}" name="gelenkg{{$i}}"></td>   
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
                                   @for($i=0; $i <= 12; $i++)
                                    <tr>
                                    <td>{{$i}}</td>
                                    <td><input type="text" size="15" class="form-control"value="{{$order->orderdetailweft->where('sira',$i)->pluck('acinsne')->first()}}" name="acinsne{{$i}}"></td>
                                    <td><input type="text" size="15" class="form-control"value="{{$order->orderdetailweft->where('sira',$i)->pluck('arenkno')->first()}}" name="arenkno{{$i}}"></td>
                                    <td><input type="text" size="15" class="form-control"value="{{$order->orderdetailweft->where('sira',$i)->pluck('arenk')->first()}}" name="ar{{$i}}"></td>  
                                    <td><input type="text" size="15" class="form-control"value="{{$order->orderdetailweft->where('sira',$i)->pluck('aboyanankg')->first()}}" name="aboyanankg{{$i}}"></td> 
                                    <td><input type="text" size="15" class="form-control"value="{{$order->orderdetailweft->where('sira',$i)->pluck('agelenkg')->first()}}" name="agelenkg{{$i}}"></td>   
                                    <td><input type="text" size="15" class="form-control"value="{{$order->orderdetailweft->where('sira',$i)->pluck('asiklik')->first()}}" name="asiklik{{$i}}"></td>   
                                    </tr>   
                                    @endfor
                                   </tbody>
                                </table>
                            </div>
                        @else
                            <table>
                                <tr>
                                  <th>Ç</th>
                                    <th>İplik No/Ne</th>
                                    <th>Renk No</th>
                                    <th>Renk Adı</th>
                                    <th>B.İplik KG</th>
                                    <th>G.İplik KG</th>
                                    <th>A</th>
                                    <th>İplik No/Ne</th>
                                    <th>Renk No</th>
                                    <th>Renk Adı</th>
                                    <th>B.İplik KG</th>
                                    <th>G.İplik KG</th>
                                    <th>Atkı Sıklık</th>
                                </tr>
                            <tr>
                                    <th>1</th>
                                    <td><input id="cno1" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cno1){{$order->orderwarp->cno1}}@endisset" name="cno1"></td>
                                    <td> <input id="cne1" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne1){{$order->orderwarp->cne1}}@endisset" name="cne1"></td>
                                    <td><input id="crenk1" type="text" size="15" class="form-control" value="@isset($order->orderwarp->crenk1){{$order->orderwarp->crenk1}}@endisset" name="crenk1"></td>
                                    <td><input id="cgr1" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cgr1){{$order->orderwarp->cgr1}}@endisset" name="cgr1"></td>
                                    <td><input id="cbg1" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cbg1){{$order->orderwarp->cbg1}}@endisset" name="cbg1"></td>
                                    <th>1 </th>
                                    <td><input id="ano1" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano1){{$order->orderweft->ano1}}@endisset" name="ano1"></td>
                                    <td> <input id="ane1" type="text" size="15" class="form-control"value="@isset($order->orderweft->ane1){{$order->orderweft->ane1}}@endisset" name="ane1"></td>
                                    <td><input id="arenk1" type="text" size="15" class="form-control"value="@isset($order->orderweft->arenk1){{$order->orderweft->arenk1}}@endisset" name="arenk1"></td>
                                    <td><input id="agr1" type="text" size="15" class="form-control"value="@isset($order->orderweft->agr1){{$order->orderweft->agr1}}@endisset" name="agr1"></td>
                                    <td><input id="abg1" type="text" size="15" class="form-control"value="@isset($order->orderweft->abg1){{$order->orderweft->abg1}}@endisset" name="abg1"></td>
                                    <td><input id="asik1" type="text" size="15" class="form-control"value="@isset($order->orderweft->asik1){{$order->orderweft->asik1}}@endisset" name="asik1"></td>
                                                
                            </tr>
                           <tr>
                                    <th>2</th>
                                    <td><input id="cno2" type="text" size="15" class="form-control"value="@isset($order->orderwarp->cno2){{$order->orderwarp->cno2}}@endisset" name="cno2"></td>
                                    <td> <input id="cne2" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne2){{$order->orderwarp->cne2}}@endisset" name="cne2"></td>
                                    <td><input id="crenk2" type="text" size="15" class="form-control"value="@isset($order->orderwarp->crenk2){{$order->orderwarp->crenk2}}@endisset" name="crenk2"></td>      
                                    <td><input id="cgr2" type="text" size="15" class="form-control"value="@isset($order->orderwarp->cgr2){{$order->orderwarp->cgr2}}@endisset" name="cgr2"></td>      
                                    <td><input id="cbg2" type="text" size="15" class="form-control"value="@isset($order->orderwarp->cbg2){{$order->orderwarp->cbg2}}@endisset" name="cbg2"></td>      
                                    <th>2 </th>
                                    <td><input id="ano2" type="text" size="15" class="form-control"value="@isset($order->orderweft->ano2){{$order->orderweft->ano2}}@endisset" name="ano2"></td>
                                    <td> <input id="ane2" type="text" size="15" class="form-control"value="@isset($order->orderweft->ane2){{$order->orderweft->ane2}}@endisset" name="ane2"></td>
                                    <td><input id="arenk2" type="text" size="15" class="form-control" value="@isset($order->orderweft->arenk2){{$order->orderweft->arenk2}}@endisset" name="arenk2"></td> 
                                    <td><input id="agr2" type="text" size="15" class="form-control" value="@isset($order->orderweft->agr2){{$order->orderweft->agr2}}@endisset" name="agr2"></td> 
                                    <td><input id="abg2" type="text" size="15" class="form-control" value="@isset($order->orderweft->abg2){{$order->orderweft->abg2}}@endisset" name="abg2"></td> 
                                    <td><input id="asik2" type="text" size="15" class="form-control" value="@isset($order->orderweft->asik2){{$order->orderweft->asik2}}@endisset" name="asik2"></td> 
                            </tr>
                            <tr>
                                    <th>3 </th>
                                    <td><input id="cno3" type="text" size="15" class="form-control"value="@isset($order->orderwarp->cno3){{$order->orderwarp->cno3}}@endisset" name="cno3"></td>
                                    <td> <input id="cne3" type="text" size="15" class="form-control"value="@isset($order->orderwarp->cne3){{$order->orderwarp->cne3}}@endisset" name="cne3"></td>
                                    <td><input id="crenk3" type="text" size="15" class="form-control"value="@isset($order->orderwarp->crenk3){{$order->orderwarp->crenk3}}@endisset" name="crenk3"></td>   
                                    <td><input id="cgr3" type="text" size="15" class="form-control"value="@isset($order->orderwarp->cgr3){{$order->orderwarp->cgr3}}@endisset" name="cgr3"></td>   
                                    <td><input id="cbg3" type="text" size="15" class="form-control"value="@isset($order->orderwarp->cbg3){{$order->orderwarp->cbg3}}@endisset" name="cbg3"></td>   
                                     <th>3 </th>
                                    <td><input id="ano3" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano3){{$order->orderweft->ano3}}@endisset" name="ano3"></td>
                                    <td> <input id="ane3" type="text" size="15" class="form-control" value="@isset($order->orderweft->ane3){{$order->orderweft->ane3}}@endisset" name="ane3"></td>
                                    <td><input id="arenk3" type="text" size="15" class="form-control" value="@isset($order->orderweft->arenk3){{$order->orderweft->arenk3}}@endisset" name="arenk3"></td>     
                                    <td><input id="agr3" type="text" size="15" class="form-control" value="@isset($order->orderweft->agr3){{$order->orderweft->agr3}}@endisset" name="agr3"></td>     
                                    <td><input id="abg3" type="text" size="15" class="form-control" value="@isset($order->orderweft->abg3){{$order->orderweft->abg3}}@endisset" name="abg3"></td>     
                                    <td><input id="asik3" type="text" size="15" class="form-control" value="@isset($order->orderweft->asik3){{$order->orderweft->asik3}}@endisset" name="asik3"></td>     
                            </tr>
                             <tr>
                                    <th>4 </th>
                                    <td><input id="cno4" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cno4){{$order->orderwarp->cno4}}@endisset" name="cno4"></td>
                                    <td> <input id="cne4" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne4){{$order->orderwarp->cne4}}@endisset" name="cne4"></td>
                                    <td><input id="crenk4" type="text" size="15" class="form-control" value="@isset($order->orderwarp->crenk4){{$order->orderwarp->crenk4}}@endisset" name="crenk4"></td>  
                                    <td><input id="cgr4" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cgr4){{$order->orderwarp->cgr4}}@endisset" name="cgr4"></td>  
                                    <td><input id="cbg4" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cbg4){{$order->orderwarp->cbg4}}@endisset" name="cbg4"></td>  
                                     <th>4 </th>
                                    <td><input id="ano4" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano4){{$order->orderweft->ano4}}@endisset" name="ano4"></td>
                                    <td> <input id="ane4" type="text" size="15" class="form-control" value="@isset($order->orderweft->ane4){{$order->orderweft->ane4}}@endisset" name="ane4"></td>
                                    <td><input id="arenk4" type="text" size="15" class="form-control"value="@isset($order->orderweft->arenk4){{$order->orderweft->arenk4}}@endisset" name="arenk4"></td>      
                                    <td><input id="agr4" type="text" size="15" class="form-control"value="@isset($order->orderweft->agr4){{$order->orderweft->agr4}}@endisset" name="agr4"></td>      
                                    <td><input id="abg4" type="text" size="15" class="form-control"value="@isset($order->orderweft->abg4){{$order->orderweft->abg4}}@endisset" name="abg4"></td>      
                                    <td><input id="asik4" type="text" size="15" class="form-control"value="@isset($order->orderweft->asik4){{$order->orderweft->asik4}}@endisset" name="asik4"></td>      
                            </tr>
                            <tr>
                                    <th>5 </th>
                                    <td><input id="cno5" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cno5){{$order->orderwarp->cno5}}@endisset" name="cno5"></td>
                                    <td> <input id="cne5" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne5){{$order->orderwarp->cne5}}@endisset" name="cne5"></td>
                                    <td><input id="crenk5" type="text" size="15" class="form-control" value="@isset($order->orderwarp->crenk5){{$order->orderwarp->crenk5}}@endisset" name="crenk5"></td>   
                                    <td><input id="cgr5" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cgr5){{$order->orderwarp->cgr5}}@endisset" name="cgr5"></td>   
                                    <td><input id="cbg5" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cbg5){{$order->orderwarp->cbg5}}@endisset" name="cbg5"></td>   
                                     <th>5 </th>
                                    <td><input id="ano5" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano5){{$order->orderweft->ano5}}@endisset" name="ano5"></td>
                                    <td> <input id="ane5" type="text" size="15" class="form-control" value="@isset($order->orderweft->ane5){{$order->orderweft->ane5}}@endisset" name="ane5"></td>
                                    <td><input id="arenk5" type="text" size="15" class="form-control" value="@isset($order->orderweft->arenk5){{$order->orderweft->arenk5}}@endisset" name="arenk5"></td>     
                                    <td><input id="agr5" type="text" size="15" class="form-control" value="@isset($order->orderweft->agr5){{$order->orderweft->agr5}}@endisset" name="agr5"></td>     
                                    <td><input id="abg5" type="text" size="15" class="form-control" value="@isset($order->orderweft->abg5){{$order->orderweft->abg5}}@endisset" name="abg5"></td>     
                                    <td><input id="asik5" type="text" size="15" class="form-control" value="@isset($order->orderweft->asik5){{$order->orderweft->asik5}}@endisset" name="asik5"></td>     
                            </tr>
                            <tr>
                                    <th>6 </th>
                                    <td><input id="cno6" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cno6){{$order->orderwarp->cno6}}@endisset" name="cno6"></td>
                                    <td> <input id="cne6" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne6){{$order->orderwarp->cne6}}@endisset" name="cne6"></td>
                                    <td><input id="crenk6" type="text" size="15" class="form-control"value="@isset($order->orderwarp->crenk6){{$order->orderwarp->crenk6}}@endisset" name="crenk6"></td>     
                                    <td><input id="cgr6" type="text" size="15" class="form-control"value="@isset($order->orderwarp->cgr6){{$order->orderwarp->cgr6}}@endisset" name="cgr6"></td>     
                                    <td><input id="cbg6" type="text" size="15" class="form-control"value="@isset($order->orderwarp->cbg6){{$order->orderwarp->cbg6}}@endisset" name="cbg6"></td>     
                                     <th>6 </th>
                                    <td><input id="ano6" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano6){{$order->orderweft->ano6}}@endisset" name="ano6"></td>
                                    <td> <input id="ane6" type="text" size="15" class="form-control" value="@isset($order->orderweft->ane6){{$order->orderweft->ane6}}@endisset" name="ane6"></td>
                                    <td><input id="arenk6" type="text" size="15" class="form-control" value="@isset($order->orderweft->arenk6){{$order->orderweft->arenk6}}@endisset" name="arenk6"></td>   
                                    <td><input id="agr6" type="text" size="15" class="form-control" value="@isset($order->orderweft->agr6){{$order->orderweft->agr6}}@endisset" name="agr6"></td>   
                                    <td><input id="abg6" type="text" size="15" class="form-control" value="@isset($order->orderweft->abg6){{$order->orderweft->abg6}}@endisset" name="abg6"></td>   
                                    <td><input id="asik6" type="text" size="15" class="form-control" value="@isset($order->orderweft->asik6){{$order->orderweft->asik6}}@endisset" name="asik6"></td>   
                            </tr>
                            <tr>
                                    <th>7 </th>
                                    <td><input id="cno7" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cno7){{$order->orderwarp->cno7}}@endisset" name="cno7"></td>
                                    <td> <input id="cne7" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne7){{$order->orderwarp->cne7}}@endisset" name="cne7"></td>
                                    <td><input id="crenk7" type="text" size="15" class="form-control" value="@isset($order->orderwarp->crenk7){{$order->orderwarp->crenk7}}@endisset" name="crenk7"></td>         
                                    <td><input id="cgr7" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cgr7){{$order->orderwarp->cgr7}}@endisset" name="cgr7"></td>         
                                    <td><input id="cbg7" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cbg7){{$order->orderwarp->cbg7}}@endisset" name="cbg7"></td>         
                                     <th>7 </th>
                                    <td><input id="ano7" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano7){{$order->orderweft->ano7}}@endisset" name="ano7"></td>
                                    <td> <input id="ane7" type="text" size="15" class="form-control" value="@isset($order->orderweft->ane7){{$order->orderweft->ane7}}@endisset" name="ane7"></td>
                                    <td><input id="arenk7" type="text" size="15" class="form-control" value="@isset($order->orderweft->arenk7){{$order->orderweft->arenk7}}@endisset" name="arenk7"></td> 
                                    <td><input id="agr7" type="text" size="15" class="form-control" value="@isset($order->orderweft->agr7){{$order->orderweft->agr7}}@endisset" name="agr7"></td> 
                                    <td><input id="abg7" type="text" size="15" class="form-control" value="@isset($order->orderweft->abg7){{$order->orderweft->abg7}}@endisset" name="abg7"></td> 
                                    <td><input id="asik7" type="text" size="15" class="form-control" value="@isset($order->orderweft->asik7){{$order->orderweft->asik7}}@endisset" name="asik7"></td> 
                            </tr>
                            <tr>
                                    <th>8 </th>
                                    <td><input id="cno8" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cno8){{$order->orderwarp->cno8}}@endisset" name="cno8"></td>
                                    <td> <input id="cne8" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne8){{$order->orderwarp->cne8}}@endisset" name="cne8"></td>
                                    <td><input id="crenk8" type="text" size="15" class="form-control" value="@isset($order->orderwarp->crenk8){{$order->orderwarp->crenk8}}@endisset" name="crenk8"></td> 
                                    <td><input id="cgr8" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cgr8){{$order->orderwarp->cgr8}}@endisset" name="cgr8"></td> 
                                    <td><input id="cbg8" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cbg8){{$order->orderwarp->cbg8}}@endisset" name="cbg8"></td> 
                                     <th>8 </th>
                                    <td><input id="ano8" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano8){{$order->orderweft->ano8}}@endisset" name="ano8"></td>
                                    <td> <input id="ane8" type="text" size="15" class="form-control" value="@isset($order->orderweft->ane8){{$order->orderweft->ane8}}@endisset" name="ane8"></td>
                                    <td><input id="arenk8" type="text" size="15" class="form-control" value="@isset($order->orderweft->arenk8){{$order->orderweft->arenk8}}@endisset" name="arenk8"></td>    
                                    <td><input id="agr8" type="text" size="15" class="form-control" value="@isset($order->orderweft->agr8){{$order->orderweft->agr8}}@endisset" name="agr8"></td>    
                                    <td><input id="abg8" type="text" size="15" class="form-control" value="@isset($order->orderweft->abg8){{$order->orderweft->abg8}}@endisset" name="abg8"></td>    
                                    <td><input id="asik8" type="text" size="15" class="form-control" value="@isset($order->orderweft->asik8){{$order->orderweft->asik8}}@endisset" name="asik8"></td>    
                            </tr>
                            <tr>
                                    <th>9 </th>
                                    <td><input id="cno9" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cno9){{$order->orderwarp->cno9}}@endisset" name="cno9"></td>
                                    <td> <input id="cne9" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne9){{$order->orderwarp->cne9}}@endisset" name="cne9"></td>
                                    <td><input id="crenk9" type="text" size="15" class="form-control" value="@isset($order->orderwarp->crenk9){{$order->orderwarp->crenk9}}@endisset" name="crenk9"></td>     
                                    <td><input id="cgr9" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cgr9){{$order->orderwarp->cgr9}}@endisset" name="cgr9"></td>     
                                    <td><input id="cbg9" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cbg9){{$order->orderwarp->cbg9}}@endisset" name="cbg9"></td>     
                                     <th>9 </th>
                                    <td><input id="ano9" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano9){{$order->orderweft->ano9}}@endisset" name="ano9"></td>
                                    <td> <input id="ane9" type="text" size="15" class="form-control" value="@isset($order->orderweft->ane9){{$order->orderweft->ane9}}@endisset" name="ane9"></td>
                                    <td><input id="arenk9" type="text" size="15" class="form-control" value="@isset($order->orderweft->arenk9){{$order->orderweft->arenk9}}@endisset" name="arenk9"></td>   
                                    <td><input id="agr9" type="text" size="15" class="form-control" value="@isset($order->orderweft->agr9){{$order->orderweft->agr9}}@endisset" name="agr9"></td>   
                                    <td><input id="abg9" type="text" size="15" class="form-control" value="@isset($order->orderweft->abg9){{$order->orderweft->abg9}}@endisset" name="abg9"></td>   
                                    <td><input id="asik9" type="text" size="15" class="form-control" value="@isset($order->orderweft->asik9){{$order->orderweft->asik9}}@endisset" name="asik9"></td>   
                            </tr>
                            <tr>
                                    <th>10</th>
                                    <td><input id="cno10" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cno10){{$order->orderwarp->cno10}}@endisset" name="cno10"></td>
                                    <td> <input id="cne10" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne10){{$order->orderwarp->cne10}}@endisset" name="cne10"></td>
                                    <td><input id="crenk10" type="text" size="15" class="form-control" value="@isset($order->orderwarp->crenk10){{$order->orderwarp->crenk10}}@endisset" name="crenk10"></td>       
                                    <td><input id="cgr10" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cgr10){{$order->orderwarp->cgr10}}@endisset" name="cgr10"></td>       
                                    <td><input id="cbg10" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cbg10){{$order->orderwarp->cbg10}}@endisset" name="cbg10"></td>       
                                     <th>10</th>
                                    <td><input id="ano10" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano10){{$order->orderweft->ano10}}@endisset" name="ano10"></td>
                                    <td><input id="ane10" type="text" size="15" class="form-control" value="@isset($order->orderweft->ane10){{$order->orderweft->ane10}}@endisset" name="ane10"></td>
                                    <td><input id="arenk10" type="text" size="15" class="form-control" value="@isset($order->orderweft->arenk10){{$order->orderweft->arenk10}}@endisset" name="arenk10"></td> 
                                    <td><input id="agr10" type="text" size="15" class="form-control" value="@isset($order->orderweft->agr10){{$order->orderweft->agr10}}@endisset" name="agr10"></td> 
                                    <td><input id="abg10" type="text" size="15" class="form-control" value="@isset($order->orderweft->abg10){{$order->orderweft->abg10}}@endisset" name="abg10"></td> 
                                    <td><input id="asik10" type="text" size="15" class="form-control" value="@isset($order->orderweft->asik10){{$order->orderweft->asik10}}@endisset" name="asik10"></td> 
                            </tr>
                            <tr>
                                    <th>11</th>
                                    <td><input id="cno11" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cno11){{$order->orderwarp->cno11}}@endisset" name="cno11"></td>
                                    <td><input id="cne11" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne11){{$order->orderwarp->cne11}}@endisset" name="cne11"></td>
                                    <td><input id="crenk11" type="text" size="15" class="form-control" value="@isset($order->orderwarp->crenk11){{$order->orderwarp->crenk11}}@endisset" name="crenk11"></td>       
                                    <td><input id="cgr11" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cgr11){{$order->orderwarp->cgr11}}@endisset" name="cgr11"></td>       
                                    <td><input id="cbg11" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cbg11){{$order->orderwarp->cbg11}}@endisset" name="cbg11"></td>       
                                     <th>11</th>
                                    <td><input id="ano11" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano11){{$order->orderweft->ano11}}@endisset" name="ano11"></td>
                                    <td><input id="ane11" type="text" size="15" class="form-control" value="@isset($order->orderweft->ane11){{$order->orderweft->ane11}}@endisset" name="ane11"></td>
                                    <td><input id="arenk11" type="text" size="15" class="form-control" value="@isset($order->orderweft->arenk11){{$order->orderweft->arenk11}}@endisset" name="arenk11"></td> 
                                    <td><input id="agr11" type="text" size="15" class="form-control" value="@isset($order->orderweft->agr11){{$order->orderweft->agr11}}@endisset" name="agr11"></td> 
                                    <td><input id="abg11" type="text" size="15" class="form-control" value="@isset($order->orderweft->abg11){{$order->orderweft->abg11}}@endisset" name="abg11"></td> 
                                    <td><input id="asik11" type="text" size="15" class="form-control" value="@isset($order->orderweft->asik11){{$order->orderweft->asik11}}@endisset" name="asik11"></td> 
                            </tr>
                            <tr>
                                    <th>12</th>
                                    <td><input id="cno12" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cno12){{$order->orderwarp->cno12}}@endisset" name="cno12"></td>
                                    <td><input id="cne12" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cne12){{$order->orderwarp->cne12}}@endisset" name="cne12"></td>
                                    <td><input id="crenk12" type="text" size="15" class="form-control" value="@isset($order->orderwarp->crenk12){{$order->orderwarp->crenk12}}@endisset" name="crenk12"></td>   
                                    <td><input id="cgr12" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cgr12){{$order->orderwarp->cgr12}}@endisset" name="cgr12"></td>   
                                    <td><input id="cbg12" type="text" size="15" class="form-control" value="@isset($order->orderwarp->cbg12){{$order->orderwarp->cbg12}}@endisset" name="cbg12"></td>   
                                    <th>12</th>
                                    <td><input id="ano12" type="text" size="15" class="form-control" value="@isset($order->orderweft->ano12){{$order->orderweft->ano12}}@endisset" name="ano12"></td>
                                    <td><input id="ane12" type="text" size="15" class="form-control" value="@isset($order->orderweft->ane12){{$order->orderweft->ane12}}@endisset" name="ane12"></td>
                                    <td><input id="arenk12" type="text" size="15" class="form-control" value="@isset($order->orderweft->arenk12){{$order->orderweft->arenk12}}@endisset" name="arenk12"></td>     
                                    <td><input id="agr12" type="text" size="15" class="form-control" value="@isset($order->orderweft->agr12){{$order->orderweft->agr12}}@endisset" name="agr12"></td>     
                                    <td><input id="abg12" type="text" size="15" class="form-control" value="@isset($order->orderweft->abg12){{$order->orderweft->abg12}}@endisset" name="abg12"></td>     
                                    <td><input id="asik12" type="text" size="15" class="form-control" value="@isset($order->orderweft->asik12){{$order->orderweft->asik12}}@endisset" name="asik12"></td>     
                            </tr>
                        </table>    
                        @endif 
                        </div>     
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input class="btn btn-success" type="submit" name="action" value="Güncelle" />
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                              @can('delete')  <input class="btn btn-dark" type="submit" name="action" value="Farklı Kaydet" />@endcan
                             <!--   <button type="submit" class="btn btn-success">
                                    {{ __('Güncelle') }}
                                </button>
                            -->
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

@section('css') 
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">

$( function() {
    $('#desen_id').select2({ width: '200px' });
});
</script>
@endsection

