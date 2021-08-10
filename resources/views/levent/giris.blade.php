@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">{{ __('Levent Giriş Bilgileri') }}</div>

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
                        <td>Firma    :{{ $leventirsaliye->firma->name }}

                        </td>
                        <td>Firma Tipi    :{{ $leventirsaliye->firmatipi->name }}

                        </td>
                        <td>Giriş Tarihi     :{{ $leventirsaliye->gtrh }}
                        </td>
                        <td> İrsaliye No   :   {{ $leventirsaliye->irsaliye_no }}
                        </td>
                        <td> Fatura No   :   {{ $leventirsaliye->fatura_no }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">Açıklama   :    {{ $leventirsaliye->aciklama }}
                        </td>
                    </tr>
                </table> 
                <table class="table-sm">
                    <input id="leventirsaliye_id" name="leventirsaliye_id" type="hidden" class="form-control" value="{{ $leventirsaliye->id }}">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>Stok Mu?</td>
                                @if($leventirsaliye->firmatipi->name == 'ÇÖZGÜ')<td>Çözgü Talimat No</td> @else <td>Sipariş No</td> @endif
                                <td>Levent No</td>
                                <td>Tel Sayısı</td>
                                <td>Levent Eni</td>
                                <td>Metraj</td>
                                <td>KG</td>
                                <td>Fiyat</td>
                                <td>Döviz Cinsi</td>
                                <td>Açıklama</td>
                                <td>
                                    <a  href="{{route('leventtoplugirisetiket',$leventirsaliye->id)}}"style="color:black" title="TOPLU YAZDIR"><i class="fas fa-print fa-2x"></i></a>
                                </td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($leventirsaliye->barcode_adet)
                        @for($i=1; $i <= $leventirsaliye->barcode_adet; $i++)
                        <tr>
                            <td>
                                <label>{{$i}}</label>
                            </td> 
                            <td>
                                    <input type="checkbox" class="form-control" id="stok{{$i}}" name="stok" @if ($leventirsaliye->leventhareket->where('no',$i)->pluck('stok')->first()== 1) checked="" @endif>
                            </td>
                            @if($leventirsaliye->firmatipi->name == 'ÇÖZGÜ') 
                            <td>
                                <select id="cozgu_id{{$i}}" name='cozgu_id' class="form-control  @error('cozgu_id') is-invalid @enderror" >
                                    <option value="{{ $leventirsaliye->leventhareket->where('no',$i)->pluck('cozgu_id')->first()  }}">{{ $leventirsaliye->leventhareket->where('no',$i)->pluck('cozgu.no')->first() }} </option>
                                    @foreach ($cozgu as $list)
                                    <option value="{{$list->id}}">{{$list->no}}</option>
                                    @endforeach
                                </select>
                            </td>
                            @else
                            @if($leventirsaliye->leventhareket->where('no',$i)->pluck('stok')->first()!= 1)
                            <td>
                                <select id="order_id{{$i}}" name='order_id' class="form-control  @error('order_id') is-invalid @enderror" >
                                    <option value="{{ $leventirsaliye->leventhareket->where('no',$i)->pluck('order_id')->first()  }}">{{ $leventirsaliye->leventhareket->where('no',$i)->pluck('order.order_no')->first() }} </option>
                                    @foreach ($order as $list)
                                    <option value="{{$list->id}}">{{$list->order_no}}</option>
                                    @endforeach
                                </select>
                            </td>
                            @else <td></td>
                            @endif
                             @endif
                             <td width="90">
                                <input id="leventno{{$i}}" type="number" class="form-control @error('leventno') is-invalid @enderror" value="{{$leventirsaliye->leventhareket->where('no',$i)->pluck('leventno')->first() }}" name="leventno"  autocomplete="leventno" autofocus>
                            </td>
                             <td width="90">
                                <input id="telsayi{{$i}}" type="number" class="form-control @error('telsayi') is-invalid @enderror" value="{{$leventirsaliye->leventhareket->where('no',$i)->pluck('telsayi')->first() }}" name="telsayi"  autocomplete="telsayi" autofocus>
                            </td>
                             <td width="90">
                                <input id="leventeni{{$i}}" type="number" class="form-control @error('leventeni') is-invalid @enderror" value="{{$leventirsaliye->leventhareket->where('no',$i)->pluck('leventeni')->first()}}" name="leventeni"  autocomplete="leventeni" autofocus>
                            </td>
                            <td width="90">
                                <input id="metraj{{$i}}" type="number" class="form-control @error('metraj') is-invalid @enderror" value="{{$leventirsaliye->leventhareket->where('no',$i)->pluck('metraj')->first()}}" name="metraj"  autocomplete="metraj" autofocus>
                            </td>
                             <td width="90">
                                <input id="kg{{$i}}" type="number" class="form-control @error('kg') is-invalid @enderror" value="{{$leventirsaliye->leventhareket->where('no',$i)->pluck('kg')->first()}}" name="kg"  autocomplete="kg" autofocus>
                            </td>
                             <td width="90">
                                <input id="fiyat{{$i}}" type="number" class="form-control @error('fiyat') is-invalid @enderror" value="{{$leventirsaliye->leventhareket->where('no',$i)->pluck('fiyat')->first()}}" name="fiyat"  autocomplete="fiyat" autofocus>
                            </td>
                            <td>
                                <select id="kur_id{{$i}}" name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror" >
                                    <option value="{{ $leventirsaliye->leventhareket->where('no',$i)->pluck('kur_id')->first() }}">{{$leventirsaliye->leventhareket->where('no',$i)->pluck('kur.name')->first() }} </option>
                                    @foreach ($kur as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <textarea id="aciklama{{$i}}" class="form-control  @error('aciklama') is-invalid @enderror" name="aciklama" rows="1">{{$leventirsaliye->leventhareket->where('no',$i)->pluck('aciklama')->first()}}</textarea>
                            </td>
                            @if ($leventirsaliye->leventhareket->where('no',$i)->pluck('id')->first())
                                <td>
                                    <a  href="{{route('leventgirisetiket',$leventirsaliye->leventhareket->where('no',$i)->pluck('id')->first())}}"style="color:black" title="YAZDIR"><i class="fas fa-print fa-1x"></i></a>
                                </td>
                                @endif
                           </tr>
                        @endfor
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript">
   
$('input[name=telsayi],input[name=leventeni],input[name=leventno]').change(function(){
        var a= $(this).attr('name');
        var val= $(this).val();
        id = $(this).attr('id').substring(a.length);
        if (id==1){
                $('input[name*='+a+']').val(val);
            }
    });
$('input[name=stok]').change(function(){
        var a= $(this).attr('name');
        var val= $(this).is(":checked");
        id = $(this).attr('id').substring(a.length);
        if (id==1){
                $('input[name*='+a+']').attr('checked',val);
            }
            if(val == true)$('select[id=order_id'+id+']').hide();    
            else $('select[id=order_id'+id+']').show();    
    });
 $('select[name=cozgu_id],select[name=order_id],select[name=kur_id]').change(function(){
        var a= $(this).attr('name');
        var val= $(this).val();
        id= $(this).attr('id').substring(a.length);
        //alert(id);
        //var b= $('#'+a+id+' option:selected').text();
        var c= $('#'+a+id+' option:selected').val();
        if (id==1){
                //$('select[id*=]+a').append('<option value="'+a+'">'+b+'</option>');
                $("select[name*="+a+"] option[value="+c+"]").attr('selected', 'selected');
            }
    })

     $('select[id*=cozgu_id],select[id*=order_id],input[id*=telsayi],input[name=leventno],input[id*=leventeni],input[id*=metraj],input[id*=kg],input[id*=fiyat],select[id*=kur_id],input[id*=stok],textarea[id*=aciklama]').change(function(){
        $(this).toggle( "highlight" );
        var a=$(this).attr('name');
        id = $(this).attr('id').substring(a.length);
        var cozgu_id = $('#cozgu_id'+id).val();
        var order_id = $('#order_id'+id).val();
        var leventno = $('#leventno'+id).val();
        var telsayi = $('#telsayi'+id).val();
        var leventeni = $('#leventeni'+id).val();
        var metraj = $('#metraj'+id).val();
        var kg = $('#kg'+id).val();
        var fiyat = $('#fiyat'+id).val();
        var kur_id = $('#kur_id'+id).val();
        if($('#stok'+id).is(":checked")== true)  stok = 1; else  var stok=0;
        var aciklama = $('#aciklama'+id).val();
        var leventirsaliye_id = $('#leventirsaliye_id').val();
        //alert(leventirsaliye_id+' '+aciklama+' '+kur_id+' '+fiyat+' '+kg+' '+metraj+' '+leventeni+' '+telsayi+' '+cozgu_id+' '+id);
           $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            sayfa = '{{ route('leventgirisdetail') }}';
            $.post(sayfa, {order_id:order_id,leventirsaliye_id:leventirsaliye_id,cozgu_id:cozgu_id,no:id,telsayi:telsayi ,leventno:leventno,leventeni:leventeni,metraj:metraj,kg:kg,fiyat:fiyat,kur_id:kur_id,stok:stok,aciklama:aciklama}, function(data) {
                $("#"+a+id).toggle( "highlight" );
            });
     });

</script>
@endsection