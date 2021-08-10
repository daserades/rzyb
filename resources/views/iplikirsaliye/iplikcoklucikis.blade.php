@extends('layouts.app')

@section('content')
  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">            <div class="card">
                <div class="card-header">{{ __('İplik Barkodlu Çıkış') }}</div>
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
                    <form method="POST" action="{{ route('cikisdepostore') }}" id="form">
                        @csrf
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
                       <div class="form-group row">
                            <label for="firmatipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Çıkış Yeri') }}</label>

                            <div class="col-md-6">
                                <select name='firmatipi_id' class="form-control  @error('firmatipi_id') is-invalid @enderror" >
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
                            <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıkklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama" id="aciklama" autocomplete="aciklama" autofocus>
                               </textarea>
                           </div>
                       </div> 
                       <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
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
$( function() { 

});
</script>
@endsection