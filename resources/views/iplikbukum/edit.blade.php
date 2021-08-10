@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('İplik Büküm Güncelle') }}</div>

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
                    <form method="POST" action="{{ route('iplikbukum.update', $iplikbukum->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                            <div class="col-md-6">
                                <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" >
                                    <option value="@isset($iplikbukum->firma_id){{$iplikbukum->firma_id}}@endisset">@isset($iplikbukum->firma->name){{$iplikbukum->firma->name}}@endisset</option>
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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  autocomplete="name" value="{{$iplikbukum->name}}" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş') }}</label>

                            <div class="col-md-6">
                                <select name='order_id' class="form-control  @error('order_id') is-invalid @enderror" >
                                    <option value="@isset($iplikbukum->order_id){{$iplikbukum->order_id}}@endisset">@isset($iplikbukum->order->order_no){{$iplikbukum->order->order_no}}@endisset</option>
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
                            <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>{{$iplikbukum->aciklama}}
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