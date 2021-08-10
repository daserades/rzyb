@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kumas Girişini Güncelle') }}</div>

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
                    <form method="POST" action="{{ route('kumas.update', $kumas->id) }}">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" id="hareketturu_id" value="{{$kumas->hareketturu_id}}">                            
                        <div class="form-group row">
                            <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                            <div class="col-md-6">
                                <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" >
                                    <option value="@isset($kumas->firma_id){{$kumas->firma_id}}@endisset">@isset($kumas->firma->name){{$kumas->firma->name}}@endisset</option>
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
                        <div class="form-group row" name="cikis">
                            <label for="adet" class="col-md-4 col-form-label text-md-right">{{ ('Top Adeti') }}</label>

                            <div class="col-md-6">
                                <input id="adet" type="text" class="form-control @error('adet') is-invalid @enderror" name="adet"  autocomplete="adet" value="{{$kumas->adet}}" autofocus>

                                @error('adet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="irsaliye_no" class="col-md-4 col-form-label text-md-right">{{ ('İrsaliye No') }}</label>

                            <div class="col-md-6">
                                <input id="irsaliye_no" type="text" class="form-control @error('irsaliye_no') is-invalid @enderror" name="irsaliye_no"  autocomplete="irsaliye_no" value="{{$kumas->irsaliye_no}}" autofocus>

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
                                <input id="fatura_no" type="text" class="form-control @error('fatura_no') is-invalid @enderror" name="fatura_no"  autocomplete="fatura_no" value="{{$kumas->fatura_no}}" autofocus>

                                @error('fatura_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
   
</script>
@endsection