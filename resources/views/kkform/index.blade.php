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
                <div class="card-header" align="center">{{ __('Ham KKForm Listesi') }}
                    <div class="col-md-2" ><a href="{{route('kkform.create')}}" class="btn btn-xs btn-primary">Yeni</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <div class="col-md-6">
                                    <td><h5>Sipariş No</h5></td>
                                    <td><h5>Top No</h5></td>
                                    <td><h5>Metre</h5></td>
                                    <td><h5>Brüt Metre</h5></td>
                                    <td><h5>Kumas Eni</h5></td>
                                    <td><h5>KG</h5></td>
                                    <td><h5>Ebat</h5></td>
                                    <td><h5>Tarih</h5></td>
                                    <td><h5>Makina</h5></td>
                                    <td><h5>Açıklama</h5></td>
                                    <td><h5></h5></td>
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
            ajax: '{{ route('kkformjs') }}',
            columns: [
            { data: 'order.order_no' ,"defaultContent": ""},
            { data: 'barcode' , "defaultContent": ""},
            { data: 'brutmetre'},
            { data: 'metre'},
            { data: 'kumaseni'},
            { data: 'kg'},
            { data: 'ebat'},
            { data: 'trh'},
            { data: 'makina', "defaultContent": ""},
            { data: 'aciklama'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    });
</script>
@endsection
