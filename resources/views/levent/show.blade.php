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
                <div class="card-header">{{ __('İrsaliye Raporu') }}</div> 
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
                            <td>İrsaliye No  :{{ $leventirsaliye->irsaliye_no ?? '' }}</td>
                            <td>Fatura No  :{{ $leventirsaliye->fatura_no ?? '' }}</td>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td colspan="10">Açıklama  :{{ $leventirsaliye->aciklama ?? '' }}</td>
                        </tr>
                        <tr><td colspan="10"></td></tr>
                        <tr>
                            <div class="col-md-6">
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
                            <td>{{ $list->fiyat ?? ''}}</td>
                            <td>{{ $list->kur->name ?? ''}}</td>
                            <td>{{ $list->aciklama ?? ''}}</td>
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