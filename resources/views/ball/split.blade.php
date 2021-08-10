@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Top Bölme Ekranı') }}</div>

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
                        <div class="form-group row">
                            <label for="barcode" class="col-md-4 col-form-label text-md-right">{{ __('Bölünecek Kumaş Barkodunu Okutunuz') }}</label>

                            <div class="col-md-8">
                                <input id="barcode" type="password" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="" required autocomplete="barcode" autofocus>

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
                                    {{ __('Devam Et') }}
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
<script type="text/javascript">

    $("input[id=barcode]").change(function(){
        id=$(this).val();
             if(id){
            window.location = "{{url('kkform/kabul')}}/"+id;  
             }

    });


</script>

@endsection