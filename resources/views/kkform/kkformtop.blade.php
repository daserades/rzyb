@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kalite Kontrol Kabul Ekranı') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                        <div class="form-group row">
                            <label for="barcode" class="col-md-6 col-form-label text-md-center">{{ __('Top Üzerindeki Barkodunu Okutunuz') }}</label>

                            <div class="col-md-6">
                                <input id="barcode" type="password" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}" required autocomplete="barcode" autofocus>

                                @error('barcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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