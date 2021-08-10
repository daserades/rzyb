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
                <div class="card-header">{{ __('İplik Boya Raporu') }}</div> 
                <div class="card-body">
                        <table class="table-sm table-striped table-hover" border="1">
                        <tr>
                            <td></td>
                            <td>Firma  :{{ $iplikboya->firma->name  ?? ''}}</td>
                            <td>No  :{{ $iplikboya->no ?? '' }}</td>
                            <td colspan="7">Sipariş No :{{ $iplikboya->order->order_no ?? '' }}</td>
                        </tr>
                    			<tr>
                            <div class="col-md-6">
                          	<th></th>
                            <th>İplik No/Ne</th>
                            <th>Renk No</th>
                            <th>Renk Adı</th>
                            <th>Boyanan İplik KG</th>
                            <th>G.İplik KG</th>
                            <th>Miktar</th>
                            <th>Fiyat</th>
                            <th>D.Cinsi</th>
                            <th>Açıklama</th>
                            </div>
                        </tr>
                        @isset($iplikboya->iplikboyadetail)
                        @foreach($iplikboya->iplikboyadetail as $list)

                            @if($list->iplikseridi_id == 1)
                        <tr>
                            <div class="col-md-6">
                            	<td>{{ $list->orderdetailweft->sira }}</td>
                    	        <td>{{$list->orderdetailweft->acinsne}}</td>
                                <td>{{$list->orderdetailweft->arenkno}}</td>
                                <td>{{$list->orderdetailweft->arenk}}</td>
                                <td>{{$list->orderdetailweft->aboyanankg}}</td>
                                <td>{{$list->orderdetailweft->agelenkg}}</td>
	                            <td>{{ $list->miktar }}</td>
	                            <td>{{ $list->fiyat }}</td>
	                            <td>{{ $list->kur_id }}</td>
	                            <td>{{ $list->aciklama }}</td>
                            </div>
                        </tr>
                        @endif
                        @endforeach @endisset
                        <tr>
                        	<td colspan="10"></td>
                        </tr>
                        @isset($iplikboya->iplikboyadetail)
                        @foreach($iplikboya->iplikboyadetail as $list)

                            @if($list->iplikseridi_id == 2)
                        <tr>
                            <div class="col-md-6">
                            	<td>{{ $list->orderdetailwarp->sira }}</td>
                    	        <td>{{$list->orderdetailwarp->cinsne}}</td>
                                <td>{{$list->orderdetailwarp->crenkno}}</td>
                                <td>{{$list->orderdetailwarp->crenk}}</td>
                                <td>{{$list->orderdetailwarp->boyanankg}}</td>
                                <td>{{$list->orderdetailwarp->gelenkg}}</td>
	                            <td>{{ $list->miktar }}</td>
	                            <td>{{ $list->fiyat }}</td>
	                            <td>{{ $list->kur_id }}</td>
	                            <td>{{ $list->aciklama }}</td>
                            </div>
                        </tr>
                        @endif
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