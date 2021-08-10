@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header text-md-center">{{ __('Desen Bilgileri') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table border="1">
                    <tr>
                        <td>
                            Desen Adı   : {{$desen->name}}
                        </td>
                        <td>Desen No    :{{ $desen->no }}

                        </td>
                        <td>CTS     :{{ $desen->cts }}
                        </td>
                        <td> Atkı Sıklığı   :   {{ $desen->atki_sikligi }}
                        </td>
                    </tr>
                    <tr>
                        <td> Çözgü Sıklığı   :  {{ $desen->cozgu_sikligi }}
                        </td>
                        <td> Tarak No    :  {{ $desen->tarak.'*'.$desen->tarak_no }}
                        </td>
                        <td>Tarak Eni   :    {{ $desen->tarak_eni }}
                        </td>
                        <td>Faydalı Tarak Eni   :    {{ $desen->faydali_tarak_eni }}
                        </td>
                    </tr>
                </table> 
                <div class="card-header text-md-center">{{ __('İplik Bilgileri') }}
                 <td><a href="{{url('desen',$desen->id)}}" title="Renk Girişi" style="color:black"><i class="fas fa-plus-circle fa-2x"></i></a></td>
                </div>

                <table border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h5></h5></td>
                                <td><h5>İplik</h5></td>
                                <td><h5>İplik No</h5></td>
                                <td><h5>Harf</h5></td>
                                <td><h5>İplik Cİnsi</h5></td>
                                <td><h5>Boya Cinsi</h5></td>
                                <td><h5>Renk No</h5></td>
                                <td><h5>Renk</h5></td>
                                <td><h5>Atkı S.</h5></td>
                                <td><h5>Çözgü S.</h5></td>
                                <td><h5>K.Tel S.</h5></td>
                                <td><h5>Tekrar</h5></td>
                                <td><h5>Boş Atkı S.</h5></td>
                                <td><h5>Aynı Ağıza Atılan A.S.</h5></td>
                                <td colspan="2"><h5></h5></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @isset($desen->patterndetail)
                        @foreach($desen->patterndetail as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->iplikseridi->name ?? ''}}</td>
                            <td>{{ $list->iplik_no }}/{{$list->iplik_kalin}}</td>
                            <td>{{ $list->harf}}</td>
                            <td>{{ $list->iplikcins->name }}</td>
                            <td>{{ $list->boyacins->name ?? ''}}</td>
                            <td>{{ $list->renk_no }}</td>
                            <td>{{ $list->renk }}</td>
                            <td>{{ $list->atki_sikligi }}</td>
                            <td>{{ $list->cozgu_sikligi }}</td>
                            <td>{{ $list->renk_sayisi }}</td>
                            <td>{{ $list->tekrar }}</td>
                            <td>{{ $list->bos_atki_sayisi }}</td>
                            <td>{{ $list->ayni_agiza_atilan_atki_sayisi }}</td>
                             <td>
                                 <a  href="{{route('patterndetail.edit',$list->id)}}"style="color:black" title="Düzenle"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('patterndetail.destroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>
                        @endforeach @endisset
                        <tr bgcolor="gray"><td colspan="17">&nbsp;</td></tr>
                        @isset($desenwarp->patterndetail)
                        @foreach($desenwarp->patterndetail as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->iplikseridi->name ?? ''}}</td>
                            <td>{{ $list->iplik_no }}/{{$list->iplik_kalin}}</td>
                            <td>{{ $list->harf}}</td>
                            <td>{{ $list->iplikcins->name }}</td>
                            <td>{{ $list->boyacins->name ?? ''}}</td>
                            <td>{{ $list->renk_no }}</td>
                            <td>{{ $list->renk }}</td>
                            <td>{{ $list->atki_sikligi }}</td>
                            <td>{{ $list->cozgu_sikligi }}</td>
                            <td>{{ $list->renk_sayisi }}</td>
                            <td>{{ $list->tekrar }}</td>
                            <td>{{ $list->bos_atki_sayisi }}</td>
                            <td>{{ $list->ayni_agiza_atilan_atki_sayisi }}</td>
                             <td>
                                 <a  href="{{route('patterndetail.edit',$list->id)}}"style="color:black" title="Düzenle"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('patterndetail.destroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>
                        @endforeach @endisset
                    </tbody>
                </table>

                <div class="card-header text-md-center">{{ __('Detaylı Renk Girişi') }}</div>
                    <form method="POST" action="{{route('patternwarpStore')}}">
                        @csrf
                        <input id="desen_id" name="desen_id" type="hidden" class="form-control" value="{{ $desen->id }}">
                        <div class="form-group row">
                            <label for="iplikseridi_id" class="col-md-2 col-form-label text-md-center" id="ip">{{ __('Çözgü/Atkı') }}</label>
                            <input type="hidden" class="desen" id="{{$desen->id}}">
                            <div class="col-md-2">
                                <select name='iplikseridi_id' id="iplikseridi_id" class="form-control @error('iplikseridi_id') is-invalid @enderror" required>
                                    @foreach ($iplikseridi as $list)
                                     @if(old('iplikseridi_id') == $list->id)
                                     <option value="{{$list->id}}" selected>{{$list->name}}</option>
                                    @else
                                    <option value="{{$list->id}}"  id="iplikseridi_id">{{$list->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('iplikseridi_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="harf" class="col-form-label text-md-right">{{ __('Renk') }}</label>

                            <div class="col-md-2">
                                <select name='harf' class="form-control  @error('harf') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                </select>
                                @error('harf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="sayi" class="col-form-label text-md-center">{{ __('Tel Sayısı') }}</label>

                            <div class="col-md-2">
                                <input id="sayi" type="text" class="form-control @error('sayi') is-invalid @enderror" name="sayi" autocomplete="sayi" autofocus>

                                @error('sayi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <button type="submit" name="ekle" class="btn btn-success">
                                    {{ __('Ekle') }}
                                </button>
                            </div>
                        </div>
                    </form>
                                <button name="guncelle" class="btn btn-success">
                                    {{ __('GÜNCELLE') }}
                                </button>
                    <table border="1" class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h5></h5></td>
                                <td><h5>İplik</h5></td>
                                <td><h5>İplik No</h5></td>
                                <td><h5>Harf</h5></td>
                                <td><h5>Tel Sayı</h5></td>
                                <td><h5>İplik Cİnsi</h5></td>
                                <td><h5>Boya Cinsi</h5></td>
                                <td><h5>Renk No</h5></td>
                                <td><h5>Renk</h5></td>
                                <td><h5>Atkı S.</h5></td>
                                <td><h5>Çözgü S.</h5></td>
                                <td><h5>Tekrar</h5></td>
                                <td><h5>Boş Atkı S.</h5></td>
                                <td><h5>Aynı Ağıza Atılan A.S.</h5></td>
                                <td colspan="2"><h5></h5></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody id="sortable"> 
                        @php $toplamatkitel=0;  @endphp
                        @isset($desen->patternwarp)
                        @foreach($desen->patternwarp as $list)
                        <tr id="item-{{$list->id}}">
                            <td id="sira{{$list->id}}">{{ $loop->iteration }}</td>
                            <td id="iplikseridi{{$list->id}}" class="{{$list->iplikseridi_id}} sortable">{{ $list->iplikseridi->name ?? ''}}</td>
                            <td>{{ $list->iplikno }}/{{$list->iplikkalin}}</td>
                            <td id="harf{{$list->id}}" class="{{$list->id}}">{{ $list->harf}}</td>
                            <td id="sayi{{$list->id}}">{{ $list->sayi }}</td>
                            <td>{{ $list->iplikcins->name ?? '' }}</td>
                            <td>{{ $list->boyacins->name ?? ''}}</td>
                            <td>{{ $list->renk_no }}</td>
                            <td>{{ $list->renk }}</td>
                            <td>{{ $list->atki_sikligi }}</td>
                            <td>{{ $list->cozgu_sikligi }}</td>
                            <td>{{ $list->tekrar }}</td>
                            <td>{{ $list->bos_atki_sayisi }}</td>
                            <td>{{ $list->ayni_agiza_atilan_atki_sayisi }}</td>
                             <td>
                                 <a style="color:black" title="Düzenle" id="{{$list->id}}" class="edit"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('patternwarpdelete', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>
                        @php $toplamatkitel += $list->sayi; @endphp
                        @endforeach @endisset
                         <tr><td colspan="5" class="text-md-right">Toplam Atkı Tel= @php echo $toplamatkitel;  @endphp </td>
                            <td colspan="12" class="text-md-right"></td></tr>
                        @php $toplamcozgutel=0;  @endphp
                        @isset($desenwarp->patternwarp)
                        @foreach($desenwarp->patternwarp as $list)
                        <tr id="item-{{ $list->id }}">
                            <td id="sira{{$list->id}}">{{ $loop->iteration }}</td>
                            <td id="iplikseridi{{$list->id}}" class="{{$list->iplikseridi_id}} sortable">{{ $list->iplikseridi->name ?? ''}}</td>
                            <td>{{ $list->iplikno }}/{{$list->iplikkalin}}</td>
                            <td id="harf{{$list->id}}" class="{{$list->id}}">{{ $list->harf}}</td>
                            <td id="sayi{{$list->id}}">{{ $list->sayi }}</td>
                            <td>{{ $list->iplikcins->name ?? '' }}</td>
                            <td>{{ $list->boyacins->name ?? ''}}</td>
                            <td>{{ $list->renk_no }}</td>
                            <td>{{ $list->renk }}</td>
                            <td>{{ $list->atki_sikligi }}</td>
                            <td>{{ $list->cozgu_sikligi }}</td>
                            <td>{{ $list->tekrar }}</td>
                            <td>{{ $list->bos_atki_sayisi }}</td>
                            <td>{{ $list->ayni_agiza_atilan_atki_sayisi }}</td>
                             <td>
                                 <a style="color:black" title="Düzenle" id="{{$list->id}}" class="edit"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('patternwarpdelete', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>
                        @php $toplamcozgutel += $list->sayi; @endphp
                        @endforeach @endisset
                        <tr><td colspan="5" class="text-md-right">Toplam Çözgü Tel = @php echo $toplamcozgutel;  @endphp </td>
                            <td colspan="12" class="text-md-right"></td></tr>
                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
    <!-- CSS -->
    <link rel="stylesheet" href="/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="/css/themes/default.min.css"/>
@endsection
@section('js')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="/js/alertify.min.js"></script>

<script type="text/javascript">
	
$( function() {
    $('button[name=guncelle').hide();

    function getHarf(id){
         var iplik = id;
        var id = $('.desen').attr('id');
        if(id){
            $.ajax({
             type:"get",
             url:'{{url('desen/patternwarp/js')}}/'+id+'/'+iplik, 
             success:function(res)
             {     var kayitSay = res.length;  
                if(kayitSay > 0)
                    {
                        $("select[name='harf").empty();
                         for (var i = 0; i < kayitSay; i++)
                            {
                                $("select[name='harf']").append('<option value="'+res[i].id+'">'+res[i].harf+'</option>');

                            };
                        }
                   }
               });
        }
    }

   
    $("select[name='iplikseridi_id']").bind("mouseenter change", function(){
        id= $(this).children("option:selected").val();
        getHarf(id);                 
    });

    $('.edit').click(function(){
        $(window).scrollTop(0);
         $('button[name=ekle').hide();   
         $('button[name=guncelle').show();
         id = $(this).attr('id');
         sira = $('#sira'+id).text();
         $('#ip').after('<label>').text('Sıra:'+sira).attr({id:id,name:'patternwarp_id'});
         iplikseridi = $('#iplikseridi'+id).text();
         iplikseridi_id = $('#iplikseridi'+id).attr('class');
         harf = $('#harf'+id).text();
         harf_id = $('#harf'+id).attr('class');
         sayi = $('#sayi'+id).text();
         $("select[name='iplikseridi_id']").children("option:selected").val(iplikseridi_id).text(iplikseridi);
         $("select[name='harf']").children("option:selected").val(harf_id).text(harf);
         $("input[name='sayi']").val(sayi);

    })
    $('button[name=guncelle]').click(function(){
         iplikseridi =$("select[name='iplikseridi_id']").children("option:selected").val();
        var id = $('.desen').attr('id');
        patternwarp_id= $("label[name='patternwarp_id']").attr('id');
         harf= $("select[name='harf']").children("option:selected").text();
         sayi=$("input[name='sayi']").val();
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            sayfa = '{{ route('patternwarpUpdate') }}';
            $.post(sayfa, {id:id,patternwarp_id:patternwarp_id,iplikseridi:iplikseridi,harf:harf,sayi:sayi}, function(data) {
               
            });
            location.reload(1500);
    });
    });


$( function() {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#sortable').sortable({
        revert: true,
        handle: ".sortable",
        stop: function (event, ui) {
            var data = $(this).sortable('serialize');
            $.ajax({
                type: "POST",
                data: data,
                url: "{{ route('patternwarpSortable') }}",
                success: function (msg) {
                    // console.log(msg);
                    if (msg) {
                        alertify.success("İşlem Başarılı");
                    } else
                    {
                        alertify.error("İşlem Başarısız");
                    }
                }
            });
        }
    });
    $('#sortable').disableSelection();
});

</script>
@endsection