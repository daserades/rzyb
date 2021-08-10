@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('İplik İrsaliye Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @elseif($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('iplikirsaliye.update', $iplikirsaliye->id) }}">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" id="hareketturu_id" value="{{$iplikirsaliye->hareketturu_id}}">                            
                        <div class="form-group row">
                            <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                            <div class="col-md-6">
                                <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" >
                                    <option value="@isset($iplikirsaliye->firma_id){{$iplikirsaliye->firma_id}}@endisset">@isset($iplikirsaliye->firma->name){{$iplikirsaliye->firma->name}}@endisset</option>
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
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş') }}</label>

                            <div class="col-md-6">
                                <select name='order_id' class="form-control  @error('order_id') is-invalid @enderror" >
                                    <option value="@isset($iplikirsaliye->order_id){{$iplikirsaliye->order_id}}@endisset">@isset($iplikirsaliye->order->order_no){{$iplikirsaliye->order->order_no}}@endisset</option>
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
                        <div class="form-group row" id="iplikdepo">
                            <label for="firmatipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Sevk Tipi') }}</label>

                            <div class="col-md-6">
                                <select name='firmatipi_id' class="form-control  @error('firmatipi_id') is-invalid @enderror" >
                                    <option value="@isset($iplikirsaliye->firmatipi_id){{$iplikirsaliye->firmatipi_id}}@endisset">@isset($iplikirsaliye->firmatipi->name){{$iplikirsaliye->firmatipi->name}}@endisset</option>
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
                        <div class="form-group row" name="gtrh">
                            <label for="gtrh" class="col-md-4 col-form-label text-md-right">{{ __('Giriş Tarihi') }}</label>

                            <div class="col-md-6">

                                <input id="gtrh" type="date" class="form-control @error('gtrh') is-invalid @enderror" name="gtrh" value="@if ($iplikirsaliye->gtrh){{ date('Y-m-d',strtotime($iplikirsaliye->gtrh))}}@endif"  autocomplete="gtrh" autofocus>
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

                                <input id="ctrh" type="date" class="form-control @error('ctrh') is-invalid @enderror" name="ctrh" value="@if ($iplikirsaliye->ctrh){{ date('Y-m-d',strtotime($iplikirsaliye->ctrh))}}@endif" autocomplete="ctrh" autofocus>
                                @error('ctrh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="cikis">
                            <label for="barcode_adet" class="col-md-4 col-form-label text-md-right">{{ ('Barkod Adeti') }}</label>

                            <div class="col-md-6">
                                <input id="barcode_adet" type="text" class="form-control @error('barcode_adet') is-invalid @enderror" name="barcode_adet"  autocomplete="barcode_adet" value="{{$iplikirsaliye->barcode_adet}}" autofocus>

                                @error('barcode_adet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="cikis">
                            <label for="fiyat" class="col-md-4 col-form-label text-md-right">{{ ('Fiyat') }}</label>

                            <div class="col-md-6">
                                <input id="fiyat" type="text" class="form-control @error('fiyat') is-invalid @enderror" name="fiyat"  autocomplete="fiyat" value="{{$iplikirsaliye->fiyat}}" autofocus>

                                @error('fiyat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" name="cikis">
                            <label for="kur_id" class="col-md-4 col-form-label text-md-right">{{ __('Kur') }}</label>

                            <div class="col-md-6">
                                <select name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror" >
                                    <option value="{{$iplikirsaliye->kur_id}}">{{$iplikirsaliye->kur->name ?? ''}}</option>
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
                            <label for="irsaliye_no" class="col-md-4 col-form-label text-md-right">{{ ('İrsaliye No') }}</label>

                            <div class="col-md-6">
                                <input id="irsaliye_no" type="text" class="form-control @error('irsaliye_no') is-invalid @enderror" name="irsaliye_no"  autocomplete="irsaliye_no" value="{{$iplikirsaliye->irsaliye_no}}" autofocus>

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
                                <input id="fatura_no" type="text" class="form-control @error('fatura_no') is-invalid @enderror" name="fatura_no"  autocomplete="fatura_no" value="{{$iplikirsaliye->fatura_no}}" autofocus>

                                @error('fatura_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>{{$iplikirsaliye->aciklama}}
                               </textarea>
                           </div>
                       </div> 
                       <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
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
@section('js')
<script type="text/javascript">
    $( function() { 
     
       var hareketturu_id= $('#hareketturu_id').val();
       if (hareketturu_id == 1)
       {
           $("div[name*='ctrh']").hide();
       }
       else if(hareketturu_id == 2)
       {
           $("div[name*='cikis']").hide()
           $("div[name*='gtrh']").hide();   
       }
       else alert('Hatalı!! Yetkili ile iletişime geçiniz...');
   });
</script>
@endsection