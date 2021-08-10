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
                <div class="card-header">{{ __('İrsaliye Çıktı Raporu') }}</div> 
                <div class="row">
                    <div class="col-md-4"></div>
                </div>
                <div class="card-body">
                    <div>
                        <table class="table-sm table-striped table-hover" border="1">
                        <tr>
                            <td>No :{{ $leventirsaliye->id ?? '' }}</td>
                            <td>Yer  :{{ $leventirsaliye->firmatipi->name ?? '' }}</td>
                            <td>Firma  :{{ $leventirsaliye->firma->name  ?? ''}}</td>
                            <td>Sevk Tarihi :{{ $leventirsaliye->gtrh ?? '' }}</td>
                            <td>İrsaliye No  :{{ $leventirsaliye->irsaliyeno ?? '' }}</td>
                            <td>Fatura No  :{{ $leventirsaliye->faturano ?? '' }}</td>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td colspan="10">Açıklama  :{{ $leventirsaliye->aciklama ?? '' }}</td>
                        </tr>
            </div>
                        <tr><td colspan="10" bgcolor="yellow"></td></tr>
                        <tr>
                            <div class="col-md-6">
                                  <td></td>
                               <td>Barcode</td>
                                <td>Sıra No</td>
                                <td>Tel Sayısı</td>
                                <td>Levent Eni</td>
                                <td>Metraj</td>
                                <td>Kg</td>
                            </div>
                        </tr>
                    <tbody>
                           @isset($leventirsaliye->leventhareket)
                        @foreach($leventirsaliye->leventhareket as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->barcode }}</td>
                            <td>{{ $list->no }}</td>
                            <td>{{ $list->telsayi }}</td>
                            <td>{{ $list->leventeni ?? ''}}</td>
                            <td>{{ $list->metraj  ?? ''}}</td>
                            <td>{{ $list->kg ?? ''}}</td>
                        </tr>
                        @isset($list->cozgu)
                        <tr> <td colspan="10" align="center">İPLİK BİLGİLERİ</td></tr>
                            <tr>
                                <td colspan="2"><h6></h6></td>
                                <td><h6>Sıra</h6></td>
                                <td><h6>İplik No-Ne</h6></td>
                                <td><h6>Renk No</h6></td>
                                <td><h6>Renk Adı</h6></td>
                                <td><h6>B.İplik KG</h6></td>
                            </tr>
                            @foreach($list->cozgu->order->orderdetailwarp as $liste)
                            <tr>
                                <td colspan="2"></td>    
                                <td>{{$loop->iteration}}</td>    
                                <td>{{$liste->cinsne}}</td>    
                                <td>{{$liste->crenkno}}</td>    
                                <td>{{$liste->crenk}}</td>    
                                <td>{{$liste->boyanankg}}</td>
                            </tr>    
                            @endforeach    
                            @endisset
                            <tr>
                                <td colspan="10" bgcolor="yellow"></td>
                            </tr>
                        @endforeach 
                        @endisset
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