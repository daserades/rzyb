@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Levent İrsaliye Güncelle') }}</div>

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
                    <form method="POST" action="{{ route('leventhareket.update', $leventhareket->id) }}">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" id="hareketturu_id" value="{{$leventhareket->hareketturu_id}}">                            
                        <div class="form-group row">
                            <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                            <div class="col-md-6">
                                <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" >
                                    <option value="@isset($leventhareket->firma_id){{$leventhareket->firma_id}}@endisset">@isset($leventhareket->firma->name){{$leventhareket->firma->name}}@endisset</option>
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
                            <label for="firmatipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Sevk Tipi') }}</label>

                            <div class="col-md-6">
                                <select name='firmatipi_id' class="form-control  @error('firmatipi_id') is-invalid @enderror" >
                                    <option value="@isset($leventhareket->firmatipi_id){{$leventhareket->firmatipi_id}}@endisset">@isset($leventhareket->firmatipi->name){{$leventhareket->firmatipi->name}}@endisset</option>
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

                                <input id="gtrh" type="date" class="form-control @error('gtrh') is-invalid @enderror" name="gtrh" value="@if ($leventhareket->gtrh){{ date('Y-m-d',strtotime($leventhareket->gtrh))}}@endif"  autocomplete="gtrh" autofocus>
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

                                <input id="ctrh" type="date" class="form-control @error('ctrh') is-invalid @enderror" name="ctrh" value="@if ($leventhareket->ctrh){{ date('Y-m-d',strtotime($leventhareket->ctrh))}}@endif" autocomplete="ctrh" autofocus>
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
                                <input id="barcode_adet" type="text" class="form-control @error('barcode_adet') is-invalid @enderror" name="barcode_adet"  autocomplete="barcode_adet" value="{{$leventhareket->barcode_adet}}" autofocus>

                                @error('barcode_adet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="irsaliye_no" class="col-md-4 col-form-label text-md-right">{{ ('İrsaliye No') }}</label>

                            <div class="col-md-6">
                                <input id="irsaliye_no" type="text" class="form-control @error('irsaliye_no') is-invalid @enderror" name="irsaliye_no"  autocomplete="irsaliye_no" value="{{$leventhareket->irsaliye_no}}" autofocus>

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
                                <input id="fatura_no" type="text" class="form-control @error('fatura_no') is-invalid @enderror" name="fatura_no"  autocomplete="fatura_no" value="{{$leventhareket->fatura_no}}" autofocus>

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
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>{{$leventhareket->aciklama}}
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