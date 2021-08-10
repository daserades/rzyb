@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">{{ __('Büküm Talimatı') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table border="1">
                    <tr>
                        <td>
                            Talimat No  :{{$iplikbukum->no}}
                        </td>
                        <td>
                            Firma   : {{$iplikbukum->firma->name ?? ''}}
                        </td>
                        <td>Sipariş No    :{{ $iplikbukum->order->order_no }}

                        </td>
                        <td> Açıklama   :  {{ $iplikbukum->aciklama }}
                        </td>
                        
                    </tr>
                </table> 
                <div class="card-header">{{ __('Talimat Bilgileri') }}  </div> 
                <table>
                    <form method="POST" action="{{route('bukumstore2')}}">
                        @csrf
                        <tr>
                            <td>
                        <input id="iplikbukum_id" name="iplikbukum_id" type="hidden" class="form-control" value="{{ $iplikbukum->id }}">
                        <div>
                            <label for="iplikdepo_id" class="col-form-label text-md-center">{{ __('İplik') }}</label>
                            <div class="col-md-3">
                                <select name='iplikdepo_id' id="iplikdepo_id"  required>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($iplikdepo as $list)
                                    <option value="{{$list->id}}">
                                        {{$list->iplikno.'/' }} {{$list->ne.' '}} @isset($list->iplikcins->name){{$list->iplikcins->name.' '}} @endisset  @isset($list->boyacins->name) {{$list->boyacins->name.' ' }} @endisset {{$list->renk.' ' }} {{$list->renkno.' '}} {{number_format($list->miktar,3,',','.') ?? ''}}{{$list->unit->name ?? ''}}
                                    </option>
                                    @endforeach 
                                </select> <!--  ' '.$list->iplikcins->name.' '.$list->boyacins->name.  -->
                                @error('iplikdepo_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                                
                            </td>
                            <td>
                                

                            <label for="katsayi" class="col-form-label text-md-center">{{ __('Kat Sayısı') }}</label>

                            <div >
                                <input id="katsayi" type="number" class="form-control @error('katsayi') is-invalid @enderror" name="katsayi" value="{{ old('katsayi') }}"  autocomplete="katsayi" autofocus required>

                                @error('katsayi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            </td>
                            <td>
                                
                            <label for="tur" class="col-form-label text-md-center">{{ __('Büküm Turu') }}</label>

                            <div >
                                <input id="tur" type="number" class="form-control @error('tur') is-invalid @enderror" name="tur" value="{{ old('tur') }}"  autocomplete="tur" autofocus required>

                                @error('tur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            </td>
                            <td>
                                
                            <label for="yon" class="col-form-label text-md-center">{{ __('Büküm Yönü') }}</label>

                            <div >
                                <input id="yon" type="text" class="form-control @error('yon') is-invalid @enderror" name="yon" value="{{ old('yon') }}"  autocomplete="yon" autofocus required>

                                @error('yon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            </td>
                            <td>
                                
                            <label for="miktar" class="col-form-label text-md-center">{{ __('Miktar') }}</label>

                            <div >
                                <input id="miktar" type="number" step="0.001" class="form-control @error('miktar') is-invalid @enderror" name="miktar" value="{{ old('miktar') }}"  autocomplete="miktar" autofocus required>

                                @error('miktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            </td>
                            <td>
                                

                            <label for="maxmiktar" class="col-form-label text-md-center">{{ __('Max. Gönderim Miktar') }}</label>

                            <div >
                                <input id="maxmiktar" type="number" step="0.001" class="form-control @error('maxmiktar') is-invalid @enderror" name="maxmiktar" value="{{ old('maxmiktar') }}"  autocomplete="maxmiktar" autofocus required>

                                @error('maxmiktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            </td>
                            <td>
                                
                            <div >
                                <button type="submit" class="btn btn-success">
                                    {{ __('Ekle') }}
                                </button>
                            </div>
                            </td>
                        </tr>
                        </div>
                    </form>
                </table>
                      <table class="table-sm table-striped">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <th></th>
                                <th>İplik Cinsi</th>
                                <th>Boya Cinsi</th>
                                <th>Renk No</th>
                                <th>Renk</th>
                                <th>İplik NO-NE</th>
                                <th>Kat Sayısı</th>
                                <th>Büküm Turu</th>
                                <th>Kat Büküm Yönü</th>
                                <th>Miktar</th>
                                <th>Max.Miktar</th>
                                <th colspan="2"></th>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @isset($iplikbukumdetail)
                        @foreach($iplikbukumdetail as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->iplikdepo->iplikcins->name ?? ''}}</td>
                            <td>{{ $list->iplikdepo->boyacins->name ?? ''}}</td>
                            <td>{{ $list->iplikdepo->renkno ?? ''}}</td>
                            <td>{{ $list->iplikdepo->renk ?? ''}}</td>
                            <td>{{ $list->iplikdepo->iplikno ?? ''}}/{{$list->iplikdepo->ne ?? ''}}</td>
                            <td>{{ $list->katsayi }}</td>
                            <td>{{ $list->tur }}</td>
                            <td>{{ $list->yon }}</td>
                            <td>{{ $list->miktar }}</td>
                            <td>{{ $list->maxmiktar }}</td>
                             <td>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('bukumdestroy2', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>
                        @endforeach @endisset
                    </tbody></table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
$( function() {
    $('#iplikdepo_id').select2({ width: '350px' });
});
</script>
@endsection