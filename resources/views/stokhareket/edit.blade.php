@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Stok Hareket Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('stokhareket.update', $stokhareket->id) }}">
                        @method('PATCH')
                        @csrf
                            <div class="form-group row">
                                <label for="hareketturu_id" class="col-md-4 col-form-label text-md-right">{{ __('Hareket Türü') }}</label>
                                <div class="col-md-6">
                                    <select name='hareketturu_id' class="form-control  @error('hareketturu_id') is-invalid @enderror" >
                                            <option value="@isset($stokhareket->hareketturu_id){{$stokhareket->hareketturu_id}}@endisset">@isset($stokhareket->hareketturu->name){{$stokhareket->hareketturu->name}}@endisset</option>
                                        @foreach ($hareketturu as $list)
                                            <option value="{{$list->id}}" id="hareketturu_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('hareketturu_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="firmatipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Stok Tipi') }}</label>

                                <div class="col-md-6">
                                    <select name='firmatipi_id' class="form-control  @error('firmatipi_id') is-invalid @enderror" >
                                            <option value="@isset($stokhareket->firmatipi_id){{$stokhareket->firmatipi_id}}@endisset">@isset($stokhareket->firmatipi->name){{$stokhareket->firmatipi->name}}@endisset</option>
                                        @foreach ($firmatipi as $list)
                                            <option value="{{$list->id}}" id="firmatipi_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('firmatipi_id')
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
                                            <option value="@isset($stokhareket->firma_id){{$stokhareket->firma_id}}@endisset">@isset($stokhareket->firma->name){{$stokhareket->firma->name}}@endisset</option>
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
                                <label for="iplikdepo_id" class="col-md-4 col-form-label text-md-right">{{ __('İplik Depo') }}</label>

                                <div class="col-md-6">
                                    <select name='iplikdepo_id' class="form-control  @error('iplikdepo_id') is-invalid @enderror" >
                                            <option value="{{$stokhareket->iplikdepo_id}}">@isset($stokhareket->iplikdepo->partino){{$stokhareket->iplikdepo->partino}}@endisset</option>
                                        @foreach ($iplikdepo as $list)
                                            <option value="{{$list->id}}" id="iplikdepo_id">{{$list->partino}}---{{$list->iplikno}}/{{$list->ne}}</option>
                                        @endforeach
                                    </select>
                                     @error('iplikdepo_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="bukumdepo_id" class="col-md-4 col-form-label text-md-right">{{ __('Büküm Depo') }}</label>

                                <div class="col-md-6">
                                    <select name='bukumdepo_id' class="form-control  @error('bukumdepo_id') is-invalid @enderror" >
                                            <option value="{{$stokhareket->bukumdepo_id}}">@isset($stokhareket->bukumdepo->partino){{$stokhareket->bukumdepo->partino}}@endisset</option>
                                        @foreach ($bukumdepo as $list)
                                            <option value="{{$list->id}}" id="bukumdepo_id">{{$list->partino}}---{{$list->iplikno}}/{{$list->ne}}</option>
                                        @endforeach
                                    </select>
                                     @error('bukumdepo_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş') }}</label>

                                <div class="col-md-6">
                                    <select name='order_id' class="form-control  @error('order_id') is-invalid @enderror" >
                                            <option value="@isset($stokhareket->order_id){{$stokhareket->order_id}}@endisset">@isset($stokhareket->order->order_no){{$stokhareket->order->order_no}}@endisset</option>
                                        @foreach ($order as $list)
                                            <option value="{{$list->id}}" id="order_id">{{$list->order_no}}</option>
                                        @endforeach
                                    </select>
                                     @error('order_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="partino" class="col-md-4 col-form-label text-md-right">{{ ('Parti NO') }}</label>

                            <div class="col-md-6">
                                <input id="partino" type="text" class="form-control @error('partino') is-invalid @enderror" name="partino"  autocomplete="partino" value="{{$stokhareket->partino}}" autofocus>

                                @error('partino')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bukumturu" class="col-md-4 col-form-label text-md-right">{{ ('Büküm Turu') }}</label>

                            <div class="col-md-6">
                                <input id="bukumturu" type="text" class="form-control @error('bukumturu') is-invalid @enderror" name="bukumturu"  autocomplete="bukumturu" value="{{$stokhareket->bukumturu}}" autofocus>

                                @error('bukumturu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bukumsekli" class="col-md-4 col-form-label text-md-right">{{ ('Büküm Şekli') }}</label>

                            <div class="col-md-6">
                                <input id="bukumsekli" type="text" class="form-control @error('bukumsekli') is-invalid @enderror" name="bukumsekli"  autocomplete="bukumsekli" value="{{$stokhareket->bukumsekli}}" autofocus>

                                @error('bukumsekli')
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
                                            <option value="@isset($stokhareket->iplikcins_id){{$stokhareket->iplikcins_id}}@endisset">@isset($stokhareket->iplikcins->name){{$stokhareket->iplikcins->name}}@endisset</option>
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
                                <label for="boyacins_id" class="col-md-4 col-form-label text-md-right">{{ __('Boya Cinsi') }}</label>

                                <div class="col-md-6">
                                    <select name='boyacins_id' class="form-control  @error('boyacins_id') is-invalid @enderror" >   
                                            <option value="@isset($stokhareket->boyacins_id){{$stokhareket->boyacins_id}}@endisset">@isset($stokhareket->boyacins->name){{$stokhareket->boyacins->name}}@endisset</option>
                                        @foreach ($boyacins as $list)
                                            <option value="{{$list->id}}" id="boyacins_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('boyacins_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                            <label for="iplikno" class="col-md-4 col-form-label text-md-right">{{ ('İplik NO-NE') }}</label>

                            <div class="col-md-4">
                                <input id="iplikno" type="text" class="form-control @error('iplikno') is-invalid @enderror" name="iplikno"  autocomplete="iplikno" value="{{$stokhareket->iplikno}}" autofocus>

                                @error('iplikno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input id="ne" type="text" class="form-control @error('ne') is-invalid @enderror" name="ne"  autocomplete="ne" value="{{$stokhareket->ne}}" autofocus>

                                @error('ne')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="renk" class="col-md-4 col-form-label text-md-right">{{ ('Renk') }}</label>

                            <div class="col-md-6">
                                <input id="renk" type="text" class="form-control @error('renk') is-invalid @enderror" name="renk"  autocomplete="renk" value="{{$stokhareket->renk}}" autofocus>

                                @error('renk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="renkno" class="col-md-4 col-form-label text-md-right">{{ ('Renkno') }}</label>

                            <div class="col-md-6">
                                <input id="renkno" type="text" class="form-control @error('renkno') is-invalid @enderror" name="renkno"  autocomplete="renkno" value="{{$stokhareket->renkno}}" autofocus>

                                @error('renkno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                             <div class="form-group row">
                                <label for="gtrh" class="col-md-4 col-form-label text-md-right">{{ __('Giriş Tarihi') }}</label>

                                <div class="col-md-6">

                                    <input id="gtrh" type="date" class="form-control @error('gtrh') is-invalid @enderror" name="gtrh"  value="@if ($stokhareket->gtrh){{ date('Y-m-d',strtotime($stokhareket->gtrh))}}@endif" autocomplete="gtrh" autofocus>
                                    @error('gtrh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="ctrh" class="col-md-4 col-form-label text-md-right">{{ __('Çıkış Tarihi') }}</label>

                                <div class="col-md-6">

                                    <input id="ctrh" type="date" class="form-control @error('ctrh') is-invalid @enderror" name="ctrh" value="@if ($stokhareket->ctrh){{ date('Y-m-d',strtotime($stokhareket->ctrh))}}@endif" autocomplete="ctrh" autofocus>
                                    @error('ctrh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                            <label for="siparismiktar" class="col-md-4 col-form-label text-md-right">{{ ('Siparis Miktar') }}</label>

                            <div class="col-md-6">
                                <input id="siparismiktar" type="text" class="form-control @error('siparismiktar') is-invalid @enderror" name="siparismiktar"  autocomplete="siparismiktar" value="{{$stokhareket->siparismiktar}}" autofocus>

                                @error('siparismiktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                             </div>
                            <div class="form-group row">
                            <label for="miktar" class="col-md-4 col-form-label text-md-right">{{ ('NET Miktar') }}</label>

                            <div class="col-md-6">
                                <input id="miktar" type="text" class="form-control @error('miktar') is-invalid @enderror" name="miktar"  autocomplete="miktar" value="{{$stokhareket->miktar}}" autofocus>

                                @error('miktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="brutmiktar" class="col-md-4 col-form-label text-md-right">{{ ('Brüt Miktar') }}</label>

                            <div class="col-md-6">
                                <input id="brutmiktar" type="text" class="form-control @error('brutmiktar') is-invalid @enderror" name="brutmiktar"  autocomplete="brutmiktar" value="{{$stokhareket->brutmiktar}}" autofocus>

                                @error('brutmiktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="unit_id" class="col-md-4 col-form-label text-md-right">{{ ('Birim') }}</label>
                                <div class="col-md-6">
                                 <select name='unit_id' class="form-control  @error('munit_id') is-invalid @enderror" >
                                            <option value="@isset($stokhareket->unit_id){{$stokhareket->unit_id}}@endisset">@isset($stokhareket->unit->name){{$stokhareket->unit->name}}@endisset</option>
                                        @foreach ($unit as $list)
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
                            <div class="form-group row">
                            <label for="fiyat" class="col-md-4 col-form-label text-md-right">{{ ('Fiyat') }}</label>

                            <div class="col-md-6">
                                <input id="fiyat" type="text" class="form-control @error('fiyat') is-invalid @enderror" name="fiyat"  autocomplete="fiyat" value="{{$stokhareket->fiyat}}" autofocus>

                                @error('fiyat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                                <label for="kur_id" class="col-md-4 col-form-label text-md-right">{{ __('Kalite Detay') }}</label>

                                <div class="col-md-6">
                                    <select name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror" >   
                                            <option value="@isset($stokhareket->kur_id){{$stokhareket->kur_id}}@endisset">@isset($stokhareket->kur->name){{$stokhareket->kur->name}}@endisset</option>
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
                        <div class="form-group row">
                            <label for="irsaliye_no" class="col-md-4 col-form-label text-md-right">{{ ('İrsaliye No') }}</label>

                            <div class="col-md-6">
                                <input id="irsaliye_no" type="text" class="form-control @error('irsaliye_no') is-invalid @enderror" name="irsaliye_no"  autocomplete="irsaliye_no" value="{{$stokhareket->irsaliye_no}}" autofocus>

                                @error('irsaliye_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fatura_no" class="col-md-4 col-form-label text-md-right">{{ ('Fatura No') }}</label>

                            <div class="col-md-6">
                                <input id="fatura_no" type="text" class="form-control @error('fatura_no') is-invalid @enderror" name="fatura_no"  autocomplete="fatura_no" value="{{$stokhareket->fatura_no}}" autofocus>

                                @error('fatura_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iademiktar" class="col-md-4 col-form-label text-md-right">{{ ('İade Miktar') }}</label>

                            <div class="col-md-6">
                                <input id="iademiktar" type="text" class="form-control @error('iademiktar') is-invalid @enderror" name="iademiktar"  autocomplete="iademiktar" value="{{$stokhareket->iademiktar}}" autofocus>

                                @error('iademiktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>{{$stokhareket->aciklama}}
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
