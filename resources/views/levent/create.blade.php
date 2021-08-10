@extends('layouts.app')

@section('content')
  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">            <div class="card">
                <div class="card-header">{{ __('Levent Hareket') }}</div>
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
                    <form method="POST" action="{{ route('leventhareket.store') }}" id="form">
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
                        <div class="form-group row" name="giris">
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
                            <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
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
 <style type="text/css">
 </style> 
@endsection
@section('js')
<script type="text/javascript">
    $( function() 
    { 
       $("div[name*='giris'],div[name*='gtrh'],div[name*='ctrh'],div[name='iplikbukum'],div[name='cozgu']").hide();

       $('#hareketturu_id').change(function(){
              
            if($('#hareketturu_id option:selected').text() == 'GİRİŞ')
            { 
                $("div[name*='gtrh'],div[name*='giris']").show();
                $("div[name*='ctrh']").hide();

                /*$('#firmatipi_id').change(function(){
                    if (($('#firmatipi_id option:selected').text()) =='BÜKÜM')
                            {
                            $("div[name='iplikbukum']").show();
                            $("div[name='cozgu']").hide();
                            }
                    else if (($('#firmatipi_id option:selected').text()) =='ÇÖZGÜ')
                        {
                        $("div[name='cozgu']").show();
                        $("div[name='iplikbukum']").hide();
                        }
                    else        
                        {
                        $("div[name='iplikbukum']").hide();
                        $("div[name='cozgu']").hide();
                        }
                });
                    */
            }
            else if ($('#hareketturu_id option:selected').text() == 'ÇIKIŞ')
            {
               $("div[name*='ctrh'],div[name*='giris']").show();
               $("div[name*='gtrh']").hide();
               /*
               $('#firmatipi_id').change(function(){
                    if (($('#firmatipi_id option:selected').text()) =='BÜKÜM')
                        {
                        $("div[name='iplikbukum']").show();
                        $("div[name='cozgu']").hide();
                        }
                    else if (($('#firmatipi_id option:selected').text()) =='ÇÖZGÜ')
                        {
                        $("div[name='cozgu']").show();
                        $("div[name='iplikbukum']").hide();
                        }
                    else        
                        {
                        $("div[name='iplikbukum']").hide();
                        $("div[name='cozgu']").hide();
                        }
                });
                */
            }
        });
/*
       $('#iplikbukum_id').change(function(){
           val=  $(this).find('option:selected').attr('class');
           id= val.split("-");
           $("select[name='firma_id']").append('<option value="'+id[0]+'" selected> '+id[1]+'</option>'); 
           valorder=  $(this).find('option:selected').attr('name');
           orderid= valorder.split("-");
           $("select[name='order_id']").append('<option value="'+orderid[0]+'" selected> '+orderid[1]+'</option>'); 
       });
       */
   });
</script>
@endsection