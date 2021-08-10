@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('Firma Listesi') }}</div> 
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form action="{{route('sfirma')}}" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
                <div class="col-md-2" ><a href="{{route('firma.create')}}" class="btn btn-xs btn-primary">Yeni</a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h6>Firma No-Adı</h6></td>
                                <td><h6>Firma Tipi</h6></td>
                                <td><h6>Ünvan</h6></td>
                                <td><h6>Durum</h6></td>
                                <td><h6>Tesis Mi</h6></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($firma as $list)
                        <tr>
                            <td>{{$list->zarano ?? '' }} {{ $list->name }}</td>
                            <td>{{ $list->firmatipi->name }}</td>
                            <td>{{ $list->unvan }}</td>
                            <td>{{ $list->durum->name }}</td>
                            <td>{{ $list->yesno->name }}</td>
                            <td>
                                <a  href="{{route('firma.show',$list->id)}}"style="color:black" title="Detay"><i class="fas fa-desktop fa-2x"></i></a>
                            </td><td>
                                <a  href="{{route('firma.edit',$list->id)}}"style="color:black" title="Düzenle"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('firma.destroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$firma->links()}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
