@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="card-header">{{ __('Raporlar') }}</div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="card-body">
                        <table class="table" border="2">
                       
                            <tr>
                                <td width="30%">
                                    <div class="form-group row">
                                        <label for="desen_name"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('DESEN ADI') }}</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="desen_name"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->name){{ $desen->name }}@endisset</b></label>
                                    </div>
                                </td>
                                <td width="30%">
                                    <div class="form-group row">
                                        <label for="kalite_name"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('KALİTE') }}</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="kalite_name"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->kalite->name){{ $desen->kalite->name }}@endisset</b></label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td width="30%">
                                    <div class="form-group row">
                                        <label for=""
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('MÜŞTERİ NO') }}</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for=""
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->order->firma_no){{ $desen->order->firma_no }}@endisset</b></label>
                                    </div>
                                </td>
                                <td width="30%">
                                    <div class="form-group row">
                                        <label for="desen_no"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('DESEN NO') }}</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="desen_no"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->no){{ $desen->no }}@endisset</b></label>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td width="30%">
                                    <div class="form-group row">
                                        <label for="tarak_eni"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('TARAK ENİ') }}</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="tarak_eni"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->tarak_eni){{ $desen->tarak_eni }}@endisset</b></label>
                                    </div>
                                </td>
                                <td width="30%">
                                    <div class="form-group row">
                                        <label for="tarak_no"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('TARAK NO') }}</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="tarak_no"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->tarak){{ $desen->tarak.'*'.$desen->tarak_no }}@endisset</b></label>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="cts"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('ÇÖZGÜ TEL SAYISI') }}</b>
                                        </label>
                                    </div>
                                </td>
                                <td>

                                    <div class="form-group row">
                                        <label for="cts"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->cts){{ $desen->cts }}@endisset</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for=""
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('MAKİNE SIKLIĞI') }}</b>
                                        </label>
                                    </div>
                                </td>
                                <td>

                                    <div class="form-group row">
                                        <label for=""
                                               class="col-md-12 col-form-label text-md-left"><b></b></label>
                                    </div>
                                </td>
                            </tr>


                            {{--foreach kısmı--}}

                            <tr>
                                <td colspan="2">
                                    @foreach($desen->orderdetailwarp as $odw)
                                    <div class="form-group row">

                                        <label for="cts"
                                               class="col-md-12 col-form-label text-md-left"><b>{{$loop->iteration}}. <b>ÇÖZGÜ RENK:</b> {{$odw->crenk}}</b>
                                        </label>
                                    </div>
                                    @endforeach
                                </td>
                                <td colspan="2">
                                    @foreach($desen->orderdetailweft as $lt)
                                    <div class="form-group row">

                                        <label for="cts"
                                               class="col-md-12 col-form-label text-md-left"><b>{{$loop->iteration}}. <b>Atkı RENK:</b> {{$lt->arenk}}</b>
                                        </label>
                                    </div>
                                    @endforeach
                                </td>
                            </tr>



                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="ham_gr"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('HAM MT2 GRAMAJI') }}</b></label>
                                    </div>
                                </td>
                                <td colspan="1">
                                    <div class="form-group row">
                                        <label for="ham_gr"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->ham_gr){{ $desen->ham_gr }}@endisset</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="mamul_gr"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('MAMÜL MT2 GRAMAJI') }}</b></label>
                                    </div>
                                </td>
                                <td colspan="1">
                                    <div class="form-group row">
                                        <label for="mamul_gr"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->mamul_gr){{ $desen->mamul_gr }}@endisset</b></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="ham_en"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('HAM EN') }}</b></label>
                                    </div>
                                </td>
                                <td colspan="1">
                                    <div class="form-group row">
                                        <label for="ham_en"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->ham_en){{ $desen->ham_en }}@endisset</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="mamul_en"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('MAMÜL EN') }}</b></label>
                                    </div>
                                </td>
                                <td colspan="1">
                                    <div class="form-group row">
                                        <label for="mamul_en"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->mamul_en){{ $desen->mamul_en }}@endisset</b></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="aciklama"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('MAKİNE NO') }}</b></label>
                                    </div>
                                </td>
                                <td colspan="1">
                                    <div class="form-group row">
                                        <label for="aciklama"
                                               class="col-md-12 col-form-label text-md-left"><b></b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="created_at"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('ÜRETİM TARİHİ') }}</b></label>
                                    </div>
                                </td>
                                <td colspan="1">
                                    <div class="form-group row">
                                        <label for="created_at"
                                               class="col-md-12 col-form-label text-md-left"><b>@isset($desen->created_at){{ $desen->created_at }}@endisset</b></label>
                                    </div>
                                </td>



                                </td>

                            </tr>

                            </tr>
                            <tr>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection