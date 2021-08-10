
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Çözgü Detayı') }}</div>
                    <div class="card-body">
                        <table class="table" border="2">
                            <tr>
                                <td >
                                    <div class="form-group row">
                                        <label for="order_no" class="col-md-12 col-form-label text-md-left"><b>{{ __('SİPARİŞ NO  ') }}</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="order_no"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ $cozgu->order->order_no ?? '' }}</b></label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="firma_id"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('FİRMA ADI') }}</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="firma_id"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ $cozgu->firma->name ?? '' }}</b></label>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="no"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('NO') }}</b></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <label for="no"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ $cozgu->no ?? '' }}</b></label>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="telsayi"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('ÇÖZGÜ TEL SAYISI') }}</b>
                                        </label>
                                    </div>
                                </td>
                                <td>

                                    <div class="form-group row">
                                        <label for="telsayi"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ $cozgu->telsayi ?? '' }}</b></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                
                            <td>
                                <div class="form-group row">
                                    <label for="leventeni"
                                           class="col-md-12 col-form-label text-md-left"><b>{{ __('LEVENT ENİ') }}</b></label>
                                </div>
                            </td>
                            <td>

                                <div class="form-group row">
                                    <label for="leventeni"
                                           class="col-md-12 col-form-label text-md-left"><b>{{ $cozgu->leventeni  ?? ''}}</b></label>
                                </div>
                            </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="metraj"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('ÇÖZGÜ METRAJI') }}</b></label>
                                    </div>
                                </td>
                                <td>

                                    <div class="form-group row">
                                        <label for="metraj"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ $cozgu->metraj ?? '' }}</b></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="bobinadet"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('BOBİN ADEDİ') }}</b></label>
                                    </div>
                                </td>
                                <td colspan="1">
                                    <div class="form-group row">
                                        <label for="bobinadet"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ $cozgu->bobinadet ?? '' }}</b></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="tip"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('ÇÖZGÜ TİPİ') }}</b></label>
                                    </div>
                                </td>
                                <td colspan="1">
                                    <div class="form-group row">
                                        <label for="tip"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ $cozgu->tip ?? '' }}</b></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="aciklama"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ __('AÇIKLAMA-1') }}</b></label>
                                    </div>
                                </td>
                                <td colspan="1">
                                    <div class="form-group row">
                                        <label for="aciklama"
                                               class="col-md-12 col-form-label text-md-left"><b>{{ $cozgu->aciklama ?? '' }}</b></label>
                                    </div>
                                </td>
                                </tr>

                            @foreach($cozgu->order->orderdetailwarp as $list)

                                <tr>
                                    <div class="form-group row">
                                    <td colspan="2"><label class="col-md-12 col-form-label text-md-left">
                                    {{$loop->iteration}}. <b>İPLİK NO:</b> {{$list->cinsne}},  {{$list->crenkno}},  {{$list->crenk}},  {{$list->boyanankg}}
                                    </label>
                                </td>
                                </div>
                            </tr>
                                @endforeach


      </table></div></div></div></div></div>

@endsection
@section('css')

@endsection
@section('js')

@endsection