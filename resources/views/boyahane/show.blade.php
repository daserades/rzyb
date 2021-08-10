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
                <div class="card-header">{{ __('Boyahane Raporu') }}</div> 
                <div class="card-body">
                        <table class="table-sm table-striped table-hover" border="1">
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="3">Firma  :{{ $boyahane->firma->name  ?? ''}}</td>
                            <td colspan="2">No  :{{ $boyahane->no ?? '' }}</td>
                            <td colspan="2">Talimat Tarih  :{{ $boyahane->created_at ?? '' }}</td>
                        </tr>
                            <div class="col-md-6">
                                <th></th>
                                <th>Sipariş No</th>
                                <th>Sipariş M.</th>
                                <th>Sevk M.</th>
                                <th>Sevk KG.</th>
                                <th>İstenen Mamul En</th>
                                <th>Terbiye Süreci</th>
                                <th>Fiyat</th>
                                <th>Açıklama</th>
                            </div>
                        </tr>
                        @isset($boyahane->boyahanedetail)
                        @foreach($boyahane->boyahanedetail as $list)
                        <tr>
                            <div class="col-md-6">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$list->order->order_no}}</td>
                            <td>{{$list->order->miktar}}</td>
                            <td>{{$list->metre}}</td>
                            <td>{{$list->kg}}</td>
                            <td>{{$list->mamulen}}</td>
                            <td>{{$list->terbiyesureci->name ?? ''}}</td>
                            <td>{{$list->fiyat. ' '. $list->kur->name ?? ''}}</td>
                            <td>{{$list->aciklama}}</td>
                        </div>
                        </tr>
                        @endforeach @endisset
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