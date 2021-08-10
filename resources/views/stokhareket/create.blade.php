@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Stok Hareket') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('stokhareket.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="hareketturu_id"  class="col-md-4 col-form-label text-md-right">{{ __('Hareket Türü') }}</label>

                            <div class="col-md-6">
                                <select name='hareketturu_id' id="hareketturu_id" class="form-control @error('hareketturu_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
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
                                <select name='firmatipi_id' id="firmatipi_id" class="form-control  @error('firmatipi_id') is-invalid @enderror"  required>
                                    <option value="">Seçiniz..</option>
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
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row" >
                            <label for="iplikdepo_id" class="col-md-4 col-form-label text-md-right">{{ __('İplik Depo') }}</label>

                            <div class="col-md-6">
                                <select name='iplikdepo_id' class="form-control  @error('iplikdepo_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($iplikdepo as $list)
                                    <option value="{{$list->id}}" id="iplikdepo_id">P.No={{$list->partino}}--- NE={{$list->iplikno}}/{{$list->ne}}--- Miktar={{$list->miktar}}{{$list->unit->name}}</option>
                                    @endforeach
                                </select>
                                @error('iplikdepo_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row" name="bukum">
                            <label for="bukumdepo_id" class="col-md-4 col-form-label text-md-right">{{ __('Büküm Depo') }}</label>

                            <div class="col-md-6">
                                <select name='bukumdepo_id' class="form-control  @error('bukumdepo_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($bukumdepo as $list)
                                    <option value="{{$list->id}}" id="bukumdepo_id">P.No={{$list->partino}}--- NE={{$list->iplikno}}/{{$list->ne}}--- Miktar={{$list->miktar}}{{$list->unit->name}}</option>
                                    @endforeach
                                </select>
                                @error('bukumdepo_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş') }}</label>

                            <div class="col-md-6">
                                <select name='order_id' class="form-control  @error('order_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
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
                            <label for="partino" class="col-md-4 col-form-label text-md-right">{{ __('Parti NO') }}</label>

                            <div class="col-md-6">
                                <input id="partino" type="text" class="form-control @error('partino') is-invalid @enderror" name="partino" value="{{ old('partino') }}"  autocomplete="partino" autofocus>

                                @error('partino')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="bukum">    
                            <label for="bukumturu" class="col-md-4 col-form-label text-md-right">{{ __('Büküm Turu') }}</label>

                            <div class="col-md-6">
                                <input id="bukumturu" type="text" class="form-control @error('bukumturu') is-invalid @enderror" name="bukumturu" value="{{ old('bukumturu') }}"  autocomplete="bukumturu" autofocus>

                                @error('bukumturu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="bukum">    
                            <label for="bukumsekli" class="col-md-4 col-form-label text-md-right">{{ __('Büküm Şekli') }}</label>

                            <div class="col-md-6">
                                <input id="bukumsekli" type="text" class="form-control @error('bukumsekli') is-invalid @enderror" name="bukumsekli" value="{{ old('bukumsekli') }}"  autocomplete="bukumsekli" autofocus>

                                @error('bukumsekli')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iplikcins_id" class="col-md-4 col-form-label text-md-right">{{ __('İplik Cins') }}</label>

                            <div class="col-md-6">
                                <select name='iplikcins_id' class="form-control  @error('iplikcins_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($iplikcins as $list)
                                    <option value="{{$list->id}}" id="iplikcins_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('iplikcins_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="boyacins_id" class="col-md-4 col-form-label text-md-right">{{ __('İplik Boya Cins') }}</label>

                            <div class="col-md-6">
                                <select name='boyacins_id' class="form-control  @error('boyacins_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($boyacins as $list)
                                    <option value="{{$list->id}}" id="boyains_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('boyacins_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="iplikno" class="col-md-4 col-form-label text-md-right">{{ ('İplik NO') }}</label>

                            <div class="col-md-3">
                                <input id="iplikno" type="text" class="form-control @error('iplikno') is-invalid @enderror" name="iplikno"  autocomplete="iplikno" autofocus>

                                @error('iplikno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                              <label for="iplikno">{{ ('NE') }}</label>
                            <div class="col-md-2">
                                <input id="ne" type="text" class="form-control @error('ne') is-invalid @enderror" name="ne"  autocomplete="ne" autofocus>

                                @error('ne')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="renk" class="col-md-4 col-form-label text-md-right">{{ __('Renk') }}</label>

                            <div class="col-md-6">
                                <input id="renk" type="text" class="form-control @error('renk') is-invalid @enderror" name="renk" value="{{ old('renk') }}"  autocomplete="renk" autofocus>

                                @error('renk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="renkno" class="col-md-4 col-form-label text-md-right">{{ __('Renk NO') }}</label>

                            <div class="col-md-6">
                                <input id="renkno" type="text" class="form-control @error('renkno') is-invalid @enderror" name="renkno" value="{{ old('renkno') }}"  autocomplete="renkno" autofocus>

                                @error('renkno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="gtrh">
                            <label for="gtrh" class="col-md-4 col-form-label text-md-right">{{ __('Giriş Tarihi') }}</label>

                            <div class="col-md-6">

                                <input id="gtrh" type="date" class="form-control @error('gtrh') is-invalid @enderror" name="gtrh" value="{{ old('gtrh') }}"  autocomplete="gtrh" autofocus>
                                @error('gtrh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="ctrh">
                            <label for="ctrh" class="col-md-4 col-form-label text-md-right">{{ __('Çıkış Tarihi') }}</label>

                            <div class="col-md-6">

                                <input id="ctrh" type="date" class="form-control @error('ctrh') is-invalid @enderror" name="ctrh" value="{{ old('ctrh') }}" autocomplete="ctrh" autofocus>
                                @error('ctrh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">    
                            <label for="siparismiktar" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş Miktarı') }}</label>

                            <div class="col-md-6">
                                <input id="siparismiktar" type="text" class="form-control @error('siparismiktar') is-invalid @enderror" name="siparismiktar" value="{{ old('siparismiktar') }}"  autocomplete="siparismiktar" autofocus>

                                @error('siparismiktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="miktar" class="col-md-4 col-form-label text-md-right">{{ __('NET Miktar') }}</label>

                            <div class="col-md-6">
                                <input id="miktar" type="text" class="form-control @error('miktar') is-invalid @enderror" name="miktar" value="{{ old('miktar') }}"  autocomplete="miktar" autofocus>

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
                                <input id="brutmiktar" type="text" class="form-control @error('brutmiktar') is-invalid @enderror" name="brutmiktar"  autocomplete="brutmiktar" value="{{old('brutmiktar')}}" autofocus>

                                @error('brutmiktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unit_id" class="col-md-4 col-form-label text-md-right">{{ __('Birim') }}</label>

                            <div class="col-md-6">
                                <select name='unit_id' class="form-control  @error('unit_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($unit as $list)
                                    <option value="{{$list->id}}" id="unit_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="fiyat" class="col-md-4 col-form-label text-md-right">{{ __('Fiyat') }}</label>

                            <div class="col-md-6">
                                <input id="fiyat" type="text" class="form-control @error('fiyat') is-invalid @enderror" name="fiyat" value="{{ old('fiyat') }}"  autocomplete="fiyat" autofocus>

                                @error('fiyat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kur_id" class="col-md-4 col-form-label text-md-right">{{ __('Kur') }}</label>

                            <div class="col-md-6">
                                <select name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror" >
                                    @foreach ($kur as $list)
                                    <option value="{{$list->id}}" id="kur_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('kur_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="irsaliye_no" class="col-md-4 col-form-label text-md-right">{{ __('İrsaliye No') }}</label>

                            <div class="col-md-6">
                                <input id="irsaliye_no" type="text" class="form-control @error('irsaliye_no') is-invalid @enderror" name="irsaliye_no" value="{{ old('irsaliye_no') }}"  autocomplete="irsaliye_no" autofocus>

                                @error('irsaliye_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fatura_no" class="col-md-4 col-form-label text-md-right">{{ __('Fatura No') }}</label>

                            <div class="col-md-6">
                                <input id="fatura_no" type="text" class="form-control @error('fatura_no') is-invalid @enderror" name="fatura_no" value="{{ old('fatura_no') }}"  autocomplete="fatura_no" autofocus>

                                @error('fatura_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iademiktar" class="col-md-4 col-form-label text-md-right">{{ __('İade Miktar') }}</label>

                            <div class="col-md-6">
                                <input id="iademiktar" type="text" class="form-control @error('iademiktar') is-invalid @enderror" name="iademiktar" value="{{ old('iademiktar') }}"  autocomplete="iademiktar" autofocus>

                                @error('iademiktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıkklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama" id="aciklama" autocomplete="aciklama" autofocus>
                               </textarea>
                           </div>
                       </div> 
                       <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                            <button type="submit" class="btn btn-success">
                                {{ __('Ekle') }}
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

@section('css') 

@endsection
@section('js')
<script type="text/javascript">

$('#firmatipi_id').change(function(){
  if($('#firmatipi_id option:selected').text() == 'İPLİK')
        { // or this.value == 'volvo'
        $("div[name*='iplik']").show();
        $("div[name*='bukum']").hide();
        $("div[name*='gtrh']").hide();  $("div[name*='ctrh']").hide();
        }
else if ($('#firmatipi_id option:selected').text() == 'BÜKÜM')
        {
        $("div[name*='iplik']").hide();
        $("div[name*='bukum']").show();
        $("div[name*='gtrh']").hide();  $("div[name*='ctrh']").hide();
        }
});
</script>
@endsection