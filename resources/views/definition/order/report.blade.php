@extends('layouts.app')
@section('content')
<div class="d-flex flex-row">
  <div class="p-2">   
    <table class="table-striped table-hover" border="1">
        {{-- class="table-sm table-striped table-hover" --}}
        <tr>
            <th colspan="4"> Sipariş Bilgileri </th>
        </tr>
        <tr>
            <td> Sipariş No : </td>
            <td> {{$order->order_no ?? ''}} </td>
            <td> Desen Adı : </td>
            <td> {{$order->desenadi ?? ''}} </td>
        </tr>
        <tr>
            <td> Firma Kodu: </td>
            <td> {{$order->firma->zarano ?? ''}} </td>
            <td> Firma : </td>
            <td> {{$order->firma->name ?? ''}} </td>
        </tr>
        <tr>
            <td> Sipariş Türü : </td>
            <td> {{$order->ordertur->name ?? ''}} </td>
            <td> Atkı Sıklığı : </td>
            <td> {{$order->atkisikligi ?? ''}} </td>
        </tr>
        <tr>
            <td> Kalite : </td>
            <td> {{$order->kalite ?? ''}} </td>
            <td> Çözgü Metrejı</td>
            <td> {{$order->cozgumetraji ?? ''}}  </td>
        </tr>
        <tr>
            <td> İrsaliye Şekli : </td>
            <td> {{$order->irsaliyesekli->name ?? ''}} </td>
            <td> Ortak Çözgü Metrajı :</td>
            <td> {{$order->ortakcozgumetraji ?? ''}} </td>
        </tr>
        <tr>
            <td> Levent Genişliği : </td>
            <td> {{$order->leventgenisligi ?? ''}} </td>
            <td> Mamul En : </td>
            <td> {{$order->en ?? ''}} </td>
        </tr>
        <tr>
            <td> Çözgü Tel Sayısı : </td>
            <td> {{$order->cts ?? ''}} </td>
            <td> Ham En : </td>
            <td> {{$order->hamen ?? ''}} </td>
        </tr>
        <tr>
            <td> Tarak Eni : </td>
            <td> {{$order->tarakeni ?? ''}} </td>
            <td> Boy : </td>
            <td> {{$order->boy ?? ''}} </td>
        </tr>
        <tr>
            <td> Tarak No : </td>
            <td> {{$order->tarakno ?? ''}} </td>
            <td> Ebat Cinsi : </td>
            <td> {{$order->ebatcins->name ?? ''}} </td>
        </tr>
        <tr>
            <td> Makina Tipi : </td>
            <td> {{$order->makinatip ?? ''}} </td>
            <td> Kenar Tipi : </td>
            <td> {{$order->kenartipi->name ?? ''}} </td>
        </tr>
        <tr>
            <td> Kenar Cinsi  : </td>
            <td> {{$order->kenarcinsi->name ?? ''}} </td>
            <td> Kalite Detay : </td>
            <td> {{$order->kalitedetay->name ?? ''}} </td>
        </tr>
        <tr>
            <td> Miktar : </td>
            <td> {{$order->miktar ?? ''}} {{$order->unit->name}} </td>
            <td> Termin : </td>
            <td> {{$order->termin ?? ''}}  </td>
        </tr>
        <tr>
            <td> Sipariş Tarihi : </td>
            <td> {{$order->siptrh ?? ''}} </td>
            <td> Konstrüksiyon : </td>
            <td> {{$order->const ?? ''}}  </td>
        </tr>
        <tr>
            <td> Renk : </td>
            <td> {{$order->renk ?? ''}} </td>
            <td> Renk  2 : </td>
            <td> {{$order->renk2 ?? ''}}  </td>
        </tr>
        <tr>
            <td> Fiyat : </td>
            <td> 
               {{-- {{ $order->fiyat }}  {{ $order->kur->name ?? ''}} / {{$order->unit2->name ?? ''}} --}}
           </td>
           <td> Vade : </td>
           <td> {{$order->vade ?? ''}}  </td>
       </tr>
       <tr>
        <td> Ham Sipariş Miktarı : </td>
        <td> {{ $order->hamsip}} </td>
        <td> Baz Alınan Kur : </td>
        <td> {{$order->bazkur ?? ''}}  </td>
    </tr>
    <tr>
        <td> Mamul Sipariş Miktarı : </td>
        <td> {{ $order->mamulsip}} </td>
        <td> Düz boya Renk No : </td>
        <td> {{$order->duzboyarenkno ?? ''}}  </td>
    </tr>
    <tr>
        <td> Gelen Çözgü Metresi : </td>
        <td> {{ $order->gelencozgumetre}} </td>
        <td> Dokunan Adet : </td>
        <td> {{$order->dokunanadet ?? ''}}  </td>
    </tr>
    <tr>
        <td> Dokunan Tel Sayısı : </td>
        <td> {{ $order->dokumatelsayi}} </td>
        <td> Dokunan Tel Eni: </td>
        <td> {{$order->dokunanteleni ?? ''}}  </td>
    </tr>
    <tr>
        <td> Sipariş Adresi : </td>
        <td colspan="3"> {{$order->orderadres ?? ''}}  </td>
    </tr>
    <tr>
        <td> Sevkiyat Adresi : </td>
        <td colspan="3"> {{$order->sevkiyat ?? ''}}  </td>
    </tr>
    <tr>
        <td> Sipariş Proses : </td>
        <td colspan="3"> {{$order->orderproses ?? ''}}  </td>
    </tr>
    <tr>
        <td> Açıklama : </td>
        <td colspan="3"> {{$order->aciklama1 ?? ''}}  </td>
    </tr>
    <tr>
        <td> Açıklama : </td>
        <td colspan="3"> {{$order->aciklama2 ?? ''}}  </td>
    </tr>
    <tr>
        <td> Açıklama : </td>
        <td colspan="3"> {{$order->aciklama3 ?? ''}}  </td>
    </tr>
    <tr>
        <td> Sipariş Kayıt Tarihi : </td>
        <td> {{$order->created_at}} </td>
        <td> Siparişi Açan  : </td>
        <td> {{$order->user->name ?? ''}} {{ $order->user->surname ?? ''}} </td>
    </tr>
</table>
<br>
<table border="1" class="table-striped table-hover">
   <thead>
    <tr>
        <th colspan="6">Çözgü Bilgileri</th>
    </tr>
    <td>Ç</td>
    <td>İplik No/Ne</td>
    <td>Renk No</td>
    <td>Renk Adı</td>
    <td>B.İplik KG</td>
    <td>G.İplik KG</td>
</thead>
<tbody id="sortable">
    @foreach($order->orderdetailwarp->sortBy('sira') as $list)
    <tr>
        <td>{{$list->sira}}</td>
        <td>{{$list->cinsne}}</td>
        <td>{{$list->crenkno}}</td>
        <td>{{$list->crenk}}</td>
        <td>{{$list->boyanankg}}</td>
        <td>{{$list->gelenkg}}</td>
    </tr>
    @endforeach
</tbody>
</table>
<br>
<table border="1" class="table-striped table-hover">
 <thead>
    <tr>
        <th colspan="7">Atkı Bilgileri</th>
    </tr>
    <td>A</td>
    <td>İplik No/Ne</td>
    <td>Renk No</td>
    <td>Renk Adı</td>
    <td>B.İplik KG</td>
    <td>G.İplik KG</td>
    <td>Atkı Sıklık</td>
</thead>
<tbody id="sortable2">
    @foreach($order->orderdetailweft->sortBy('sira') as $list)
    <tr>
        <td>{{$list->sira}}</td>
        <td>{{$list->acinsne}}</td>
        <td>{{$list->arenkno}}</td>
        <td>{{$list->arenk}}</td>
        <td>{{$list->aboyanankg}}</td>
        <td>{{$list->agelenkg}}</td>
        <td>{{$list->asiklik}}</td>
    </tr>   
    @endforeach
</tbody>
</table>
</div>
<div class="p-2">   
    <table class="table-striped table-hover" border="1">
        <tr>
            <th colspan="4"> Desen Bilgileri </th>
        </tr>
        <tr>
            <td> Desen Adı : </td>
            <td> <a href="{{route('desen.report',$order->desen_id)}}" target="_blank" title="Desen Detayı"> {{$order->desen->name}}</a> </td>
            <td> Varyant : </td>
            <td> {{$order->desen->varyant}} </td>
        </tr>
        <tr>
            <td> No : </td>
            <td> {{$order->desen->no}} </td>
            <td> Çözgü Tel Sayısı : </td>
            <td> {{$order->desen->cts}} </td>
        </tr>
        <tr>
            <td> Atkı Sıklığı : </td>
            <td> {{$order->desen->atki_sikligi}} </td>
            <td> Çözgü Sıklığı : </td>
            <td> {{$order->desen->cuzgu_sikligi}} </td>
        </tr>
        <tr>
            <td> Tarak Eni : </td>
            <td> {{$order->desen->tarak_eni}} </td>
            <td> Faydalı Tarak Eni : </td>
            <td> {{$order->desen->faydali_tarak_eni}} </td>
        </tr>
        <tr>
            <td> Tarak : </td>
            <td> {{$order->desen->tarak}} </td>
            <td> Tarak No : </td>
            <td> {{$order->desen->tarak_no}} </td>
        </tr>
        <tr>
            <td> Ham En : </td>
            <td> {{$order->desen->ham_en}} </td>
            <td> Ham Boy : </td>
            <td> {{$order->desen->ham_boy}} </td>
        </tr>
        <tr>
            <td> Ham Gr : </td>
            <td> {{$order->desen->ham_gr}} </td>
            <td> Mamul Gr : </td>
            <td> {{$order->desen->mamul_gr}} </td>
        </tr>
        <tr>
            <td> Mamul En : </td>
            <td> {{$order->desen->mamul_en}} </td>
            <td> Mamul Boy : </td>
            <td> {{$order->desen->mamul_boy}} </td>
        </tr>
        <tr>
            <td> Armür : </td>
            <td> {{$order->desen->armur}} </td>
            <td> Tahar : </td>
            <td> {{$order->desen->tahar}} </td>
        </tr>
    </table>
</div>

<div class="p-2">   
   <table class="table-striped table-hover" border="1">
    <tr>
        <th colspan="12">İplik Hareketleri</th>
    </tr>
    @if($order->iplikirsaliye)
    @foreach($order->iplikirsaliye as $list)
    <tr>
        <td>No : </td>
        <td>@if($list->hareketturu_id == 1)<a href="{{route('iplikirsaliye.show',$list->id)}}"> {{ $list->id ?? '' }} </a> @else <a href="{{route('iplikshow2',$list->id)}}"> {{ $list->id ?? '' }} </a> @endif</td>
        <td>Yer  : </td>
        <td>{{ $list->firmatipi->name ?? '' }}</td>
        <td>Sevk Tarihi : </td>
        <td>@if($list->hareketturu_id == 1) {{ $list->gtrh ?? '' }} @else {{ $list->ctrh ?? '' }} @endif </td>
        <td>İrsaliye No  : </td>
        <td>{{ $list->irsaliye_no ?? '' }}</td>
        <td>Fatura No  : </td>
        <td>{{ $list->fatura_no ?? '' }}</td>
        <td> Hareket Türü : </td>
        <td> {{$list->hareketturu->name}} </td>
    </tr>
    @if($list->iplikirsaliyedetail)
    <tr>
        <td colspan="3"></td>
        <td>Hareket Türü</td>
        <td>Lot No</td>
        <td>İplik Marka</td>
        <td>İplik No-Ne</td>
        <td>İplik Cinsi</td>
        <td>Boya Cinsi</td>
        <td>Renk No</td>
        <td>Renk</td>
        <td>Miktar</td>
    </tr>
    @php $miktar=0; $totmiktar=0; @endphp
    @foreach($list->iplikirsaliyedetail->where('iplikirsaliye_id',$list->id) as $liste)
    <tr>
        <td colspan="3"></td>
        <td>{{ $liste->hareketturu->name}} </td>
        <td>{{ $liste->partino }}</td>
        <td>{{ $liste->iplikmarka }}</td>
        <td>{{ $liste->iplikno }}/{{ $liste->ne }}</td>
        <td>{{ $liste->iplikcins->name ?? ''}}</td>
        <td>{{ $liste->boyacins->name  ?? ''}}</td>
        <td>{{ $liste->renkno ?? ''}}</td>
        <td>{{ $liste->renk ?? ''}}</td>
        <td>{{ $miktar= $liste->where('iplikirsaliye_id',$liste->iplikirsaliye_id)->groupby('iplikirsaliye_id','iplikno','ne','partino','renkno')->sum('miktar')}} {{$liste->unit->name}}</td>
    </tr>
    @php $totmiktar += $miktar; @endphp
    @endforeach
    @endif
    <tr>
        <td colspan="11">Toplam</td>
        <td> {{$totmiktar}} </td>
    </tr>
    @endforeach
    @endif
</table>
<br>
<table class="table-striped table-hover" border="1">
        <tr>
            <th colspan="10">Leventler</th>
        </tr>    
        <tr>
         <td></td>
         <td>Barcode</td>
         <td>Sıra No</td>
         <td>Tel Sayısı</td>
         <td>Levent Eni</td>
         <td>Metraj</td>
         <td>Kg</td>
         <td>Fiyat</td>
         <td>D.cins</td>
         <td>Açıklama</td>
     </tr>
     @isset($order->leventhareket)
     @foreach($order->leventhareket as $list)
     <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $list->barcode }}</td>
        <td>{{ $list->no }}</td>
        <td>{{ $list->telsayi }}</td>
        <td>{{ $list->leventeni ?? ''}}</td>
        <td>{{ $list->metraj  ?? ''}}</td>
        <td>{{ $list->kg ?? ''}}</td>
        <td>{{ $list->fiyat ?? ''}}</td>
        <td>{{ $list->kur->name ?? ''}}</td>
        <td>{{ $list->aciklama ?? ''}}</td>
    </tr>
    @endforeach 
    @endisset
</table>
<br>
<table class="table-striped table-hover" border="1">
    <tr>
            <th colspan="10">Kumaşlar(Toplar)</th>
        </tr>    
    <tr>
            <td>Barcode</td>
            <td>Top no </td>
            <td>Metre</td>
            <td>Brut Metre</td>
            <td>Kumaş Eni</td>
            <td>KG</td>
            <td>Makina No</td>
            <td>Ebat</td>
            <td>Tarih</td>
    </tr>
    @php $toplam=0;  $hatayuzdesi=0; @endphp 
    @isset($order->ball)
    @foreach ($order->ball as $list)
    <tr>
        <td><a href="{{route('ballerror',$list->id)}}"> {{ $list->barcode }}</a></td>
        <td>{{ $list->type }}</td>
        <td>{{ $list->metre }}</td>
        <td>{{ $list->brutmetre }}</td>
        <td>{{ $list->kumaseni }}</td>
        <td>{{ $list->kg }}</td>
        <td>{{ $list->machine->name ?? ''}}</td>
        <td>{{ $list->ebat }}</td>
        <td>{{ $list->trh }}</td>

    </tr>
    @php $toplam += $list->metre;  @endphp
    @endforeach @endisset

    <tr>
        <td colspan="1">Toplam</td> 
        <td> {{ count($order->ball) }} top </td> 
        <td> {{$toplam }} metre </td> 
    </tr>
</table>

</div>
</div>


  <table class=" table-striped table-hover" border="1">
                       {{--  <tr>
                            <td>Firma  :{{ $sevkham->firma->name  ?? ''}}</td>
                            <td>İrsaliye No  :{{ $sevkham->irsaliyeno ?? '' }}</td>
                            <td>Sevk Tipi  :{{ $sevkham->firmatipi->name ?? '' }}</td>
                            <td>Sevk Tarihi :{{ $sevkham->trh ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Adres  :{{ $sevkham->adres ?? '' }}</td>
                            <td colspan="2">Açıklama  :{{ $sevkham->aciklama ?? '' }}</td>
                        </tr>
                        --}} 
                        <tr>
                            <th colspan="10">Sevk Olan Kumaşlar</th>
                        </tr>
                        <tr>
                                <td>Sipariş No</td>
                                <td>Barkod</td>
                                <td>Top No</td>
                                <td>Metre</td>
                        </tr>
                    <tbody>
                    @php $no=null; $id=0;@endphp 
                    @isset($sevkhamdetail)
                        @foreach ($sevkhamdetail as $list)
                     @php  $id=$list->sevkham_id @endphp
                     @if ($loop->index > 0 && $no != $list->order_id)
                       @include ('sevkham.subtotal', compact('list', 'no','id'))
                     @endif
                    <tr>
                        @if ($no == $list->order_id)
                            <td ></td>
                        @else 
                         @php ($no=$list->order_id)
                            <td>{{$list->order->order_no}}</td>
                         @endif
                            <td>{{ $list->barcode  ?? ''}}</td>
                            <td>{{ $list->top_id ?? '' }}</td>
                            <td>{{ $list->metre ?? '' }}</td>
                    </tr>
                        @if ($loop->last)
                       @include ('sevkham.subtotal', compact('list', 'no','id'))
                       @include ('sevkham.total', compact('list','id'))
                        @endif
                        @endforeach @endisset
                        
                    </tbody>
                </table>


@endsection
@section('css')
<style type="text/css">
    th { font-size: 12px; }
    td {
       font-size: 10px; 
       font-weight: bold;
       /*word-wrap:break-word;*/

   }
   tr:hover td {background:#FF7F50}


</style>
@endsection
@section('js')

@endsection