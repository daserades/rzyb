@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Boyahane Talimatı') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table border="1">
                    <tr>
                        <td>
                            Talimat No  :{{$boyahane->no}}
                        </td>
                        <td>
                            Firma   : {{$boyahane->firma->name ?? ''}}
                        </td>
                        <td> Talimat Tarihi   :  {{ $boyahane->created_at }}
                        </td>
                        
                    </tr>
                </table> 
                <div class="card-header">{{ __('Talimat Bilgileri') }}  </div> 
                <form method="POST" action="{{route('boyahanestore2')}}">
                    @csrf
                    <table border="1" class="table-sm">
                        <tr>
                            <td colspan="2">
                                <input id="boyahane_id" name="boyahane_id" type="hidden" class="form-control" value="{{ $boyahane->id }}">
                                <label >{{ __('Sipariş No') }}</label>
                                <select name='order_id' id="order_id" required="">
                                    <option value="">Seçiniz..</option>
                                    @foreach ($order as $list)
                                    <option value="{{$list->id}}">{{$list->order_no}}</option>
                                    @endforeach 
                                </select> 
                                @error('order_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td><td>
                                <label for="katsayi"  name="">{{ __('Sip.M.') }}</label>
                                <input type="text" name="orderm" disabled="" size="6">
                            </td><td>
                                <label for="katsayi" >{{ __('Toplam Top M.') }}</label>
                                <input type="text" name="totm" disabled="" size="6">
                            </td><td>
                                <label for="katsayi"  name="">{{ __('Ham En.') }}</label>
                                <input type="text" name="hamen" disabled="" size="6">
                            </td>
                        </tr>
                        <tr><td>

                            <label>{{ __('Sevk Metre') }}</label>

                            <input id="metre" type="number"  name="metre" value="{{ old('metre') }}"  autocomplete="metre" autofocus>
                        </td><td>
                           <label>{{ __('Sevk KG') }}</label>

                           <input id="kg" type="number"  name="kg" value="{{ old('kg') }}"  autocomplete="kg" autofocus>
                       </td><td>
                        <label>{{ __('İstenen Mamul En') }}</label>
                        <input id="mamulen" type="text"  name="mamulen" value="{{ old('mamulen') }}"  autocomplete="mamulen" autofocus>

                    </td>
                </td><td>
                    <label for="katsayi"  name="">{{ __('Fiyat') }}</label>
                    <input type="text" name="fiyat" >
                </td><td>
                    <label for="kur_id" >{{ __('Döviz Cinsi') }}</label>
                    <select name='kur_id' id="kur_id" >
                        <option value="">Seçiniz..</option>
                        @foreach ($kur as $list)
                        <option value="{{$list->id}}">{{$list->name}}</option>
                        @endforeach 
                    </select>  
                </td>
            </tr>
            <tr><td colspan="5">

                <label for="terbiyesureci_id">{{ __('Terbiye Süreci') }}</label>
                <select name='terbiyesureci_id' id="terbiyesureci_id" >
                    <option value="">Seçiniz..</option>
                    @foreach ($terbiyesureci as $list)
                    <option value="{{$list->id}}">{{$list->name.'--->'.$list->surec}}</option>
                    @endforeach 
                </select> 
                @error('terbiyesureci_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </td></tr>
            <tr>
                <td colspan="4">
                    <textarea name="aciklama" cols="130" placeholder="AÇIKLAMA GİRİNİZ....."></textarea>
                </td>
                <td>
                <button type="submit" class="btn btn-success">
                    {{ __('Ekle') }}
                </button>
                    
                </td>
            </tr>
        </div>
    </table>
</form>
                <div class="card-header">{{ __('Boyahane Detay Bilgileri') }}  </div> 
        <table class="table table-striped table-sm table-hover" border="1">
         <thead>
            <th></th>
            <th>Sipariş</th>
            <th>Sipariş M.</th>
            <th>Sevk M.</th>
            <th>Sevk KG.</th>
            <th>İstenen Mamul En</th>
            <th>Terbiye Süreci</th>
            <th>Fiyat</th>
            <th>Açıklama</th>
            <th colspan="2"></th>
        </thead>
        <tbody>
                @isset($boyahane->boyahanedetail)
                @foreach($boyahane->boyahanedetail as $list)
                <tr>
                    <td></td>
                    <td>{{$list->order->order_no}}</td>
                    <td>{{$list->order->miktar}}</td>
                    <td>{{$list->metre}}</td>
                    <td>{{$list->kg}}</td>
                    <td>{{$list->mamulen}}</td>
                    <td>{{$list->terbiyesureci->name ?? ''}}</td>
                    <td>{{$list->fiyat ?? ''}} - {{ $list->kur->name ?? ''}}</td>
                    <td>{{$list->aciklama}}</td>
                    <td><a href="{{route('boyahaneedit2',$list->id)}}" style="color:black" target="_blank" title="Düzenle"><i class="far fa-edit fa-2x"></i></a></td>
                    <td>
                                <div class="delete-form">
                                    <form action="{{route('boyahanedestroy2', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                </tr>
                @endforeach
                @endisset
        </tbody>
        </table>

</div>
</div>
</div>
</div>

@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    $( function() {
        $('#order_id').select2({ width: '320px' });
       // $('#order_id,#iplikseridi_id,#kur_id').select2({ width: '140px' });
   });

    $('#order_id').change(function(){
        id=$(this).val();
        if(id)
        {
           $.ajax({
               type:"get",
               url:'{{url('boyahane/order')}}/'+id, 
               success:function(res)
               {     var kayitSay = res.length;  
                if(kayitSay > 0)
                { 
                    var i;
                    var tot=0;
                    for (i = 0; i < res[0].ball.length; i++) {
                      tot += res[0].ball[i].metre;
                  }
                  $("input[name=orderm]").empty();
                  $("input[name=orderm]").val(res[0].miktar);
                  $("input[name=totm]").empty();
                  $("input[name=totm]").val(tot);
                  $("input[name=hamen]").empty();
                  $("input[name=hamen]").val(res[0].ball[0].kumaseni);
              }
          }
      });
       }
   });

    // $('input[id*=miktar],input[id*=fiyat],select[id*=kur_id],textarea[id*=aciklama]').change(function(){
    //     $(this).toggle( "highlight" );
    //     var a=$(this).attr('name');
    //     var id = $(this).attr('id').substring(a.length);
    //     var miktar = $('#miktar'+id).val();
    //     var fiyat = $('#fiyat'+id).val();
    //     var kur_id = $('#kur_id'+id).val();
    //     var iplikboya_id = $('#iplikboya_id').val();
    //     var aciklama = $('#aciklama'+id).val();
    //     var iplikseridi_id = $('#iplikseridi_id'+id).val();
    //         $.ajaxSetup({
    //          headers: {
    //              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //          });
    //         sayfa = '{{route('boyastore2')}}';
    //         $.post(sayfa, {fiyat:fiyat,miktar:miktar,kur_id:kur_id,orderdetail_id:id,iplikboya_id:iplikboya_id,aciklama:aciklama,iplikseridi_id:iplikseridi_id}, function(data) {
    //             $("#"+a+id).toggle( "highlight" );
    //         });
    //  });
</script>
@endsection