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
                <div class="card-header">{{ __('Tesis Listesi') }}</div> 
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form action="{{route('stesis')}}" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
                <div class="col-md-2" ><a href="{{route('tesis.create')}}" class="btn btn-xs btn-primary">Yeni</a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h6>Tesis Adı</h6></td>
                                <td><h6>Firma</h6></td>
                                <td><h6>Firma Tipi</h6></td>
                                <td><h6>Ünvan</h6></td>
                                <td><h6>Durum</h6></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tesis as $list)
                        <tr>
                            <td>{{ $list->name }}</td>
                            <td>@isset($list->firma->name){{$list->firma->name}}@endisset</td>
                            <td>@isset($list->firmatipi->name){{ $list->firmatipi->name }}@endisset</td>
                            <td>{{ $list->unvan }}</td>
                            <td>@isset($list->durum->name){{ $list->durum->name }}@endisset</td>
                            <td>
                                <a  href="{{route('tesis.show',$list->id)}}"style="color:black" title="Detay"><i class="fas fa-desktop fa-2x"></i></a>
                            </td><td>
                                <a  href="{{route('tesis.edit',$list->id)}}"style="color:black" title="Düzenle"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('tesis.destroy', $list->id)}}" method="POST">
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
                {{$tesis->links()}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
