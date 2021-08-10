@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Top Aktarma İşlemi') }}</div>

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
                    <form method="POST"  action="{{route('demandstore')}}">
                        @csrf
                        {{-- <div class="form-group row">
                            <label for="barcode" class="col-md-4 col-form-label text-md-right">{{ __('Aktarılacak Kumaş Barkodunu Okutunuz') }}</label>

                            <div class="col-md-6">
                                <input id="barcode" type="password" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="" required autocomplete="barcode" autofocus>

                                @error('barcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-group row" name="giris">
                            <label for="oldorder_id" class="col-md-4 col-form-label text-md-right">{{ __('Topların Seçileceği Sipariş') }}</label>

                            <div class="col-md-6">
                                <select name='oldorder_id' id="oldorder_id" class="form-control  @error('oldorder_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($order as $list)
                                    <option value="{{$list->id}}">{{$list->order_no}}</option>
                                    @endforeach
                                </select>
                                @error('oldorder_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="giris">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Topların Aktarılacağı Sipariş') }}</label>

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
                        <div class="form-group row">
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>
                                    </textarea>
                                    </div>
                            </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Devam Et') }}
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
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
$( function() {
    $('#order_id, #oldorder_id').select2({ width: '350px' });
});
</script>
@endsection