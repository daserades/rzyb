@extends('layouts.app')
@section('content')
<div class="container">

	<h2 align="center">Desen Güncelle</h2>
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
	<form method="POST" action="{{ route('desen.update', $desen->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<?php 
					if(file_exists('storage/uploads/'.$desen->id)){
					$klasor = opendir( 'storage/uploads/'.$desen->id);
					    while (false !== ($girdi = readdir($klasor))) {
					        if ($girdi != "." && $girdi != "..") {
					        	$ext = pathinfo($girdi);
					        	$uzanti= $ext['extension'];$namedosya=basename($girdi);
					     ?>
					<img src="{{ Storage::url('uploads/'.$desen->id.'/'.$namedosya) }}" width="340" height="150" a/>	
                    <a href="{{ route('desenimagedestroy',[$desen->id,$namedosya]) }}" style="color:red" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt fa-1x"></i></a>
					           <?php
					        }
					    }
					    closedir($klasor);
					}
					?>
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Desen Adı</label>
				<input type="text" class="form-control" id="name" name='name' placeholder="Desen Adı" value="{{$desen->name}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Varyant</label>
				<input type="text" class="form-control" id="varyant" name='varyant' placeholder="Varyant" value="{{$desen->varyant}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Sipariş No</label>
				<input type="text" class="form-control" id="order_no" name='order_no' placeholder="Sipariş No" value="{{$desen->order_no}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Desen No</label>
				<input type="text" class="form-control" id="no" name='no' placeholder="Desen No" value="{{$desen->no}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Atkı Sıklığı</label>
				<input type="text" class="form-control" id="atki_sikligi" name='atki_sikligi' placeholder="Atkı Sıklığı" value="{{$desen->atki_sikligi}}">
			</div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Çözgü Sıklığı</label>
                <input type="text" class="form-control" id="cozgu_sikligi" name='cozgu_sikligi' placeholder="Çözgü Sıklığı" value="{{$desen->cozgu_sikligi}}">
            </div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Ç.Tel Sayısı</label>
				<input type="text" class="form-control" id="cts" name='cts' placeholder="Ç.Tel Sayısı" value="{{$desen->cts}}">
			</div>
			<div class="col-md-3 col-sm-4 col-xs-8 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">TarakNO</label>
				<input type="text" class="form-control" id="tarak" name='tarak' placeholder="Tarak No" value="{{$desen->tarak}}">
			</div>
			<div class="col-md-1 col-sm-2 col-xs-4 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">D.G.T.</label>
				<input type="text" class="form-control" id="tarak_no" name='tarak_no' placeholder="D.G.T." value="{{$desen->tarak_no}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tarak Eni</label>
				<input type="text" class="form-control" id="tarak_eni" name='tarak_eni' placeholder="Tarak Eni" value="{{$desen->tarak_eni}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Faydalı T.E.</label>
				<input type="text" class="form-control" id="faydali_tarak_eni" name='faydali_tarak_eni' placeholder="Faydalı T.E." value="{{$desen->faydali_tarak_eni}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Ham En</label>
				<input type="text" class="form-control" id="ham_en" name='ham_en' placeholder="Ham En" value="{{$desen->ham_en}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Ham Boy</label>
				<input type="text" class="form-control" id="ham_boy" name='ham_boy' placeholder="Ham Boy" value="{{$desen->ham_boy}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Ham Gr</label>
				<input type="text" class="form-control" id="ham_gr" name='ham_gr' placeholder="Ham Gr" value="{{$desen->ham_gr}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Mamul En</label>
				<input type="text" class="form-control" id="mamul_en" name='mamul_en' placeholder="Mamul En" value="{{$desen->mamul_en}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Mamul Boy</label>
				<input type="text" class="form-control" id="mamul_boy" name='mamul_boy' placeholder="Mamul Boy" value="{{$desen->mamul_boy}}">
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Mamul Gr</label>
				<input type="text" class="form-control" id="mamul_gr" name='mamul_gr' placeholder="Mamul Gr" value="{{$desen->mamul_gr}}">
			</div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Armür Bilgisi</label>
                <input type="text" class="form-control" id="armur" name='armur' placeholder="Armür Bilgisi" value="{{$desen->armur}}">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tahar Bilgisi</label>
                <input type="text" class="form-control" id="tahar" name='tahar' placeholder="Tahar Bilgisi" value="{{$desen->tahar}}">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">KenarGenişliği(cm)</label>
                <input type="text" class="form-control" id="kenargenisligi" name='kenargenisligi' placeholder="Kenar Genişliği" value="{{$desen->kenargenisligi}}">
            </div> @can('desendelete')
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Resimleri Seç</label>
				<input type="file" class="form-control" name='resimler[]' multiple >
			</div> @endcan
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Açıklama</label>
				<textarea type="text" class="form-control" id="aciklama" name='aciklama' placeholder="Açıklama">{{$desen->aciklama}}</textarea>
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
