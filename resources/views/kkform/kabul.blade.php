@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">
                    <a href="" style="color:black" title="FORM YAZDIR" id="print"><i class="fas fa-sticky-note fa-2x"></i></a>
                {{ __('Kalite Kontrol Form') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div align="center">
                    <?php 
                    if(file_exists('storage/uploads/'.$ball->order->order_no)){
                        $klasor = opendir( 'storage/uploads/'.$ball->order->order_no);
                        while (false !== ($girdi = readdir($klasor))) {
                            if ($girdi != "." && $girdi != "..") {
                                $ext = pathinfo($girdi);
                                $uzanti= $ext['extension']; $namedosya=basename($girdi);
                                ?>
                                <img src="{{ Storage::url('uploads/'.$ball->order->order_no.'/'.$namedosya) }}" width="340" height="150"/>    
                                <?php
                            }
                        }
                        closedir($klasor);
                    }
                    ?>
                </div>
                <table border="1">
                    <tr>
                        <td>
                            Top No  : {{$ball->barcode ?? ''}}
                        </td>
                        <td>
                            Üretilen Makina No   : {{$ball->machine->name ?? ''}}
                        </td>
                        <td>Sipariş No    : {{ $ball->order->order_no ?? ''}}
                        </td>
                        <td>Levent No    : {{ $ball->levent_barcode ?? ''}}
                        </td>
                        
                    </tr>
                </table> 
                <div class="card-header">{{ __('KK Form Bilgileri') }}  </div> 
                <table>
                    <form method="#" action="">
                        @csrf 
                        {{-- <input type="hidden" name="kkform_id" value="{{$kkform->id ?? ''}}"> --}}
                        <input type="hidden" name="machine_id" value="{{$ball->machine_id ?? ''}}">
                        <input type="hidden" name="order_id" value="{{$ball->order_id ?? ''}}">
                        <input type="hidden" name="barcode" value="{{$ball->barcode ?? ''}}">
                        <tr><td>
                            <label for="kumaseni" class="col-form-label text-md-right">{{ __('Kumas Eni') }}</label>

                            <div>
                                <input id="kumaseni" type="number" class="form-control @error('kumaseni') is-invalid @enderror" placeholder="Kumaş Eni" name="kumaseni"  value="{{$kkform->kumaseni ?? ''}}" autocomplete="kumaseni">

                                @error('kumaseni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div></td>
                            <td>
                                <label for="kg" class="col-form-label text-md-right">{{ __('KG') }}</label>

                                <div>
                                    <input id="kg" type="number" class="form-control @error('kg') is-invalid @enderror" placeholder="KG" name="kg"   value="{{$kkform->kg ?? ''}}" autocomplete="kg">

                                    @error('kg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </td><td>
                                <label for="ebat" class="col-form-label text-md-right">{{ __('Ebat') }}</label>

                                <div>
                                    <input id="ebat" type="text" class="form-control @error('ebat') is-invalid @enderror" placeholder="Ebat" name="ebat"   value="{{$kkform->ebat ?? ''}}" autocomplete="ebat">

                                    @error('ebat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </td><td>
                                <label for="hamboy" class="col-form-label text-md-right">{{ __('Ham Boy') }}</label>

                                <div>
                                    <input id="hamboy" type="text" class="form-control @error('hamboy') is-invalid @enderror" placeholder="hamboy" name="hamboy"   value="{{$kkform->hamboy ?? ''}}" autocomplete="hamboy">

                                    @error('hamboy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </td><td>
                                <label for="mt" class="col-form-label text-md-right">{{ __('Metre') }}</label>

                                <div>
                                    <input id="mt" type="number" step="0.001" class="form-control @error('mt') is-invalid @enderror" placeholder="mt" name="mt"   value="{{$kkform->metre ?? ''}}" autocomplete="mt">

                                    @error('mt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </td><td>
                                <label for="brutmetre" class="col-form-label text-md-right">{{ __('Brüt metre') }}</label>

                                <div>
                                    <input id="brutmetre" type="number" step="0.001" class="form-control @error('brutmetre') is-invalid @enderror" placeholder="Brüt Metre" name="brutmetre"   value="{{$kkform->brutmetre ?? ''}}" autocomplete="brutmetre">

                                    @error('brutmetre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <label for="trh" class="col-form-label text-md-right">{{ __('Tarih') }}</label>

                                <div>
                                    <input id="trh" type="date" step="0.001" class="form-control @error('trh') is-invalid @enderror" placeholder="Brüt Metre" name="trh"   value="{{$kkform->trh ?? ''}}" autocomplete="trh">

                                    @error('trh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                    </div>
                </form>
            </table>
            <br>
            <table>
                <tr bgcolor="gray">
                    <td>&nbsp;</td>
                </tr>
            </table>
            <div id="print" class="card-header">
                <div class="row">
                    <div class="col-sm">
                        {{ __('Hata Bilgileri') }} 
                        <a  href="#"style="color:black" id="etiket" title="ETİKET YAZDIR"><i class="fas fa-print fa-2x"></i></a>
                    </div>
                    <form method="POST" id="topbolme" action="{{route('topbolme')}}">
                        @csrf
                        <div class="col-sm text-md-right">
                            <input type="hidden" name="barcode" value="{{$ball->barcode ?? ''}}">
                            Topun Kesilecek Metresini Giriniz<input type="number" class="form-control" min="1" name="topbolme" id="topbolme" placeholder="Kesilecek Metre">
                        </div> 
                    </form>
                </div>
            </div>        

            @if ($ball->order->dokumaadet > 1)

            <div class="row">
                @for($i=1; $i <= ($ball->order->dokumaadet); $i++)
                <div class="col-sm">
                   <table id="print" border="2">
                    <tr>
                        <td>
                                <input type="number" name="iskarta{{$i}}" id="iskarta{{$i}}" placeholder="Iskarta Metre Giriniz..">
                        </td>
                    </tr>
                    <form method="POST" action="{{route('kkformlist')}}">
                        @csrf 
                        <tr><td> {{$i.'.Top'}}
                            <input type="hidden" name="barcode" value="{{$ball->barcode ?? ''}}">
                            <input type="hidden" name="type" value="{{$i ?? ''}}">
                        </td></tr>

                        <tr><td>
                            <div>
                                <input id="metre" type="number" min="0" class="form-control @error('metre') is-invalid @enderror" placeholder="Hata Metresini Yazınız" name="metre"  autocomplete="metre" autofocus>

                                @error('metre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div></td></tr><tr>
                                <td>
                                    <div>
                                        <select id="hatalist_id" name='hatalist_id' class="form-control  @error('hatalist_id') is-invalid @enderror" >
                                            <option value="">Hata Seçiniz..</option>
                                            @foreach ($hatalist as $list)
                                            <option value="{{$list->id}}" id="hatalist_id">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td></tr><tr><td>
                                    <div>
                                        <select id="hatapuan_id" name='hatapuan_id' class="form-control  @error('hatapuan_id') is-invalid @enderror" >
                                            <option value="">Puan Seçiniz..</option>
                                            @foreach ($hatapuan as $list)
                                            <option value="{{$list->id}}" id="hatapuan_id">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td></tr><tr><td>
                                    <div>
                                        <select id="vardiya1_id" name='vardiya1_id' class="form-control  @error('vardiya1_id') is-invalid @enderror" >
                                            <option value="">Vardiya Seçiniz..</option>
                                            @foreach ($vardiya as $list)
                                            <option value="{{$list->id}}" >{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td></tr><tr><td>
                                    <div>
                                        <select id="vardiya2_id" name='vardiya2_id' class="form-control  @error('vardiya2_id') is-invalid @enderror" >
                                            <option value="">Sonraki Vardiya Seçiniz..</option>
                                            @foreach ($vardiya as $list)
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr><tr><td>
                                    <div>
                                        <textarea name="aciklama" class="form-control" id="aciklama"></textarea>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>

                                    <div> <br>
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Ekle') }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
                @endfor
            </div>    
            @else
            <table id="print">
                <tr>
                        <td>
                                <input type="number" name="iskarta1" id="iskarta1" placeholder="Iskarta Metre Giriniz..">
                        </td>
                    </tr>
                <form method="POST" action="{{route('kkformlist')}}">
                    @csrf 
                    <input type="hidden" name="barcode" value="{{$ball->barcode ?? ''}}">
                    <tr><td>
                        <label for="metre" class="col-form-label text-md-right">{{ __('Hata Metresi') }}</label>

                        <div>
                            <input id="metre" type="number" min="0" class="form-control @error('metre') is-invalid @enderror" placeholder="Hata Metresi" name="metre"  autocomplete="metre" autofocus>

                            @error('metre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div></td>
                        <td>
                            <label for="hatalist_id" class="col-form-label text-md-right">{{ __('Hata') }}</label>

                            <div>
                                <select id="hatalist_id" name='hatalist_id' class="form-control  @error('hatalist_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($hatalist as $list)
                                    <option value="{{$list->id}}" id="hatalist_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td><td>
                            <label for="ebat" class="col-form-label text-md-right">{{ __('Hata Puanı') }}</label>

                            <div>
                                <select id="hatapuan_id" name='hatapuan_id' class="form-control  @error('hatapuan_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($hatapuan as $list)
                                    <option value="{{$list->id}}" id="hatapuan_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td><td>
                            <label for="hamboy" class="col-form-label text-md-right">{{ __('Vardiya') }}</label>

                            <div>
                                <select id="vardiya1_id" name='vardiya1_id' class="form-control  @error('vardiya1_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($vardiya as $list)
                                    <option value="{{$list->id}}" >{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td><td>
                            <label for="hamboy" class="col-form-label text-md-right">{{ __('Sonraki Vardiya') }}</label>

                            <div>
                                <select id="vardiya2_id" name='vardiya2_id' class="form-control  @error('vardiya2_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($vardiya as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <label for="hamboy" class="col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div>
                                <textarea name="aciklama" class="form-control" id="aciklama"></textarea>
                            </div>
                        </td>
                        <td>

                            <div> <br>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Ekle') }}
                                </button>
                            </div>
                        </td>
                    </tr>
                </form>
            </table>
            @endif
            <div class="card-header text-md-center">{{ __('Hatalar') }}
            </div>

            @if ($ball->order->dokumaadet > 1)

            <div class="row">
                @for($i=1; $i <= ($ball->order->dokumaadet); $i++)
                <div class="col-sm">
                    <table border="1">
                        <thead>
                            <tr>
                                <div class="col-md-6">
                                    <td></td>
                                    <td>Hata Mt.</td>
                                    <td>Hata</td>
                                    <td>Hata P.</td>
                                    <td>Vardiya</td>
                                    <td>S.Vardiya</td>
                                    <td></td>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($kkformdetail)
                            @foreach($kkformdetail->where('type',$i) as $list)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$list->metre}}</td>
                                <td>{{$list->hatalist->name ?? ''}}</td>
                                <td>{{$list->hatapuan->name ?? ''}}</td>
                                <td>{{$list->vardiya1->name ?? ''}}</td>
                                <td>{{$list->vardiya2->name ?? ''}}</td>
                                <td>
                                    <form action="{{route('kkformdetaildestroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" id="print" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
                @endfor
            </div>

            @else
            <table border="1">
                <thead>
                    <tr>
                        <div class="col-md-6">
                            <td><h5></h5></td>
                            <td><h5>Hata Metresi</h5></td>
                            <td><h5>Hata</h5></td>
                            <td><h5>Hata Puanı</h5></td>
                            <td><h5>Vardiya</h5></td>
                            <td><h5>Sonraki Vardiya</h5></td>
                            <td><h5></h5></td>
                        </div>
                    </tr>
                </thead>
                <tbody>
                    @isset($kkformdetail)
                    @foreach($kkformdetail as $list)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$list->metre}}</td>
                        <td>{{$list->hatalist->name ?? ''}}</td>
                        <td>{{$list->hatapuan->name ?? ''}}</td>
                        <td>{{$list->vardiya1->name ?? ''}}</td>
                        <td>{{$list->vardiya2->name ?? ''}}</td>
                        <td>
                            <form action="{{route('kkformdetaildestroy', $list->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" id="print" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
            @endif

        </div>
    </div>
</div>
</div>

@endsection
@section('css')
<style type="text/css">
 @media print {
  #print {
    display :  none;
}
}
</style>
@endsection
@section('js')
<script type="text/javascript">

 $('#topbolme').submit(function(){
    $('input[name=topbolme]').hide();
});

 $('input[name*=iskarta]').change(function(){
    $(this).toggle( "highlight" );
    text = $(this).attr("id");
    metre = $(this).val();
    barcode = $('input[name=barcode]').val();
    var type = text.substr(7, 1);
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
    sayfa = '{{ route('iskarta') }}';
    $.post(sayfa, {metre:metre,type:type,barcode:barcode}, function(data) {
        $("#iskarta"+type).toggle( "highlight" );
    });

});


 $('#etiket').click(function(){
    mt=$('#mt').val();
    if(mt <= 0) {alert('Lütfen Kumaş Metresini Giriniz!!');}
    else { sayfa = '{{ url('kkform/sticker') }}/'+barcode; window.location.href = sayfa; }
});

 $('input[name=kumaseni],input[name=kg],input[name=ebat],input[name=mt],input[name=hamboy],input[name=brutmetre],input[name=trh]').change(function(){
    $(this).toggle( "highlight" );
    // val = $(this).val();
    attr = $(this).attr('id');
    // kkform_id = $('input[name=kkform_id]').val();
    machine_id = $('input[name=machine_id]').val();
    order_id = $('input[name=order_id]').val();
    barcode = $('input[name=barcode]').val();
    kumaseni = $('input[name=kumaseni]').val();
    hamboy = $('input[name=hamboy]').val();
    kg = $('input[name=kg]').val();
    ebat = $('input[name=ebat]').val();
    metre = $('input[name=mt]').val();
    brutmetre = $('input[name=brutmetre]').val();
    trh = $('input[name=trh]').val();

    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
    sayfa = '{{ route('kkform.store') }}';
    $.post(sayfa, {machine_id:machine_id,order_id:order_id,barcode:barcode ,kumaseni:kumaseni,hamboy:hamboy,kg:kg,ebat:ebat,metre:metre,brutmetre:brutmetre, trh:trh}, function(data) {
        $("#"+attr).toggle( "highlight" );
    });
});
 $("#print").click(function(){

    window.print();
});
</script>


@endsection