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
                <div class="card-header" align="center">{{ __('Mamul Sevk Listesi') }}
                    <div><a href="{{route('sevkmamul.create')}}" class="btn btn-xs btn-primary">Yeni</a></div>
                </div>
            <div class="card-body">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h6>Firma Adı</h6></td>
                                <td><h6>Sevk Tipi</h6></td>
                                <td><h6>S.Tarih</h6></td>
                                <td><h6>İrsaliye No</h6></td>
                                <td><h6>Adres</h6></td>
                                <td><h6>Açıklama</h6></td>
                                <td><h6></h6></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('css')
    <link href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}" rel="stylesheet">  
    <link  href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/fontawesome-free-5.10.2-web/css/all.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script>
    $(function() {
        $('#table').DataTable({
            //order : //['5','desc'],    
            order:[],    
            processing: true,
            serverSide: true,
            ajax: '{{ route('sevkmamuljs') }}',
            columns: [
            { data: 'firma.name' ,"defaultContent": ""},
            { data: 'firmatipi.name' , "defaultContent": ""},
            { data: 'trh'},
            { data: 'irsaliyeno'},
            { data: 'adres'},
            { data: 'aciklama'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    });
</script>
@endsection

