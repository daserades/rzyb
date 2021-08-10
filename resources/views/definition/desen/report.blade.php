@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header text-md-center">{{ __('Desen Bilgileri') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table border="1">
                    <tr>
                        <td>
                            Desen Adı   : {{$desen->name}}
                        </td>
                        <td>Desen No    :{{ $desen->no }}

                        </td>
                        <td>CTS     :{{ $desen->cts }}
                        </td>
                        <td> Atkı Sıklığı   :   {{ $desen->atki_sikligi }}
                        </td>
                    </tr>
                    <tr>
                        <td> Çözgü Sıklığı   :  {{ $desen->cozgu_sikligi }}
                        </td>
                        <td> Tarak No    :  {{ $desen->tarak.'*'.$desen->tarak_no }}
                        </td>
                        <td>Tarak Eni   :    {{ $desen->tarak_eni }}
                        </td>
                        <td>Faydalı Tarak Eni   :    {{ $desen->faydali_tarak_eni }}
                        </td>
                    </tr>
                </table> 
                <div class="card-header text-md-center">{{ __('İplik Bilgileri') }} </div>
                 <table border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h5></h5></td>
                                <td><h5>İplik</h5></td>
                                <td><h5>İplik No</h5></td>
                                <td><h5>Harf</h5></td>
                                <td><h5>T.Tel S.</h5></td>
                                <td><h5>İplik Cİnsi</h5></td>
                                <td><h5>Boya Cinsi</h5></td>
                                <td><h5>Renk No</h5></td>
                                <td><h5>Renk</h5></td>
                                <td><h5>Atkı S.</h5></td>
                                <td><h5>Çözgü S.</h5></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @php  $no=null; @endphp
                        @isset($desen->patterndetail)
                        @foreach($desen->patterndetail as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->iplikseridi->name ?? ''}}</td>
                            <td>{{ $list->iplik_no }}/{{$list->iplik_kalin}}</td>
                            <td>{{ $list->harf}}</td>
                            <td id="tel{{$list->id}}"> 
                                @foreach($list->patternwarp as $asd)
                                    @php  $patterndetail_id=$asd->patterndetail_id; @endphp
                                  @if ($loop->first > 0 && $no != $asd->patterndetail_id)
                                    @include ('instructions.sumwire', compact('asd', 'patterndetail_id'))
                                  @endif
                                @endforeach
                            </td>
                            <td>{{ $list->iplikcins->name }}</td>
                            <td>{{ $list->boyacins->name ?? ''}}</td>
                            <td>{{ $list->renk_no }}</td>
                            <td>{{ $list->renk }}</td>
                            <td>{{ $list->atki_sikligi }}</td>
                            <td>{{ $list->cozgu_sikligi }}</td>
                        </tr>
                        @endforeach @endisset
                    </tbody>
                </table>
                <div class="card-header text-md-center">{{ __('Detay Bilgileri') }} </div>
                <table border="1" class="table-hover">
                    <thead>
                        <tr>
                            <div>
                                <td><h5></h5></td>
                                <td><h5>İplik</h5></td>
                                <td><h5>Harf</h5></td>
                                <td><h5>T.Tel S.</h5></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @isset($desen->patternwarp)
                        @foreach($desen->patternwarp->where('iplikseridi_id',1) as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->iplikseridi->name ?? ''}}</td>
                            <td>{{ $list->harf}}</td>
                            <td>{{ $list->sayi }}</td>
                        </tr>
                        @endforeach @endisset
                        @isset($desen->patternwarp)
                        @foreach($desen->patternwarp->where('iplikseridi_id',2) as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->iplikseridi->name ?? ''}}</td>
                            <td>{{ $list->harf}}</td>
                            <td>{{ $list->sayi }}</td>
                        </tr>
                        @endforeach @endisset
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
</script>
@endsection