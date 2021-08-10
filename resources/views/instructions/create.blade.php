@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">{{ __('Talimat Formu') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table class="table" border="2"> 
                    <tr>
                        <td>
                            <label>{{ __('Desen Adı:  ') }}{{ $order->desen->name }}</label>    
                        </td>
                        <td>
                            <label >{{ __('Desen No:  ') }}{{ $order->desen->no }}</label> 
                        </td>
                        <td>    
                            <label >{{ __('CTS:  ') }}{{ $order->desen->cts }}</label> 
                        </td>
                        <td>   
                            <label >{{ __('Çözgü Sıklığı:  ') }}{{ $order->desen->cozgu_sikligi }}</label>
                        </td>
                        <td>    
                            <label >{{ __('Tarak Eni  :  ') }}{{ $order->desen->tarak_eni }}</label>  
                            <input type="hidden" id="ten" value="{{$order->desen->tarak_eni}}">
                        </td>
                        <td>   
                           <label >{{ __('Tarak No  :  ') }}{{ $order->desen->tarak.'*'.$order->desen->tarak_no }}</label>
                       </td>
                   </tr>
                  
    </table>
    <div class="card-header">{{ __('İplik Bilgileri') }}</div>

                <table border="1" class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h6></h6></td>
                                <td><h6>İplik</h6></td>
                                <td><h6>İplik No</h6></td>
                                <td><h6>Harf</h6></td>
                                <td><h6>T.Tel Sayısı</h6></td>
                                <td><h6>İplik Cİnsi</h6></td>
                                <td><h6>Boya Cinsi</h6></td>
                                <td><h6>Atkı S.</h6></td>
                                <td><h6>Çözgü S.</h6></td>
                                <td><h6>Renk No</h6></td>
                                <td><h6>Renk</h6></td>
                                <td><h6>K.Tel S.</h6></td>
                                <td><h6>Tekrar</h6></td>
                                <td><h6>Boş Atkı S.</h6></td>
                                <td><h6>Aynı Ağıza Atılan A.S.</h6></td>
                                <td><h6>Fire(%)</h6></td>
                                <td><h6>Boya Fire(%)</h6></td>
                                <td><h6>Çözgü Metrajı</h6></td>
                                <td><h6>Net KG</h6></td>
                                <td><h6>Kazana Girecek KG</h6></td>
                                <td><h6>M.Tül Gr.</h6></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @php  $no=null; @endphp
                        @isset($order->desen->patterndetail)
                        @foreach($order->desen->patterndetail as $list)
                        <tr>
                            <td id="sayac{{$list->id}}">{{ $loop->iteration }}</td>
                            <td id="iplik{{$list->id}}">{{ $list->iplikseridi->name }}</td>
                            <td id="ne{{$list->id}}" name="{{$list->iplik_no}}" class="{{$list->iplik_kalin}}">{{ $list->iplik_no.'/'.$list->iplik_kalin}}</td>
                            <td>{{ $list->harf}}</td>
                            <td id="tel{{$list->id}}"> 
                                @foreach($list->patternwarp as $asd)
                                    @php  $patterndetail_id=$asd->patterndetail_id; @endphp
                                  @if ($loop->first > 0 && $no != $asd->patterndetail_id)
                                    @include ('instructions.sumwire', compact('asd', 'patterndetail_id'))
                                  @endif
                                @endforeach
                            </td>
                            <td>{{ $list->iplikcins->name }}</td>
                            <td>{{ $list->boyacins->name ?? ''}}</td>
                            <td id="asik{{$list->id}}">{{ $list->atki_sikligi }}</td>
                            <td>{{ $list->cozgu_sikligi }}</td>
                            <td>{{ $list->renk_no }}</td>
                            <td>{{ $list->renk }}</td>
                            <td>{{ $list->renk_sayisi }}</td>
                            <td>{{ $list->tekrar }}</td>
                            <td>{{ $list->bos_atki_sayisi }}</td>
                            <td>{{ $list->ayni_agiza_atilan_atki_sayisi }}</td>
                            <td> <input id="cozguhasilfire{{$list->id}}" type="text" class="form-control @error('cozguhasilfire') is-invalid @enderror" name="cozguhasilfire" value="{{ $list->instructions->cozguhasilfire ?? ''}}" size="5" autocomplete="cozguhasilfire" autofocus></td>
                            <td> <input id="iplikboyafire{{$list->id}}" type="text" class="form-control @error('iplikboyafire') is-invalid @enderror" name="iplikboyafire" value="{{ $list->instructions->iplikboyafire ?? ''}}" size="5" autocomplete="iplikboyafire" autofocus></td>
                            <input type="hidden" id="desen" class="{{$list->desen_id}}">
                            <input type="hidden" id="order" class="{{$order->id}}">
                            <td> <input id="cozgumetraji{{$list->id}}" type="text" class="form-control @error('cozgumetraji') is-invalid @enderror" name="cozgumetraji" value="{{ $list->instructions->cozgumetraji ?? ''}}" size="5"  autocomplete="cozgumetraji" autofocus></td>
                            <td><input type="text" value="@isset($list->instructions->netkg){{number_format($list->instructions->netkg,3) }}@endisset" id="netkg{{$list->id}}" class="form-control" name="netkg" disabled size="8" > </td>
                            <td><input type="text" value="@isset($list->instructions->kazankg){{number_format($list->instructions->kazankg,3) }}@endisset" id="kazankg{{$list->id}}" class="form-control" name="kazankg" disabled size="8"> </td>
                            <td><input type="text" value="@isset($list->instructions->mtulgr){{number_format($list->instructions->mtulgr,3) }}@endisset" id="mtulgr{{$list->id}}" class="form-control" name="mtulgr" disabled size="8"> </td>
                        </tr>
                        @endforeach @endisset
                    </tbody>
                </table>
                @isset($asd)
                    <input type="hidden" id="sumwarp" value="{{$asd->where('desen_id',$list->desen_id)->where('iplikseridi_id',2)->sum('sayi') ?? ''}}">
                    <input type="hidden" id="sumweft"value="{{$asd->where('desen_id',$list->desen_id)->where('iplikseridi_id',1)->sum('sayi') ?? ''}}">
                    @endisset
</div>
</div>
</div>
</div>
@endsection
@section('css')
<style type="text/css">
   table, th, td {
  text-align: center;
}
</style>
@endsection
@section('js')
<script type="text/javascript">
    $(function(){
        $('input').change(function(){
            $(this).toggle( "highlight" );
             a = $(this).attr('name');
             id = $(this).attr('id').substring(a.length);
             desen_id= $('#desen').attr('class');
             sumweft=$('#sumweft').val();
             sumwarp=$('#sumwarp').val();
             order_id= $('#order').attr('class');
             fire = $('#cozguhasilfire'+id).val();
             boyafire = $('#iplikboyafire'+id).val();
             metraj = $('#cozgumetraji'+id).val();
            iplik = $('#iplik'+id).text();
            ten = $('#ten').val();
            asik = $('#asik'+id).text();
            var ne = $('#ne'+id).attr('class');
            var no = $('#ne'+id).attr('name');
             tel = $('#tel'+id).text();
             if (ne > 0 && iplik=='ÇÖZGÜ')
             {
                var gr= (tel/(no/ne))/1.693;
                var netkg = metraj*(gr/1000)*((fire/100)+1);
                var kazankg= netkg*(boyafire/100+1);
                $('#mtulgr'+id).val(gr.toFixed(3))
                $('#netkg'+id).val(netkg.toFixed(3));
                $('#kazankg'+id).val(kazankg.toFixed(3));   
             }
             else if (ne > 0 && iplik=='ATKI')
             {
                var gr= (parseInt(ten)+10)/100*(asik*100)/(no/ne)/1.693/(asik*100)*((tel/sumweft)*(asik*100));
                var netkg = metraj*(gr/1000)*(fire/100+1);
                var kazankg= netkg*(boyafire/100+1);
                $('#mtulgr'+id).val(gr.toFixed(3));
                $('#netkg'+id).val(netkg.toFixed(3));
                $('#kazankg'+id).val(kazankg.toFixed(3));
             }
             else if (ne =='' && iplik=='ÇÖZGÜ')
             {
                var gr= (no/9000)*tel;
                var netkg = metraj*(gr/1000)*(fire/100+1);
                var kazankg= netkg*(boyafire/100+1);
                $('#mtulgr'+id).val(gr.toFixed(3));
                $('#netkg'+id).val(netkg.toFixed(3));
                $('#kazankg'+id).val(kazankg.toFixed(3));  
             }
             else if (ne =='' && iplik=='ATKI')
             {
                var gr= ((parseInt(ten)+10)/100)*(asik*100)*no/9000/(asik*100)*((tel/sumweft)*(asik*100));
                var netkg = metraj*(gr/1000)*(fire/100+1);
                var kazankg= netkg*(boyafire/100+1);
                $('#mtulgr'+id).val(gr.toFixed(3));
                $('#netkg'+id).val(netkg.toFixed(3));
                $('#kazankg'+id).val(kazankg.toFixed(3));
             }
            $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            sayfa = '{{ route('instructions.store') }}';
            deger = $(this).val();
            $.post(sayfa, {patterndetail_id: id,order_id:order_id,tel:tel,desen_id:desen_id ,alan:a,deger: deger,gr:gr,netkg:netkg,kazankg:kazankg}, function(data) {
                $("#"+a+id).toggle( "highlight" );
            });
        });
    });
</script>
@endsection