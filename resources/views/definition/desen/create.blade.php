@extends('layouts.app')
@section('content')
    <div class="container">

        <h2 align="center">Desen Girişi</h2>
          @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
        <form method="post" class="form-group" action="{{ route('desen.store') }}"  enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Desen Adı</label>
                <input type="text" class="form-control" id="name" name='name' placeholder="Desen Adı">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Varyant</label>
                <input type="text" class="form-control" id="varyant" name='varyant' placeholder="Varyant">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Sipariş No</label>
                <input type="text" class="form-control" id="order_no" name='order_no' placeholder="Sipariş No">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Desen No</label>
                <input type="text" class="form-control" id="no" name='no' placeholder="Desen No">
            </div>
           <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Atkı Sıklığı</label>
                <input type="text" class="form-control" id="atki_sikligi" name='atki_sikligi' placeholder="Atkı Sıklığı">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Çözgü Sıklığı</label>
                <input type="text" class="form-control" id="cozgu_sikligi" name='cozgu_sikligi' placeholder="Çözgü Sıklığı">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Ç.Tel Sayısı</label>
                <input type="text" class="form-control" id="cts" name='cts' placeholder="Ç.Tel Sayısı">
            </div>
            <div class="col-md-3 col-sm-4 col-xs-8 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">TarakNo</label>
                <input type="text" class="form-control" id="tarak" name='tarak' placeholder="Tarak No" >
            </div>
            <div class="col-md-1 col-sm-2 col-xs-4 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">D.G.T.</label>
                <input type="text" class="form-control" id="tarak_no" name='tarak_no' placeholder="D.G.T." >
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tarak Eni</label>
                <input type="text" class="form-control" id="tarak_eni" name='tarak_eni' placeholder="Tarak Eni">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Faydalı T.E.</label>
                <input type="text" class="form-control" id="faydali_tarak_eni" name='faydali_tarak_eni' placeholder="Faydalı T.E.">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Ham En</label>
                <input type="text" class="form-control" id="ham_en" name='ham_en' placeholder="Ham En">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Ham Boy</label>
                <input type="text" class="form-control" id="ham_boy" name='ham_boy' placeholder="Ham Boy">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Ham Gr</label>
                <input type="text" class="form-control" id="ham_gr" name='ham_gr' placeholder="Ham Gr">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Mamul En</label>
                <input type="text" class="form-control" id="mamul_en" name='mamul_en' placeholder="Mamul En">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Mamul Boy</label>
                <input type="text" class="form-control" id="mamul_boy" name='mamul_boy' placeholder="Mamul Boy">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Mamul Gr</label>
                <input type="text" class="form-control" id="mamul_gr" name='mamul_gr' placeholder="Mamul Gr">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Armür Bilgisi</label>
                <input type="text" class="form-control" id="armur" name='armur' placeholder="Armür Bilgisi">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tahar Bilgisi</label>
                <input type="text" class="form-control" id="tahar" name='tahar' placeholder="Tahar Bilgisi">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">KenerGenişliği(cm)</label>
                <input type="text" class="form-control" id="kenargenisligi" name='kenargenisligi' placeholder="Kener Genişliği">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Resimleri Seç</label>
                <input type="file" class="form-control" name='resimler[]' multiple >
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tahar Seç</label>
                <input type="file" class="form-control" name='tahar[]' multiple >
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                 <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Açıklama</label>
                <textarea type="text" class="form-control" id="aciklama" name='aciklama' placeholder="Açıklama"></textarea>
            </div> 
            </div>
            <div align="center"  class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
            </div>

        </form>
</div>

@endsection
@section('js')

@endsection
@section('css')

    @endsection

