@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mamul Sevkiyat Oluştur') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" id="ball" action="{{ route('sevkmamuldetay') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="mamulkkform_id" class="col-md-4 col-form-label text-md-right">{{ __('Toplar') }}</label>

                            <div class="col-md-6">
                                <select name='mamulkkform_id' class="form-control  @error('mamulkkform_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($mamulkkform as $list)
                                    <option value="{{$list->id}}" id="mamulkkform_id">{{$list->order_no.'  T.N'.$list->topno.'---'.$list->brutmetre.' Br.mt--'.$list->aciklama}}</option>
                                    @endforeach
                                    <input type="hidden" name="sevkmamul_id" value="{{ $sevkmamul->id }}">
                                </select>
                                @error('mamulkkform_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                       <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                            <button class="btn btn-success">
                                {{ __('Ekle') }}
                            </button>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                        <div class="card-header text-md-center"><H3>{{ __('Eklenen Toplar') }}</H3>
                        </div>
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h5></h5></td>
                                <td><h5>Firma </h5></td>
                                <td><h5>Sipariş No</h5></td>
                                <td><h5>Top No</h5></td>
                                <td><h5>Metre</h5></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> @php $toplammetre=0; @endphp 
                        @isset($sevkmamuldetail)
                            @foreach ($sevkmamuldetail as $list)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $list->sevkham->firma_id ?? ''}}</td>
                            <td>{{ $list->order->order_no  ?? ''}}</td>
                            <td>{{ $list->top_id ?? '' }}</td>
                            <td>{{ $list->metre ?? '' }}</td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('mamuldetaildelete', $list->id ?? '')}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr> @php $toplammetre += $list->metre; @endphp
                        @endforeach @endisset
                        <tr><td colspan="4">TOPLAM</td><td>{{ $toplammetre }}mt</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(".btn btn-success").click(function() {
        alert('asd')
            yer = $("select[name=kkform_id").children(":selected").val();
            sevkmamul_id = $("input[name=sevkmamul_id]").val();
            $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            sayfa = '{{ route('sevkmamuldetay') }}';
            $.post(sayfa, {top_id: yer,sevkmamul_id:sevkmamul_id}, function(data) {
               
            });
            
        });

                    </script>
                    @endsection
