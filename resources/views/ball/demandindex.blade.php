@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('Sipariş Bölme Talep Listesi') }}</div> 
                <div class="row">
                    <div class="col col-md-6"></div>
                    {{-- <div class="col-md-4">
                        <form action="{{route('sgorevlistesi')}}" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                     --}}</div>
                    <div class="col-md-2" ><a href="{{route('transfer')}}" class="btn btn-xs btn-primary">Yeni</a>
                    </div>
                <div class="card-body">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <div class="col-md-6">
                                    <td>Topların Seçileceği Sipariş</td>
                                    <td>Topların Aktarılacağı Sipariş</td>
                                    <td>Açıklama</td>
                                    <td></td>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demand as $list)
                            <tr>
                                <td>{{ $list->oldorder->order_no }}</td>
                                <td>{{ $list->order->order_no }}</td>
                                <td>{{ $list->aciklama }}</td>
                                 <td align="right">
                                    <a href="{{route('transferdetail',$list->id)}} " title="Top Aktar" target="_blank" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a>
                                </td> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$demand->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
