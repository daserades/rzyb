@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Boyahane Talimat Detayı Güncelle') }}</div>

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
                    <form method="POST" action="{{ route('boyahaneupdate2') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$boyahanedetail->id}} ">
                        <input type="hidden" name="boyahane_id" value="{{$boyahanedetail->boyahane_id}} ">
                         <div class="form-group row">
                            <label for="metre" class="col-md-4 col-form-label text-md-right">{{ __('Metre') }}</label>

                            <div class="col-md-6">

                                <input id="metre" type="number" class="form-control @error('metre') is-invalid @enderror" name="metre" value="{{ $boyahanedetail->metre }}"  autocomplete="metre" autofocus>
                                @error('metre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="kg" class="col-md-4 col-form-label text-md-right">{{ __('Kg') }}</label>

                            <div class="col-md-6">

                                <input id="kg" type="number" class="form-control @error('kg') is-invalid @enderror" name="kg" value="{{ $boyahanedetail->kg }}"  autocomplete="kg" autofocus>
                                @error('kg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="mamulen" class="col-md-4 col-form-label text-md-right">{{ __('Mamul En') }}</label>

                            <div class="col-md-6">

                                <input id="mamulen" type="number" class="form-control @error('mamulen') is-invalid @enderror" name="mamulen" value="{{ $boyahanedetail->mamulen }}"  autocomplete="mamulen" autofocus>
                                @error('mamulen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="fiyat" class="col-md-4 col-form-label text-md-right">{{ __('Fiyat') }}</label>

                            <div class="col-md-6">

                                <input id="fiyat" type="text" class="form-control @error('fiyat') is-invalid @enderror" name="fiyat" value="{{ $boyahanedetail->fiyat }}"  autocomplete="fiyat" autofocus>
                                @error('fiyat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Terbiye Süreci') }} </label>
                            <div class="col-md-6">
                               <select name='terbiyesureci_id' class="form-control">
                                <option value="{{$boyahanedetail->terbiyesureci_id}} "> {{ $boyahanedetail->terbiyesureci->name ?? ''}} ---> {{ $boyahanedetail->terbiyesureci->surec ?? ''}} </option>
                                @foreach ($terbiyesureci as $list)
                                <option value="{{$list->id}}">{{$list->name.'--->'.$list->surec}}</option>
                                @endforeach 
                            </select> 
                            @error('terbiyesureci_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="giris">
                            <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama" id="aciklama" autocomplete="aciklama" autofocus>{{$boyahanedetail->aciklama}}
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
   });
</script>
@endsection