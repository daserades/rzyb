@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('İplik Raporu') }}</div> 
                <div class="row">
                    <div class="col-md-4"></div>
                </div>
                <div class="card-body">
                    <div>
                        <table class="table-sm table-striped table-hover" border="1">
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>Sevk No</td>
                                <td>Hareket Türü</td>
                                <td>Firma</td>
                                <td>Firma Tipi</td>
                                <td>Sipariş</td>
                                <td>İrsaliye No</td>
                                <td>Fatura No</td>
                                <td>Tarih</td>
                                <td>Lot No</td>
                                <td>İplik Marka</td>
                                <td>İplik No-Ne</td>
                                <td>İplik Cinsi</td>
                                <td>Boya Cinsi</td>
                                <td>Renk No</td>
                                <td>Renk</td>
                                <td>Renk 2</td>
                                <td>Renk No 2</td>
                                <td>Miktar</td>
                                <td>Brut Miktar</td>
                            </div>
                        </tr>
                    <tbody>
                             @php  $id=0;@endphp 
                            @foreach ($iplikirsaliye as $list)
                            @if ($loop->index > 0 && $id != $list->iplikirsaliye_id)
                                    @include ('iplikirsaliye.show3_subtotal', compact('list','id'))
                                    @endif
                                <tr>
                                    <td>{{$loop->iteration ?? ''}} </td>
                                     @if ($id == $list->iplikirsaliye_id)
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            @else 
                                        <td>{{$list->iplikirsaliye_id ?? ''}} </td>
                                        <td>{{$list->hareketturu->name ?? ''}} </td>
                                    <td>{{$list->iplikirsaliye->firma->name ?? ''}} </td>
                                    <td>{{$list->iplikirsaliye->firmatipi->name ?? ''}} </td>
                                    <td>{{$list->iplikirsaliye->order->order_no ?? ''}} </td>
                                    <td>{{$list->iplikirsaliye->irsaliye_no ?? ''}} </td>
                                    <td>{{$list->iplikirsaliye->fatura_no ?? ''}} </td>
                                    <td> @if($list->hareketturu_id ==1) {{$list->iplikirsaliye->gtrh ?? ''}} @else {{$list->iplikirsaliye->ctrh ?? ''}} @endif </td>
                                    @endif
                                    <td>{{$list->partino ?? ''}} </td>
                                    <td>{{$list->iplikmarka ?? ''}} </td>
                                    <td>{{$list->iplikno ?? ''}}-{{$list->ne ?? ''}}</td>
                                    <td>{{$list->iplikcins->name ?? ''}} </td>
                                    <td>{{$list->boyacins->name ?? ''}} </td>
                                    <td>{{$list->renkno ?? ''}} </td>
                                    <td>{{$list->renk ?? ''}} </td>
                                    <td>{{$list->renksim ?? ''}} </td>
                                    <td>{{$list->renknosim ?? ''}} </td>
                                    <td>{{$list->miktar ?? ''}} {{$list->unit->name ?? ''}} </td>
                                    <td>{{$list->brutmiktar ?? ''}} {{$list->unit->name ?? ''}}</td>
                                </tr>
                                 @if ($loop->last)
                                    @include ('iplikirsaliye.show3_subtotal', compact('list','id'))
                                    @endif
                             @php  $id=$list->iplikirsaliye_id; @endphp 
                            @endforeach
                             <tr>
                                <td colspan="17">Depodaki Toplam</td>
                                <td>{{$iplikdepo->miktar ?? ''}}</td>
                                <td>{{$iplikdepo->brutmiktar ?? ''}}</td>
                                <td>{{$iplikdepo->unit ?? ''}}</td>
                            </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')

@endsection
@section('js')

@endsection