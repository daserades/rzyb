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
                <div class="card-header">{{ __('Çıkış İrsaliye Raporu') }}</div> 
                <div class="row">
                    <div class="col-md-4"></div>
                </div>
                <div class="card-body">
                    <div>
                        <table class="table-sm table-striped table-hover" border="1">
                        <tr>
                            <td>No :{{ $iplikirsaliye->id ?? '' }}</td>
                            <td>Yer  :{{ $iplikirsaliye->firmatipi->name ?? '' }}</td>
                            <td>Firma  :{{ $iplikirsaliye->firma->name  ?? ''}}</td>
                            <td>Sipariş  :{{ $iplikirsaliye->order->order_no  ?? ''}}</td>
                            <td>Sevk Tarihi :{{ $iplikirsaliye->ctrh ?? '' }}</td>
                            <td>İrsaliye No  :{{ $iplikirsaliye->irsaliye_no ?? '' }}</td>
                            <td>Fatura No  :{{ $iplikirsaliye->fatura_no ?? '' }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8">Açıklama  :{{ $iplikirsaliye->aciklama ?? '' }}</td>
                        </tr>
                        <tr><td colspan="8"></td></tr>
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
                    <tbody>
                            @php $iplikcins_id=null; $id=0;@endphp 
                    @foreach($iplikirsaliye->iplikirsaliyedetail as $list)
                                 @php  $id=$list->iplikirsaliye_id @endphp
                                  @if ($loop->index > 0 && $iplikcins_id != $list->partino)
                                    @include ('iplikirsaliye.show2_subtotal', compact('list', 'iplikcins_id','id'))
                                    @endif
                         <tr>
                             @if ($iplikcins_id == $list->partino)
                                            <td ></td>
                                            @else 
                                            @php ($iplikcins_id=$list->partino)
                                  <td>{{ $list->partino ??  ''}}</td>
                             @endif
                            <td>{{ $list->iplikmarka ??  '' }}</td>
                            <td>{{ $list->iplikno ??  ''}}/{{$list->ne ??  ''}}</td>
                            <td>{{ $list->iplikcins->name  ?? ''}}</td>
                            <td>{{ $list->boyacins->name  ?? ''}}</td>
                            <td>{{ $list->renkno ??  ''}}</td>
                            <td>{{ $list->renk ??  ''}}</td>
                            <td>{{ $list->miktar ?? ''}}</td>
                        </tr>
                              @if ($loop->last)
                                    @include ('iplikirsaliye.show2_subtotal', compact('list', 'iplikcins_id','id'))
                                        
                                    @endif
                        @endforeach 
                        <tr>
                            <td colspan="7">Toplam</td>
                            <td>{{$iplikirsaliye->iplikirsaliyedetail->sum('miktar')}}</td>
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