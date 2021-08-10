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
                <div class="card-header">{{ __('Mamul Sevk Raporu') }}</div> 
                <div class="row">
                    <div class="col-md-4"></div>
                </div>
                <div class="card-body">
                    <div>
                        <table class="table-sm table-striped table-hover" border="1">
                        <tr>
                            <td>Firma  :{{ $sevkmamul->firma->name  ?? ''}}</td>
                            <td>İrsaliye No  :{{ $sevkmamul->irsaliyeno ?? '' }}</td>
                            <td>Sevk Tipi  :{{ $sevkmamul->firmatipi->name ?? '' }}</td>
                            <td>Sevk Tarihi :{{ $sevkmamul->trh ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Adres  :{{ $sevkmamul->adres ?? '' }}</td>
                            <td colspan="2">Açıklama  :{{ $sevkmamul->aciklama ?? '' }}</td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <div class="col-md-6">
                                <td><h6>Sipariş No</h6></td>
                                <td><h6>Barkod</h6></td>
                                <td><h6>Top No</h6></td>
                                <td><h6>Metre</h6></td>
                            </div>
                        </tr>
                    <tbody>
                    @php $no=null; $id=0;@endphp 
                    @isset($sevkmamuldetail)
                        @foreach ($sevkmamuldetail as $list)
                     @php  $id=$list->sevkmamul_id @endphp
                     @if ($loop->index > 0 && $no != $list->order_id)
                       @include ('sevkmamul.subtotal', compact('list', 'no','id'))
                     @endif
                    <tr>
                        @if ($no == $list->order_id)
                            <td ></td>
                        @else 
                         @php ($no=$list->order_id)
                            <td>{{$list->order->order_no}}</td>
                         @endif
                            <td>{{ $list->barkod  ?? ''}}</td>
                            <td>{{ $list->top_id ?? '' }}</td>
                            <td>{{ $list->metre ?? '' }}</td>
                    </tr>
                        @if ($loop->last)
                       @include ('sevkmamul.subtotal', compact('list', 'no','id'))
                       @include ('sevkmamul.total', compact('list','id'))
                        @endif
                        @endforeach @endisset
                        
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