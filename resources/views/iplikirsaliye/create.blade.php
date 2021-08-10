@extends('layouts.app')

@section('content')
  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">            <div class="card">
                <div class="card-header">{{ __('İplik İrsaliye') }}</div>
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
              <div id="step-11">
                <div class="card-body">
                    <form method="POST" action="{{ route('iplikirsaliye.store') }}" id="form">
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
                        <div class="form-group row" name="giris">
                            <label for="firmatipi_id"  class="col-md-4 col-form-label text-md-right">{{ __('Sevk Tipi') }}</label>

                            <div class="col-md-6">
                                <select name='firmatipi_id' id="firmatipi_id" class="form-control @error('firmatipi_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($firmatipi as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('firmatipi_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                         
                         <div class="form-group row" name="iplikbukum">
                            <label for="iplikbukum_id" class="col-md-4 col-form-label text-md-right">{{ __('Büküm Talimatı') }}</label>

                            <div class="col-md-6">
                                <select name='iplikbukum_id' id="iplikbukum_id" class="form-control  @error('iplikbukum_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($iplikbukum as $list)
                                    <option value="{{$list->id}}" class="{{$list->firma_id.'-'.$list->firma->name}}" name="{{$list->order_id.'-'}}{{$list->order->order_no ?? ''}} ">S.N.{{$list->order->order_no ?? ''}} {{$list->no.' '.$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('iplikbukum_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row" name="iplikboya">
                            <label for="iplikboya_id" class="col-md-4 col-form-label text-md-right">{{ __('İplik Boya Talimatı') }}</label>

                            <div class="col-md-6">
                                <select name='iplikboya_id' id="iplikboya_id" class="form-control  @error('iplikboya_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($iplikboya as $list)
                                    <option value="{{$list->id}}" class="{{$list->firma_id.'-'.$list->firma->name}}" name="{{$list->order_id}}-{{$list->order->order_no ?? ''}} ">{{$list->order->order_no ?? ''}}-{{$list->no ?? ''}}-{{$list->firma->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('iplikboya_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                         <div class="form-group row" name="cozgu">
                            <label for="cozgu_id" class="col-md-4 col-form-label text-md-right">{{ __('Çözgü Talimatı') }}</label>

                            <div class="col-md-6">
                                <select name="cozgu_id" id="cozgu_id" class="form-control  @error('cozgu_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($cozgu as $list)
                                    <option value="{{$list->id}}" class="{{$list->firma_id.'-'.$list->firma->name}}" name="{{$list->order_id}}-{{$list->order->order_no ?? ''}} ">{{$list->order->order_no ?? ''}}-{{$list->no ?? ''}}-{{$list->firma->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('cozgu_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="giris">
                            <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                            <div class="col-md-6">
                                <select name='firma_id' id="firma_id" class="form-control  @error('firma_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($firma as $list)
                                    <option value="{{$list->id}}" >{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('firma_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <input type="hidden" name="order_id">
                    
                        <div class="form-group row" name="order_id">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş') }}</label>

                            <div class="col-md-6">
                                <select name='order_id' id="order_id" class="form-control  @error('order_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($order as $list)
                                    <option value="{{$list->id}}">{{$list->order_no}}</option>
                                    @endforeach
                                </select>
                                @error('order_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
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
                       
                        <div class="form-group row" name="gtrh">
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
                        <div class="form-group row" name="gtrh">
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
                        <div class="form-group row" name="gtrh">
                            <label for="barcode_adet" class="col-md-4 col-form-label text-md-right">{{ __('Barkod Adet') }}</label>

                            <div class="col-md-6">
                                <input id="barcode_adet" type="text" class="form-control @error('barcode_adet') is-invalid @enderror" name="barcode_adet" value="{{ old('barcode_adet') }}"  autocomplete="barcode_adet" autofocus>

                                @error('barcode_adet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="giris">
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
                        <div class="form-group row" name="giris">
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
                        <div class="form-group row" name="giris">
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
</div>
</div>
@endsection

@section('css') 
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
    $( function() 
    { 
        $("div[name*='giris'],div[name='order_id'],div[name*='gtrh'],div[name*='ctrh'],div[name='iplikbukum'],div[name='iplikboya'],div[name='cozgu']").hide();

       $('#hareketturu_id').change(function(){
              
            if($('#hareketturu_id option:selected').text() == 'GİRİŞ')
            { 
                $("div[name*='gtrh'],div[name*='giris'],div[name='order_id']").show();
                $("div[name*='ctrh']").hide();

                $('#firmatipi_id').change(function(){
                     if (($('#firmatipi_id option:selected').text()) =='BÜKÜM')
                        {
                        $("div[name='iplikbukum']").show();
                        $("div[name='cozgu'],div[name='iplikboya_id']").hide();
                        $("#iplikbukum_id").prop('required', true);
                        $("#cozgu_id, #iplikboya_id").prop('required',false);
                        }
                    else if (($('#firmatipi_id option:selected').text()) =='ÇÖZGÜ')
                        {
                        $("div[name='cozgu']").show();
                        $("div[name='iplikbukum'],div[name='iplikboya']").hide();
                        $("#cozgu_id").prop('required', true);
                        $("#iplikbukum_id, #iplikboya_id").prop('required',false);
                        }
                    else if (($('#firmatipi_id option:selected').text()) =='İPLİK BOYA')
                        {
                        $("div[name='iplikboya']").show();
                        $("div[name='iplikbukum'],div[name='cozgu']").hide();
                        $("#iplikboya_id").prop('required', true);
                        $("#cozgu_id, #iplikbukum_id").prop('required',false);
                        }
                    else        
                        {
                        $("div[name='cozgu'],div[name='iplikboya'],div[name='iplikbukum']").hide();
                        $("div[name='order_id']").show();
                        $("#cozgu_id, #iplikboya_id ,#iplikbukum_id").prop('required',false);
                        }
                });

            }
            else if ($('#hareketturu_id option:selected').text() == 'ÇIKIŞ')
            {
               $("div[name*='ctrh'],div[name*='giris'],div[name='order_id']").show();
               $("div[name*='gtrh']").hide();

               $('#firmatipi_id').change(function(){
                    if (($('#firmatipi_id option:selected').text()) =='BÜKÜM')
                        {
                        $("div[name='iplikbukum']").show();
                        $("div[name='cozgu'],div[name='iplikboya_id']").hide();
                        $("#iplikbukum_id").prop('required', true);
                        $("#cozgu_id, #iplikboya_id").prop('required',false);
                        }
                    else if (($('#firmatipi_id option:selected').text()) =='ÇÖZGÜ')
                        {
                        $("div[name='cozgu']").show();
                        $("div[name='iplikbukum'],div[name='iplikboya']").hide();
                        $("#cozgu_id").prop('required', true);
                        $("#iplikbukum_id, #iplikboya_id").prop('required',false);
                        }
                    else if (($('#firmatipi_id option:selected').text()) =='İPLİK BOYA')
                        {
                        $("div[name='iplikboya']").show();
                        $("div[name='iplikbukum'],div[name='cozgu']").hide();
                        $("#iplikboya_id").prop('required', true);
                        $("#cozgu_id, #iplikbukum_id").prop('required',false);
                        }
                    else        
                        {
                        $("div[name='cozgu'],div[name='iplikboya'],div[name='iplikbukum']").hide();
                        $("div[name='order_id']").show();
                        $("#cozgu_id, #iplikboya_id ,#iplikbukum_id").prop('required',false);
                        }
                });
            }
        });

     
       $('#iplikbukum_id,#iplikboya_id,#cozgu_id').change(function(){
           val=  $(this).find('option:selected').attr('class');
           id= val.split("-");
           $("select[name='firma_id']").append('<option value="'+id[0]+'" selected> '+id[1]+'</option>'); 
           valorder=  $(this).find('option:selected').attr('name');
           orderid= valorder.split("-");
           $("select[name='order_id']").append('<option value="'+orderid[0]+'" selected> '+orderid[1]+'</option>'); 
       });
   });

$( function() {
    $('#firma_id,#order_id,#iplikbukum_id,#iplikboya_id,#cozgu_id').select2({ width: '320px' });
});


</script>
@endsection