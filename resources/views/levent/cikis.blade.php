@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">{{ __('Levent Çıkış Bilgileri') }} <a href="{{route('leventshow3',$leventirsaliye->id)}}" style="color:black" title="YAZDIR" target="_blank" id="print"><i class="fas fa-print fa-2x"></i></a></div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table  class="table-sm">
                    <tr>
                        <td>Firma    :{{ $leventirsaliye->firma->name }}

                        </td>
                        <td>Firma Tipi    :{{ $leventirsaliye->firmatipi->name }}

                        </td>
                        <td>Giriş Tarihi     :{{ $leventirsaliye->gtrh }}
                        </td>
                        <td> İrsaliye No   :   {{ $leventirsaliye->irsaliye_no }}
                        </td>
                        <td> Fatura No   :   {{ $leventirsaliye->fatura_no }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">Açıklama   : {{ $leventirsaliye->aciklama }}
                        </td>
                    </tr>
                </table>
                <form method="POST" action="{{route('leventcikisdetail')}}">
                    @csrf
                    <div class="card-header">{{ __('Barkod Okutma') }}</div> 
                    <div class="row align-items-center">
                        <input id="leventirsaliye_id" name="leventirsaliye_id" type="hidden" class="form-control" value="{{ $leventirsaliye->id }}">
                        <label for="barcode" class="col-md-2 col-form-label text-md-center">{{ __('Barkod') }}</label>

                        <div class="col-md-10">
                            <input id="barcode" type="text" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}"  autocomplete="barcode" autofocus  placeholder="Barkodu Buraya Okutunuz...">
                            @error('barcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </form>
                
                  <div class="card-header">{{ __('Eklenen Leventler') }}</div>

                <table border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>Barcode</td>
                                <td>Sıra No</td>
                                <td>Tel Sayısı</td>
                                <td>Levent Eni</td>
                                <td>Metraj</td>
                                <td>KG</td>
                                <td></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @isset($leventhareket)
                        @foreach($leventhareket as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->barcode }}</td>
                            <td>{{ $list->no }}</td>
                            <td>{{ $list->telsayi }}</td>
                            <td>{{ $list->leventeni }}</td>
                            <td>{{ $list->metraj }}</td>
                            <td>{{ $list->kg }}</td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('leventcikisdestroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>
                        @endforeach @endisset
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript">
   $('input[name=cuvalbol]').change(function(){
    $(this).toggle( "highlight" );
    val=$(this).val();
    id=$(this).attr('id');
    barcode=$('input[name=kod'+id).val();
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
    sayfa = '{{ route('cuvalbol') }}';
    $.post(sayfa, {id:id,val:val,barcode:barcode}, function(data) {
        $("#"+id).toggle( "highlight" );
    $('.cuvalbol'+id).append("<a href='{{url('iplikirsaliye/cuvalboletiket')}}/"+id+"'style='color:black'><i class='fas fa-print fa-2x'></i></a>");
    });
});

</script>
@endsection