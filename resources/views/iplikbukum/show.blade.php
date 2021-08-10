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
                <div class="card-header">{{ __('Büküm Raporu') }}</div> 
                <div class="card-body">
                        <table class="table-sm table-striped table-hover" border="1">
                        <tr>
                            <td></td>
                            <td>Firma  :{{ $iplikbukum->firma->name  ?? ''}}</td>
                            <td>No  :{{ $iplikbukum->no ?? '' }}</td>
                            <td>Sipariş No :{{ $iplikbukum->order->order_no ?? '' }}</td>
                            <td colspan="6">Adı  :{{ $iplikbukum->name ?? '' }}</td>
                        </tr>
                            <div class="col-md-6">
                                <th></th>
                                <th>İplik Cinsi</th>
                                <th>Boya Cinsi</th>
                                <th>Renk No</th>
                                <th>Renk</th>
                                <th>İplik NO-NE</th>
                                <th>Kat Sayısı</th>
                                <th>Büküm Turu</th>
                                <th>Kat Büküm Yönü</th>
                                <th>Miktar</th>
                            </div>
                        </tr>
                        @isset($iplikbukum->iplikbukumdetail)
                        @foreach($iplikbukum->iplikbukumdetail as $list)
                        <tr>
                            <div class="col-md-6">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->iplikdepo->iplikcins->name ?? ''}}</td>
                            <td>{{ $list->iplikdepo->boyacins->name ?? ''}}</td>
                            <td>{{ $list->iplikdepo->renkno ?? ''}}</td>
                            <td>{{ $list->iplikdepo->renk ?? ''}}</td>
                            <td>{{ $list->iplikdepo->iplikno ?? ''}}/{{$list->iplikdepo->ne ?? ''}}</td>
                            <td>{{ $list->katsayi }}</td>
                            <td>{{ $list->tur }}</td>
                            <td>{{ $list->yon }}</td>
                            <td>{{ $list->miktar }}</td>
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