@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">{{ __('Boya Talimatı') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table border="1">
                    <tr>
                        <td>
                            Talimat No  :{{$iplikboya->no}}
                        </td>
                        <td>
                            Firma   : {{$iplikboya->firma->name ?? ''}}
                        </td>
                        <td>
                            Sipariş No   : {{$iplikboya->order->order_no ?? ''}}
                        </td>
                        <td> Açıklama   :  {{ $iplikboya->aciklama }}
                        </td>
                        
                    </tr>
                </table> 
                <div class="card-header">{{ __('Talimat Bilgileri') }}  </div> 
                <form method="POST" action="#">
                    @csrf
                          <table class="table table-striped table-sm table-hover" border="1">
                           <thead>
                            <th>ÇÖZGÜ</th>
                            <th>İplik No/Ne</th>
                            <th>Renk No</th>
                            <th>Renk Adı</th>
                            <th>Boyanan İplik KG</th>
                            <th>G.İplik KG</th>
                            <th>Miktar</th>
                            <th>Fiyat</th>
                            <th>D.Cinsi</th>
                            <th>Açıklama</th>
                        </thead>
                        <tbody>
                            @foreach($order->orderdetailwarp as $list)
                            <tr>
                                <td>{{$list->sira}}</td>
                                <td>{{$list->cinsne}}</td>
                                <td>{{$list->crenkno}}</td>
                                <td>{{$list->crenk}}</td>
                                <td>{{$list->boyanankg}}</td>
                                <td>{{$list->gelenkg}}</td>
                                <td>
                                    <input id="iplikboya_id" name="iplikboya_id" type="hidden" class="form-control" value="{{ $iplikboya->id }}">
                                    <input id="iplikseridi_id{{$list->id}}" name="iplikseridi_id" type="hidden" class="form-control" value="2">
                                        <input id="miktar{{$list->id}}" type="number" step="0.001" class="form-control @error('miktar') is-invalid @enderror" name="miktar" value="{{ $iplikboyadetail->where('orderdetail_id',$list->id)->where('iplikboya_id',$iplikboya->id)->where('iplikseridi_id',2)->pluck('miktar')->first() }}" placeholder="Miktar Giriniz"  autocomplete="miktar" autofocus>
                                </td>
                                <td>
                                    <input id="fiyat{{$list->id}}" type="number" step="0.001" class="form-control @error('fiyat') is-invalid @enderror" name="fiyat" value="{{ $iplikboyadetail->where('orderdetail_id',$list->id)->where('iplikboya_id',$iplikboya->id)->where('iplikseridi_id',2)->pluck('fiyat')->first() }}" placeholder="Fiyat Giriniz"  autocomplete="fiyat" autofocus>
                                </td>
                                <td>
                                     <select name='kur_id' id="kur_id{{$list->id}}">
                                        <option value="{{ $iplikboyadetail->where('orderdetail_id',$list->id)->where('iplikboya_id',$iplikboya->id)->where('iplikseridi_id',2)->pluck('kur_id')->first() }}">{{ $iplikboyadetail->where('orderdetail_id',$list->id)->where('iplikboya_id',$iplikboya->id)->where('iplikseridi_id',2)->pluck('kur.name')->first() }}</option>
                                        @foreach ($kur as $liste)
                                        <option value="{{$liste->id}}">{{$liste->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <textarea id="aciklama{{$list->id}}" type="text" class="form-control"  name="aciklama" rows="1" autocomplete="aciklama" autofocus>{{ $iplikboyadetail->where('orderdetail_id',$list->id)->where('iplikboya_id',$iplikboya->id)->where('iplikseridi_id',2)->pluck('aciklama')->first() }}
                                    </textarea>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table border="1" class="table table-striped table-sm table-hover">
                     <thead>
                        <th>ATKI</th>
                        <th>İplik No/Ne</th>
                        <th>Renk No</th>
                        <th>Renk Adı</th>
                        <th>Boyanan İplik KG</th>
                        <th>G.İplik KG</th>
                        <th>Atkı Sıklık</th>
                        <th>Miktar</th>
                        <th>Fiyat</th>
                        <th>D.Cinsi</th>
                        <th>Açıklama</th>
                    </thead>
                    <tbody>
                        @foreach($order->orderdetailweft as $list)
                        <tr>
                            <td>{{$list->sira}}</td>
                            <td>{{$list->acinsne}}</td>
                            <td>{{$list->arenkno}}</td>
                            <td>{{$list->arenk}}</td>
                            <td>{{$list->aboyanankg}}</td>
                            <td>{{$list->agelenkg}}</td>
                            <td>{{$list->asiklik}}</td>
                            <td>
                                    <input id="iplikboya_id" name="iplikboya_id" type="hidden" class="form-control" value="{{ $iplikboya->id }}">
                                    <input id="iplikseridi_id{{$list->id}}" name="iplikseridi_id" type="hidden" class="form-control" value="1">
                                        <input id="miktar{{$list->id}}" type="number" step="0.001" class="form-control @error('miktar') is-invalid @enderror" name="miktar" value="{{ $iplikboyadetail->where('orderdetail_id',$list->id)->where('iplikboya_id',$iplikboya->id)->where('iplikseridi_id',1)->pluck('miktar')->first() }}" placeholder="Miktar Giriniz"  autocomplete="miktar" autofocus>
                                </td>
                                <td>
                                    <input id="fiyat{{$list->id}}" type="number" step="0.001" class="form-control @error('fiyat') is-invalid @enderror" name="fiyat" value="{{ $iplikboyadetail->where('orderdetail_id',$list->id)->where('iplikboya_id',$iplikboya->id)->where('iplikseridi_id',1)->pluck('fiyat')->first() }}" placeholder="Fiyat Giriniz"  autocomplete="fiyat" autofocus>
                                </td>
                                <td>
                                     <select name='kur_id' id="kur_id{{$list->id}}">
                                        <option value="{{ $iplikboyadetail->where('orderdetail_id',$list->id)->where('iplikboya_id',$iplikboya->id)->where('iplikseridi_id',1)->pluck('kur_id')->first() }}">{{ $iplikboyadetail->where('orderdetail_id',$list->id)->where('iplikboya_id',$iplikboya->id)->where('iplikseridi_id',1)->pluck('kur.name')->first() }}</option>
                                        @foreach ($kur as $liste)
                                        <option value="{{$liste->id}}">{{$liste->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <textarea id="aciklama{{$list->id}}" type="text" class="form-control"  name="aciklama" rows="1" autocomplete="aciklama" autofocus>{{ $iplikboyadetail->where('orderdetail_id',$list->id)->where('iplikboya_id',$iplikboya->id)->where('iplikseridi_id',1)->pluck('aciklama')->first() }} </textarea>
                                </td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
           
</form>
</div>
</div>
</div>
</div>

@endsection
@section('css')
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
@endsection
@section('js')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
<script type="text/javascript">
    $( function() {
        //$('#iplikdepo_id').select2({ width: '300px' });
       // $('#order_id,#iplikseridi_id,#kur_id').select2({ width: '140px' });
    });
    $('input[id*=miktar],input[id*=fiyat],select[id*=kur_id],textarea[id*=aciklama]').change(function(){
        $(this).toggle( "highlight" );
        var a=$(this).attr('name');
        var id = $(this).attr('id').substring(a.length);
        var miktar = $('#miktar'+id).val();
        var fiyat = $('#fiyat'+id).val();
        var kur_id = $('#kur_id'+id).val();
        var iplikboya_id = $('#iplikboya_id').val();
        var aciklama = $('#aciklama'+id).val();
        var iplikseridi_id = $('#iplikseridi_id'+id).val();
            $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            sayfa = '{{route('boyastore2')}}';
            $.post(sayfa, {fiyat:fiyat,miktar:miktar,kur_id:kur_id,orderdetail_id:id,iplikboya_id:iplikboya_id,aciklama:aciklama,iplikseridi_id:iplikseridi_id}, function(data) {
                $("#"+a+id).toggle( "highlight" );
            });
     });
</script>
@endsection