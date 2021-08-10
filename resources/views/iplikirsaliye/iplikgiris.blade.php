@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">{{ __('İplik İrsaliye Bilgileri') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table  class="table">
                    <tr>
                        <td>
                            Sipariş No   : {{$iplikirsaliye->order->order_no  }}
                        </td>
                        <td>Firma    :{{ $iplikirsaliye->firma->name }}

                        </td>
                        <td>Firma Tipi    :{{ $iplikirsaliye->firmatipi->name }}

                        </td>
                        <td>Giriş Tarihi     :{{ $iplikirsaliye->gtrh }}
                        </td>
                        <td> İrsaliye No   :   {{ $iplikirsaliye->irsaliye_no }}
                        </td>
                        <td> Fatura No   :   {{ $iplikirsaliye->fatura_no }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">Açıklama   :    {{ $iplikirsaliye->aciklama }}
                        </td>
                    </tr>
                </table> 
                   @if($iplikirsaliye->firmatipi->name == 'BÜKÜM')
                 <div class="card-header">{{ __('Büküme Gönderilen İplikler') }}</div>
                <table border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td>Lot No</td>
                                <td>İplik Marka</td>
                                <td>İplik No-Ne</td>
                                <td>İplik Cinsi</td>
                                <td>Boya Cinsi</td>
                                <td>Renk No</td>
                                <td>Renk</td>
                                <td>Miktar</td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>  @foreach($iplikbukum as $a)
                        @foreach($a->iplikbukumdetail as $list)
                        <tr>
                             <td>{{ $list->iplikirsaliyedetail->partino ?? $list->iplikdepo->partino ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->iplikmarka ?? $list->iplikdepo->iplikmarka ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->iplikno ?? $list->iplikdepo->iplikno ?? ''}}/{{$list->iplikirsaliyedetail->ne ?? $list->iplikdepo->ne ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->iplikcins->name ?? $list->iplikdepo->iplikcins->name ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->boyacins->name ?? $list->iplikdepo->boyacins->name ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->renkno ?? $list->iplikdepo->renkno ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->renk ?? $list->iplikdepo->renk ?? ''}}</td>
                            <td>{{ $list->miktar ?? ''}}</td>
                        </tr>
                        @endforeach 
                        @endforeach 
                    </tbody>
                </table>
                        @endif
                <table class="table-sm">
                    <input id="iplikirsaliye_id" name="iplikirsaliye_id" type="hidden" class="form-control" value="{{ $iplikirsaliye->id }}">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>İplik Markası</td>
                                <td>Lot No</td>
                                <td>İplik Cinsi</td>
                                <td>Boya Cinsi</td>
                                <td>İplik No-Ne</td>
                                <td>Büküm Sayısı</td>
                                <td>Renk</td>
                                <td>Renk No</td>
                                <td>Renk2</td>
                                <td>Renk No2</td>
                                <td>Brüt Miktar</td>
                                <td>Birim</td>
                                <td>Miktar</td>
                                <td>
                                    <a  href="{{route('topluetiket',$iplikirsaliye->id)}}"style="color:black" title="TOPLU YAZDIR"><i class="fas fa-print fa-2x"></i></a>
                                </td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                   @if($iplikirsaliye->firmatipi->name == 'BÜKÜM')
                    @isset($iplikirsaliye->barcode_adet)
                        @for($i=1; $i <= $iplikirsaliye->barcode_adet; $i++)
                        <tr>
                             <td>
                                <label>{{$i}}</label>
                            </td>
                            <td>
                                <input id="iplikmarka{{$i}}" type="text" class="form-control @error('iplikmarka') is-invalid @enderror" name="iplikmarka" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('iplikmarka')->first() }}"  autocomplete="iplikmarka" autofocus>
                                <input id="iplikirsaliye_id" name="iplikirsaliye_id" type="hidden" class="form-control" value="{{ $iplikirsaliye->id }}">
                                <input id="iplikirsaliyedetail_id{{$i}}" name="iplikirsaliyedetail_id" type="hidden" class="form-control" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('id')->first() }}">
                            </td>
                            <td>
                                <input id="partino{{$i}}" type="text" class="form-control @error('partino') is-invalid @enderror" name="partino" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('partino')->first() }}"  autocomplete="partino" autofocus>
                            </td>
                            <td>
                                <select id="iplikcins_id{{$i}}" name='iplikcins_id' class="form-control  @error('iplikcins_id') is-invalid @enderror" >
                                    <option value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('iplikcins_id')->first() }}">{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('iplikcins.name')->first() }} </option>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($iplikcins as $list)
                                    <option value="{{$list->id}}" id="iplikcins_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="boyacins_id{{$i}}" name='boyacins_id' class="form-control  @error('boyacins_id') is-invalid @enderror" >
                                    <option value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('boyacins_id')->first() }}">{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('boyacins.name')->first() }} </option>
                                    @foreach ($boyacins as $list)
                                    <option value="{{$list->id}}" id="boyains_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td width="90">
                                <input id="iplikno{{$i}}" type="number" class="form-control @error('iplikno') is-invalid @enderror" value="{{$iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('iplikno')->first()}}" name="iplikno"  autocomplete="iplikno" autofocus>
                            </td>
                            <td width="90">
                                <input id="ne{{$i}}" type="number" class="form-control @error('ne') is-invalid @enderror" name="ne" value="{{$iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('ne')->first()}}"  autocomplete="ne" autofocus>
                            </td>
                            <td>
                                <input id="renk{{$i}}" type="text" class="form-control @error('renk') is-invalid @enderror" name="renk" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('renk')->first() }}"  autocomplete="renk" autofocus>
                            </td>
                            <td>
                                <input id="rno{{$i}}" type="text" class="form-control @error('rno') is-invalid @enderror" name="rno" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('renkno')->first() }}"  autocomplete="rno" autofocus>
                            </td>
                            <td width="90">
                                <input id="sim{{$i}}" type="text" class="form-control @error('sim') is-invalid @enderror" name="sim" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('renksim')->first() }}"  autocomplete="sim" autofocus>
                            </td>
                            <td width="90">
                                <input id="sno{{$i}}" type="text" class="form-control @error('sno') is-invalid @enderror" name="sno" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('renknosim')->first() }}"  autocomplete="sno" autofocus>
                            </td>
                             <td width="90"> 
                                <input id="brutmktr{{$i}}" type="number" class="form-control @error('brutmktr') is-invalid @enderror" name="brutmktr" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('brutmiktar')->first() }}"  autocomplete="brutmktr" autofocus>
                            </td>
                            <td><select id="unit_id{{$i}}" name='unit_id' class="form-control  @error('unit_id') is-invalid @enderror" >
                                    <option value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('unit_id')->first() }}">{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('unit.name')->first() }} </option>
                                    @foreach ($unit as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                             <td width="90"> <input id="miktar{{$i}}" type="number" class="form-control @error('miktar') is-invalid @enderror" name="miktar" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('miktar')->first() }}"  autocomplete="miktar" autofocus required>
                             </td> 
                             @if ($iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('id')->first())
                                <td>
                                    <a  href="{{route('etiket',$iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('id')->first())}}"style="color:black" title="YAZDIR"><i class="fas fa-print fa-1x"></i></a>
                                </td>
                                @endif
                           </tr>
                        @endfor
                        @endisset
                    @else
                        @isset($iplikirsaliye->barcode_adet)
                        @for($i=1; $i <= $iplikirsaliye->barcode_adet; $i++)
                        <tr>
                            <td>
                                <label>{{$i}}</label>
                            </td>
                            <td>
                                <input id="iplikmarka{{$i}}" type="text" class="form-control @error('iplikmarka') is-invalid @enderror" name="iplikmarka" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('iplikmarka')->first() }}"  autocomplete="iplikmarka" autofocus>
                                <input id="iplikirsaliye_id" name="iplikirsaliye_id" type="hidden" class="form-control" value="{{ $iplikirsaliye->id }}">
                                <input id="iplikirsaliyedetail_id{{$i}}" name="iplikirsaliyedetail_id" type="hidden" class="form-control" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('id')->first() }}">
                            </td>
                            <td>
                                <input id="partino{{$i}}" type="text" class="form-control @error('partino') is-invalid @enderror" name="partino" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('partino')->first() }}"  autocomplete="partino" autofocus>
                            </td>
                            <td>
                                <select id="iplikcins_id{{$i}}" name='iplikcins_id' class="form-control  @error('iplikcins_id') is-invalid @enderror" >
                                    <option value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('iplikcins_id')->first() }}">{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('iplikcins.name')->first() }} </option>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($iplikcins as $list)
                                    <option value="{{$list->id}}" id="iplikcins_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="boyacins_id{{$i}}" name='boyacins_id' class="form-control  @error('boyacins_id') is-invalid @enderror" >
                                    <option value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('boyacins_id')->first() }}">{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('boyacins.name')->first() }} </option>
                                    @foreach ($boyacins as $list)
                                    <option value="{{$list->id}}" id="boyains_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td width="90">
                                <input id="iplikno{{$i}}" type="number" class="form-control @error('iplikno') is-invalid @enderror" value="{{$iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('iplikno')->first()}}" name="iplikno"  autocomplete="iplikno" autofocus>
                            </td>
                            <td width="90">
                                <input id="ne{{$i}}" type="number" class="form-control @error('ne') is-invalid @enderror" name="ne" value="{{$iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('ne')->first()}}"  autocomplete="ne" autofocus>
                            </td>
                            <td>
                                <input id="renk{{$i}}" type="text" class="form-control @error('renk') is-invalid @enderror" name="renk" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('renk')->first() }}"  autocomplete="renk" autofocus>
                            </td>
                            <td>
                                <input id="rno{{$i}}" type="text" class="form-control @error('rno') is-invalid @enderror" name="rno" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('renkno')->first() }}"  autocomplete="rno" autofocus>
                            </td>
                            <td width="90">
                                <input id="sim{{$i}}" type="text" class="form-control @error('sim') is-invalid @enderror" name="sim" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('renksim')->first() }}"  autocomplete="sim" autofocus>
                            </td>
                            <td width="90">
                                <input id="sno{{$i}}" type="text" class="form-control @error('sno') is-invalid @enderror" name="sno" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('renknosim')->first() }}"  autocomplete="sno" autofocus>
                            </td>
                             <td width="90"> 
                                <input id="brutmktr{{$i}}" type="number" class="form-control @error('brutmktr') is-invalid @enderror" name="brutmktr" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('brutmiktar')->first() }}"  autocomplete="brutmktr" autofocus>
                            </td>
                            <td><select id="unit_id{{$i}}" name='unit_id' class="form-control  @error('unit_id') is-invalid @enderror" >
                                    <option value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('unit_id')->first() }}">{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('unit.name')->first() }} </option>
                                    @foreach ($unit as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                             <td width="90"> <input id="miktar{{$i}}" type="number" class="form-control @error('miktar') is-invalid @enderror" name="miktar" value="{{ $iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('miktar')->first() }}"  autocomplete="miktar" autofocus required>
                             </td> 
                             @if ($iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('id')->first())
                                <td>
                                    <a  href="{{route('etiket',$iplikirsaliye->iplikirsaliyedetail->where('sira',$i)->pluck('id')->first())}}"style="color:black" title="YAZDIR"><i class="fas fa-print fa-1x"></i></a>
                                </td>
                                @endif
                           </tr>
                        @endfor
                        @endisset
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript">
  
    $('input[name=iplikmarka],input[name=partino],input[name=iplikno],input[name=ne],input[name=renk],input[name=rno],input[name=sim],input[name=sno],input[name=brutmktr]').change(function(){
        var a   = $(this).attr('name');
        var val = $(this).val();
        id      = $(this).attr('id').substring(a.length);
        if (id == 1) {
            $('input[name*=' + a + ']').val(val);
        }
    });

    $('select[name=iplikcins_id], select[name=boyacins_id], select[name=unit_id]').change(function(){
       
        var a= $(this).attr('name');
        var val= $(this).val();
        id= $(this).attr('id').substring(a.length);
        var c= $('#'+a+id+' option:selected').val();
        if (id==1){
                $("select[name*="+a+"] option[value="+c+"]").attr('selected', 'selected');
            }
    })

     $('input[id*=miktar],input[id*=iplikmarka],input[id*=partino],select[id*=iplikcins_id],select[id*=boyacins_id],input[id*=iplikno],input[id*=ne],input[id*=renk],input[id*=rno],input[id*=sim],input[id*=sno],input[id*=brutmktr],select[id*=unit_id]').change(function(){
        $(this).toggle( "highlight" );
        var val= $(this).val(); 
        var a=$(this).attr('name');
        id = $(this).attr('id').substring(a.length);
        var iplikmarka = $('#iplikmarka'+id).val();
        var partino = $('#partino'+id).val();
        var iplikcins_id = $('#iplikcins_id'+id).val();
        var boyacins_id = $('#boyacins_id'+id).val();
        var iplikno = $('#iplikno'+id).val();
        var ne = $('#ne'+id).val();
        var renk = $('#renk'+id).val();
        var rno = $('#rno'+id).val();
        var sim = $('#sim'+id).val();
        var sno= $('#sno'+id).val();
        var brutmktr = $('#brutmktr'+id).val();
        var unit_id = $('#unit_id'+id).val();
        var iplikirsaliye_id = $('#iplikirsaliye_id').val();
        var iplikirsaliyedetail_id = $('#iplikirsaliyedetail_id'+id).val();
        //alert(iplikirsaliyedetail_id+' '+iplikmarka+' '+partino+' '+iplikcins_id+' '+boyacins_id+' '+iplikno+' '+ne+' '+renk+' '+rno+' '+brutmktr+' '+unit_id+' '+val);
         //$( "input[id][name$='man']" ).val( "only this one" ); mutiple attribute
            $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            sayfa = '{{ route('iplikgirisdetail') }}';
            $.post(sayfa, {iplikmarka: iplikmarka,partino:partino,iplikcins_id:iplikcins_id,boyacins_id:boyacins_id ,iplikno:iplikno,ne:ne,renk:renk,rno:rno,brutmktr:brutmktr, unit_id:unit_id,iplikirsaliye_id:iplikirsaliye_id,miktar:val,sira:id,iplikirsaliyedetail_id:iplikirsaliyedetail_id ,rs:sno,sim:sim}, function(data) {
                $("#"+a+id).toggle( "highlight" );
            });
     });
</script>
@endsection