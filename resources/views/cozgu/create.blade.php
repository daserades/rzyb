@extends('layouts.app')

@section('content')
  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">            <div class="card">
                <div class="card-header">{{ __('Çözgü Talimat') }}</div>
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
                    <form method="POST" action="{{ route('cozgu.store') }}" id="form">
                        @csrf
                         <div class="form-group row" >
                            <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                            <div class="col-md-6">
                                <select name='firma_id' id="firma_id" class="form-control  @error('firma_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($firma as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('firma_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row" >
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Order') }}</label>

                            <div class="col-md-6">
                                <select name='order_id' id="order_id" class="form-control  @error('order_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($order as $list)
                                    <option value="{{$list->id}}" >{{$list->order_no}}</option>
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
                            <label for="telsayi" class="col-md-4 col-form-label text-md-right">{{ __('Çözgü Tel Sayısı') }}</label>

                            <div class="col-md-6">

                                <input id="telsayi" type="number" class="form-control @error('telsayi') is-invalid @enderror" name="telsayi" value="{{ old('telsayi') }}"  autocomplete="telsayi" autofocus>
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

                                <input id="leventeni" type="number" class="form-control @error('leventeni') is-invalid @enderror" name="leventeni" value="{{ old('leventeni') }}"  autocomplete="leventeni" autofocus>
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

                                <input id="metraj" type="number" class="form-control @error('metraj') is-invalid @enderror" name="metraj" value="{{ old('metraj') }}"  autocomplete="metraj" autofocus>
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

                                <input id="bobinadet" type="number" class="form-control @error('bobinadet') is-invalid @enderror" name="bobinadet" value="{{ old('bobinadet') }}"  autocomplete="bobinadet" autofocus>
                                @error('bobinadet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="tip" class="col-md-4 col-form-label text-md-right">{{ __('Çözgü Tip') }}</label>

                            <div class="col-md-6">

                                <input id="tip" type="text" class="form-control @error('tip') is-invalid @enderror" name="tip" value="{{ old('tip') }}"  autocomplete="tip" autofocus>
                                @error('tip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama" id="aciklama" autocomplete="aciklama" autofocus>
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
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
$( function() {
    $('#order_id').select2();
    $('#firma_id').select2();
    $('#order_id').change(function(){
        order_id=$('#order_id').val();
        //no=$('#order_id').text();
        //alert(order_id);
         if(order_id){
            $.ajax({
             type:"get",
             url:'{{url('cozgu/cozgubilgi')}}/'+order_id, 
             success:function(res)
             {     var kayitSay = res.length;  
                if(kayitSay > 0)
                    {
                        console.log(kayitSay); 
                       // $("select[name='firmadetay_id").empty();
                        $("input[name='leventeni").empty();
                        $("input[name='telsayi").empty();
                        $("input[name='metraj").empty();
                            //$("select[name*='kur_id").empty();

                            /*for (var i = 0; i < kayitSay; i++)
                            {
                                $("select[name='firmadetay_id']").append('<option value="'+res[i].id+'">vade='+res[i].vade+'  iskonta='+res[i].iskonta+'   döviz='+res[i].kur.name+'</option>');
                            };*/
                            $("input[name='leventeni']").val(res[0].leventgenisligi);
                            $("input[name='telsayi']").val(res[0].cts);
                            $("input[name='metraj']").val(res[0].cozgumetraji);
                        }
                        else {
                           //$("select[name='firmadetay_id").empty();
                           $("input[name='leventeni").val('');
                           $("input[name='telsayi").val('');
                           $("input[name='metraj").val('');
                           //$("select[name='kur_id']select").val('');
                       }
                   }
               });
        }
    });

});
</script>
@endsection