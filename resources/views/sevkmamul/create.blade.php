@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mamul Sevkiyat Oluştur') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('sevkmamul.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                            <div class="col-md-6">
                                <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" required>
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
                            <label for="firmatipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Sevk Tipi') }}</label>

                            <div class="col-md-6">
                                <select name='firmatipi_id' class="form-control  @error('firmatipi_id') is-invalid @enderror" required>
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
                                <label for="irsaliyeno" class="col-md-4 col-form-label text-md-right">{{ __('İrsaliye No') }}</label>

                                <div class="col-md-6">
                                    <input id="irsaliyeno" type="text" class="form-control @error('irsaliyeno') is-invalid @enderror" name="irsaliyeno" value="{{ old('irsaliyeno') }}" required autocomplete="irsaliyeno" autofocus>

                                    @error('irsaliyeno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="trh" class="col-md-4 col-form-label text-md-right">{{ __('Sevk Tarihi') }}</label>

                            <div class="col-md-6">

                                <input id="trh" type="date" class="form-control @error('trh') is-invalid @enderror" name="trh" value="{{ old('trh') }}"  autocomplete="trh" autofocus>
                                @error('trh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="adres" class="col-md-4 col-form-label text-md-right">{{ __('Sevk Adresi') }}</label>
                            <div class="col-md-6">
                               <textarea id="adres" type="text" class="form-control"   name="adres"  autocomplete="adres" autofocus>{{ old('adres') }}
                               </textarea>
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
@endsection

@section('js')
<script type="text/javascript">
    $("select[name='firma_id']").change(function(){
        var sid = $(this).val();

        if(sid){
            $.ajax({
             type:"get",
             url:'{{url('/sevkmamul/firmadetay')}}/'+sid, 
             success:function(res)
             {     var kayitSay = res.length;  
                if(kayitSay > 0)
                    {//console.log; 
                         $("textarea[name='adres']").empty();
                         $("textarea[name='adres']").append(res[0].adres1);
                        }
                        else {
                           //$("textarea[name='adres']").empty();
                          // $("input[name='vade").val('');
                           $("textarea[name='adres']").val('');
                            }
                   }
               });
        }
    });
                    </script>
                    @endsection
