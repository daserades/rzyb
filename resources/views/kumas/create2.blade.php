@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">{{ __('Kumas Detay Bilgileri') }}</div>

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
                        <td>Firma    :{{ $kumas->firma->name }}

                        </td>
                        <td>Top Adeti     :{{ $kumas->adet }}
                        </td>
                        <td> İrsaliye No   :   {{ $kumas->irsaliye_no }}
                        </td>
                        <td> Fatura No   :   {{ $kumas->fatura_no }}
                        </td>
                    </tr>
                </table> 
                  
                <table class="table-sm">
                    <input id="kumas_id" name="kumas_id" type="hidden" class="form-control" value="{{ $kumas->id }}">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>Sipariş No</td>
                                <td>Metre</td>
                                <td>Mamul En</td>
                                <td>Fiyat</td>
                                <td>Döviz Cinsi</td>
                                <td>
                                    <a  href="{{route('kumassticker',$kumas->id)}}"style="color:black" title="TOPLU YAZDIR"><i class="fas fa-print fa-2x"></i></a>
                                </td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                  
                        @isset($kumas->adet)
                        @for($i=1; $i <= $kumas->adet; $i++)
                        <tr>
                            <td>
                                <label>{{$i}}</label>
                            </td>
                            <td>
                                <select id="order_id{{$i}}" name='order_id' class="form-control  @error('order_id') is-invalid @enderror" >
                                    <option value="{{ $kumas->kumasdetail->where('type',$i)->pluck('order_id')->first() }}">{{ $kumas->kumasdetail->where('type',$i)->pluck('order.order_no')->first() }} </option>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($order as $list)
                                    <option value="{{$list->id}}">{{$list->order_no}}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input id="metre{{$i}}" type="number" class="form-control @error('metre') is-invalid @enderror" name="metre" value="{{ $kumas->kumasdetail->where('type',$i)->pluck('metre')->first() }}"  autocomplete="metre" autofocus>
                                <input id="kumas_id" name="kumas_id" type="hidden" class="form-control" value="{{ $kumas->id }}">
                                <input id="kumasdetail_id{{$i}}" name="kumasdetail_id" type="hidden" class="form-control" value="{{ $kumas->kumasdetail->where('type',$i)->pluck('id')->first() }}">
                            </td>
                            <td>
                                <input id="mamulen{{$i}}" type="number" class="form-control @error('mamulen') is-invalid @enderror" name="mamulen" value="{{ $kumas->kumasdetail->where('type',$i)->pluck('mamulen')->first() }}"  autocomplete="mamulen" autofocus>
                            </td>
                            <td width="90">
                                <input id="fiyat{{$i}}" type="number" class="form-control @error('fiyat') is-invalid @enderror" value="{{$kumas->kumasdetail->where('type',$i)->pluck('fiyat')->first()}}" name="fiyat"  autocomplete="fiyat" autofocus>
                            </td>
                            <td><select id="kur_id{{$i}}" name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror" >
                                    <option value="{{ $kumas->kumasdetail->where('type',$i)->pluck('kur_id')->first() }}">{{ $kumas->kumasdetail->where('type',$i)->pluck('kur.name')->first() }} </option>
                                    @foreach ($kur as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td> 
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
@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
$( function() {
    $('select[name=order_id]').select2({ width: '350px' });
});
  //input[name=metre],
    $('input[name=mamulen],input[name=fiyat]').change(function(){
        var a   = $(this).attr('name');
        var val = $(this).val();
        id      = $(this).attr('id').substring(a.length);
        if (id == 1) {
            $('input[name*=' + a + ']').val(val);
        }
    });

    $('select[name=order_id], select[name=kur_id]').change(function(){
       
        var a= $(this).attr('name');
        var val= $(this).val();
        id= $(this).attr('id').substring(a.length);
        var c= $('#'+a+id+' option:selected').val();
        if (id==1){
                $("select[name*="+a+"] option[value="+c+"]").attr('selected', 'selected');
            }
    })

     $('input[id*=metre],input[id*=mamulen],select[id*=order_id],select[id*=kur_id],input[id*=fiyat]').change(function(){
        $(this).toggle( "highlight" );
        var val= $(this).val(); 
        var a=$(this).attr('name');
        id = $(this).attr('id').substring(a.length);
        var metre = $('#metre'+id).val();
        var mamulen = $('#mamulen'+id).val();
        var order_id = $('#order_id'+id).val();
        var kur_id = $('#kur_id'+id).val();
        var fiyat = $('#fiyat'+id).val();
        var kumas_id = $('#kumas_id').val();
        var kumasdetail_id = $('#kumasdetail_id'+id).val();
        //alert(kumasdetail_id+' '+metre+' '+mamulen+' '+order_id+' '+kur_id+' '+fiyat+' '+ne+' '+renk+' '+rno+' '+brutmktr+' '+unit_id+' '+val);
         //$( "input[id][name$='man']" ).val( "only this one" ); mutiple attribute
            $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            sayfa = '{{ route('kumasstore2') }}';
            $.post(sayfa, {metre: metre,mamulen:mamulen,order_id:order_id,kur_id:kur_id ,fiyat:fiyat,kumas_id:kumas_id,type:id,kumasdetail_id:kumasdetail_id}, function(data) {
                $("#"+a+id).toggle( "highlight" );
            });
     });
</script>
@endsection