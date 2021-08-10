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
                <table  class="table-sm">
                    <tr>
                        <td>
                            Sipariş No   : {{$iplikirsaliye->order->order_no  ?? ''}}
                        </td>
                        <td>Firma    :{{ $iplikirsaliye->firma->name ?? ''}}

                        </td>
                        <td>Çıkış Yeri    :{{ $iplikirsaliye->firmatipi->name ?? ''}}

                        </td>
                        <td>Çıkış Tarihi     :{{ $iplikirsaliye->ctrh }}
                        </td>
                        <td> İrsaliye No   :   {{ $iplikirsaliye->irsaliye_no }}
                        </td>
                        <td> Fatura No   :   {{ $iplikirsaliye->fatura_no }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">Açıklama   : {{ $iplikirsaliye->aciklama }}
                        </td>
                    </tr>
                </table> 
                 @if($iplikirsaliye->firmatipi->name == 'BÜKÜM')
                 <div class="card-header">{{ __('Büküme Gönderilecek İplikler') }}</div>
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
                                <td>Max.Miktar</td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($iplikbukum as $a)
                        @foreach($a->iplikbukumdetail as $list)
                        <tr>
                            <td>{{ $list->iplikirsaliyedetail->partino ?? $list->iplikdepo->partino ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->iplikmarka ?? $list->iplikdepo->iplikmarka ?? '' }}</td>
                            <td>{{ $list->iplikirsaliyedetail->iplikno ?? $list->iplikdepo->iplikno ?? ''}}/{{$list->iplikirsaliyedetail->ne ?? $list->iplikdepo->ne ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->iplikcins->name ?? $list->iplikdepo->iplikcins->name ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->boyacins->name ?? $list->iplikdepo->boyacins->name ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->renkno ?? $list->iplikdepo->renkno ?? ''}}</td>
                            <td>{{ $list->iplikirsaliyedetail->renk ?? $list->iplikdepo->renk ?? ''}}</td>
                            <td>{{ $list->miktar ?? ''}}</td>
                            <td>{{ $maxmiktar= $list->maxmiktar ?? ''}}</td>
                        </tr>
                        @endforeach 
                        @endforeach 
                    </tbody>
                </table>
                        @endif
                <form method="POST" action="{{route('iplikirsaliyestoredetail')}}">
                    @csrf
                    <div class="card-header">{{ __('Barkod Okutma') }}</div> 
                    <div class="row align-items-center" id="qr">
                        <input id="iplikirsaliye_id" name="iplikirsaliye_id" type="hidden" class="form-control" value="{{ $iplikirsaliye->id }}">
                        <label for="barcode" class="col-md-2 col-form-label text-md-center">{{ __('Barkod') }}</label>

                        <div class="col-md-10">
                            <input id="barcode" maxlength="16" type="text" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}"  autocomplete="barcode" autofocus  placeholder="Barkodu Okutunuz...">
                            @error('barcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </form>
                <div class="card-header">{{ __('Eklenen İplikler') }}</div>

                <table border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>Barcode</td>
                                <td>Lot No</td>
                                <td>İplik Marka</td>
                                <td>İplik No-Ne</td>
                                <td>İplik Cinsi</td>
                                <td>Boya Cinsi</td>
                                <td>Renk No</td>
                                <td>Renk</td>
                                <td>Miktar</td>
                                <td>Brüt Miktar</td>
                                <td>Bölünüp Sevk Edilecek M.</td>
                                <td></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @isset($iplikirsaliyedetail)
                        @foreach($iplikirsaliyedetail as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->barcode }}</td>
                            <td>{{ $list->partino }}</td>
                            <td>{{ $list->iplikmarka }}</td>
                            <td>{{ $list->iplikno }}/{{$list->ne}}</td>
                            <td>{{ $list->iplikcins->name ?? ''}}</td>
                            <td>{{ $list->boyacins->name ?? ''}}</td>
                            <td>{{ $list->renkno }}</td>
                            <td>{{ $list->renk }}</td>
                            <td>{{ $list->miktar }}{{ $list->unit->name }}</td>
                            <td>{{ $list->brutmiktar }}{{ $list->unit->name }}</td>
                            <td class="cuvalbol{{$list->id}}"><input class="form-control" type="number" id="{{$list->id}}" name="cuvalbol" placeholder="Miktar Giriniz.."><input type="hidden" name="kod{{$list->id}}" value="{{$list->barcode}}">
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('iplikirsaliyedetaildestroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>
                        @endforeach @endisset
                        <tr>
                            <td colspan="9">Toplam</td>
                            <td>{{($iplikirsaliyedetail->sum('miktar')) ?? ''}}</td>
                            <td>{{($iplikirsaliyedetail->sum('brutmiktar')) ?? ''}}</td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript">
   $('input[name=cuvalbol]').change(function(){
    $(this).toggle( "highlight" );
    val=$(this).val();
    id=$(this).attr('id');
    barcode=$('input[name=kod'+id).val();
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
    sayfa = '{{ route('cuvalbol') }}';
    $.post(sayfa, {id:id,val:val,barcode:barcode}, function(data) {
        $("#"+id).toggle( "highlight" );
    $('.cuvalbol'+id).append("<a href='{{url('iplikirsaliye/cuvalboletiket')}}/"+id+"'style='color:black'><i class='fas fa-print fa-2x'></i></a>");
    });
});
</script>
@endsection