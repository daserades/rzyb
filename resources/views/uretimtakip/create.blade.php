@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Üretim') }}</div> 
                <div class="card-body">
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
                     
                    @if ($uretimtakip)

                    <form method="POST" action="{{ route('stop') }}">
                        @csrf                    
                        <div class="form-group row">
                            <label for="order_id" class="col-md-3 col-form-label">Makina No= {{$uretimtakip->machine->name}}</label>
                            <label for="order_id" class="col-md-3 col-form-label">Sipariş= {{$uretimtakip->order->order_no ?? ''}}</label>
                            <label for="order_id" class="col-md-3 col-form-label">Levent No= {{$uretimtakip->barcode ?? ''}}</label>
                            <label for="order_id" class="col-md-3 col-form-label">Tarih = {{date('d-m-Y',strtotime(now()))}}</label>
                            <input type="hidden" name="machine_id" value="{{$uretimtakip->machine_id ?? ''}}">
                            <input type="hidden" name="barcode" value="{{$uretimtakip->barcode ?? ''}}">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-3">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('LEVENT DEĞİŞTİR') }}
                                </button>
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                <a href="{{route('uretimtakip.show',$uretimtakip->id)}}" id="top" class="btn btn-danger">LEVENT (SONU) BİTİR</a>

                            </div>
                        </div>
                    </form>    

                    @else     
                    <form method="POST" action="{{ route('uretimtakip.store') }}">
                        @csrf                    
                            <input type="hidden" name="machine_id" value="{{$id ?? ''}}">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">Makina No=  {{$id ?? ''}}</label>
                            <div class="form-group row">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Form Barkodunu Okutunuz') }}</label>

                            <div class="col-md-6">
                                <input id="order_id" type="text" class="form-control @error('order_id') is-invalid @enderror" name="order_id" value="{{ old('order_id') }}" required autocomplete="order_id" autofocus>

                                @error('order_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="barcode" class="col-md-4 col-form-label text-md-right">{{ __('Levent Barkodunu Okutunuz') }}</label>

                            <div class="col-md-6">
                                <input id="barcode" type="text" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}" required autocomplete="barcode" autofocus>

                                @error('barcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('BAŞLAT') }}
                                </button>
                            </div>
                        </div>
                    </form>


                    @endif


                </div>
            </div>   
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    
$('#top').click(function(){
    $('#top').hide();
});
</script>

@endsection