@extends('layouts.app')

@section('content')
  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">            <div class="card">
                <div class="card-header">{{ __('Çözgü Talimat Güncelle') }}</div>
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
                    <form method="POST" action="{{ route('cozgu.update',$cozgu->id) }}">
                        @method('PATCH')
                        @csrf
                         <div class="form-group row" name="giris">
                            <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                             <div class="col-md-6">
                                <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" >
                                    <option value="@isset($cozgu->firma_id){{$cozgu->firma_id}}@endisset">@isset($cozgu->firma->name){{$cozgu->firma->name}}@endisset</option>
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
                        <div class="form-group row" name="giris">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Order') }}</label>

                            <div class="col-md-6">
                                <select name='order_id' class="form-control  @error('order_id') is-invalid @enderror" >
                                    <option value="@isset($cozgu->order_id){{$cozgu->order_id}}@endisset">@isset($cozgu->order->order_no){{$cozgu->order->order_no}}@endisset</option>
                                    @foreach ($order as $list)
                                    <option value="{{$list->id}}" id="order_id">{{$list->order_no}}</option>
                                    @endforeach
                                </select>
                                @error('order_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="telsayi" class="col-md-4 col-form-label text-md-right">{{ __('Çözgü Tel Sayısı') }}</label>

                            <div class="col-md-6">

                                <input id="telsayi" type="number" class="form-control @error('telsayi') is-invalid @enderror" name="telsayi" value="{{ $cozgu->telsayi }}"  autocomplete="telsayi" autofocus>
                                @error('telsayi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="leventeni" class="col-md-4 col-form-label text-md-right">{{ __('Levent Eni') }}</label>

                            <div class="col-md-6">

                                <input id="leventeni" type="number" class="form-control @error('leventeni') is-invalid @enderror" name="leventeni" value="{{ $cozgu->leventeni }}"  autocomplete="leventeni" autofocus>
                                @error('leventeni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="metraj" class="col-md-4 col-form-label text-md-right">{{ __('Metraj') }}</label>

                            <div class="col-md-6">

                                <input id="metraj" type="number" class="form-control @error('metraj') is-invalid @enderror" name="metraj" value="{{ $cozgu->metraj }}"  autocomplete="metraj" autofocus>
                                @error('metraj')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="bobinadet" class="col-md-4 col-form-label text-md-right">{{ __('Bobin Adet') }}</label>

                            <div class="col-md-6">

                                <input id="bobinadet" type="number" class="form-control @error('bobinadet') is-invalid @enderror" name="bobinadet" value="{{ $cozgu->bobinadet }}"  autocomplete="bobinadet" autofocus>
                                @error('bobinadet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="tip" class="col-md-4 col-form-label text-md-right">{{ __('Çözgü Tel Sayısı') }}</label>

                            <div class="col-md-6">

                                <input id="tip" type="text" class="form-control @error('tip') is-invalid @enderror" name="tip" value="{{ $cozgu->tip }}"  autocomplete="tip" autofocus>
                                @error('tip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="giris">
                            <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama" id="aciklama" autocomplete="aciklama" autofocus>{{$cozgu->aciklama}}
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
$( function() { 
   
});
</script>
@endsection