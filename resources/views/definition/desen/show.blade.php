@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
				<div class="card-header text-md-center"><H3>{{ __('Desen Detayı') }}</H3></div>
				<div class="card-body">
					<?php 
					if(file_exists('storage/uploads/'.$desen->id)){
					$klasor = opendir( 'storage/uploads/'.$desen->id);
					    while (false !== ($girdi = readdir($klasor))) {
					        if ($girdi != "." && $girdi != "..") {
					        	$ext = pathinfo($girdi);
					        	$uzanti= $ext['extension'];$namedosya=basename($girdi);
					        	if ($uzanti == 'jpg') {
					     ?> 
					<img src="{{ Storage::url('uploads/'.$desen->id.'/'.$namedosya) }}" width="340" height="150" a/>	
					           <?php }
 					           else { ?>
					           <a href="{{ Storage::url('uploads/'.$desen->id.'/'.$namedosya) }}" target="_blank">
					           <?php }
					        }
					    }
					    closedir($klasor);
					}
					?>
					<a href="{{route('imagesd',$desen->id)}}">Tam Ekran</a>
					<table class="table"> 
					<tr>
					<td>
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Sipariş No:  ') }}{{ $desen->order_no}}</label>	
					</div>
					</td>
					</tr>
					<tr>
					<td>
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Desen Adı - Varyant:  ') }}{{ $desen->name }}{{$desen->varyant}}</label>	
					</div>
					</td>
					<td>
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Desen No:  ') }}@isset($desen->no){{ $desen->no }}@endisset</label>	
					</div>
					</td>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('CTS  :  ') }}@isset($desen->cts){{ $desen->cts }}@endisset</label>	
					</div>
					</td>
					</tr>
					<tr>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Atkı Sıklığı:  ') }}@isset($desen->atki_sikligi){{ $desen->atki_sikligi }}@endisset</label>	
					</div>
					</td>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Çözgü Sıklığı:  ') }}@isset($desen->cozgu_sikligi){{ $desen->cozgu_sikligi }}@endisset</label>	
					</div>
					</td>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Tarak No  :  ') }}@isset($desen->tarak){{ $desen->tarak.'*'.$desen->tarak_no }}@endisset</label>
					</div>
					</td>
					</tr>
					<tr>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Tarak Eni  :  ') }}@isset($desen->tarak_eni){{ $desen->tarak_eni }}@endisset</label>	
					</div>
					</td>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Faydalı T.E  :  ') }}@isset($desen->faydali_tarak_eni){{ $desen->faydali_tarak_eni }}@endisset</label>
					</div>
					</td>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Armür  :  ') }}@isset($desen->armur){{ $desen->armur }}@endisset</label>	
					</div></td>
					</tr>
					<tr>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Ham En  :  ') }}@isset($desen->ham_en){{ $desen->ham_en }}@endisset</label>	
					</div>
					</td>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Ham Boy  :  ') }}@isset($desen->ham_boy){{ $desen->ham_boy }}@endisset</label>
					</div>
					</td>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Ham GR  :  ') }}@isset($desen->ham_gr){{ $desen->ham_gr }}@endisset</label>	
					</div></td>
					</tr>
					<tr>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Mamul En  :  ') }}@isset($desen->mamul_en){{ $desen->mamul_en }}@endisset</label>
					</div></td>
					<td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Mamul Boy  :  ') }}@isset($desen->mamul_boy){{ $desen->mamul_boy }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Mamul Gr  :  ') }}@isset($desen->mamul_gr){{ $desen->mamul_gr }}@endisset</label>
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="name" class="col-md-6 text-md-left">{{ __('Açıklama :  ') }} {{ $desen->aciklama }}</label>	
					</div></td>
					<td >	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Tahar :  ') }}@isset($desen->tahar){{ $desen->tahar }}@endisset</label>	
					</div></td>
					<td >	
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Kenar Genişlik(cm) :  ') }} @isset($desen->kenargenisligi){{ $desen->kenargenisligi }}@endisset</label>	
					</div></td></tr>
					</table>
				</div>
					<div class="card-body">
						<div class="card-header text-md-center"><H3>{{ __('İplikler') }}</H3>
						<td><a href="{{url('desen',$desen->id)}}" title="Renk Girişi" style="color:black"><i class="fas fa-plus-circle fa-2x"></i></a></td>
					</div>
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h5></h5></td>
                                <td><h5>İplik </h5></td>
                                <td><h5>İplik No</h5></td>
                                <td><h5>İplik Cinsi</h5></td>
                                <td><h5>Renk No</h5></td>
                                <td><h5>Renk</h5></td>
                                <td><h5>K.Tel S.</h5></td>
                                <td><h5>Tel S.</h5></td>
                                <td><h5>Atkı Sıklığı</h5></td>
                                <td><h5>Çözgü Sıklığı</h5></td>
                                <td><h5>Tekrar</h5></td>
                                <td><h5>Boş Atkı S.</h5></td>
                                <td><h5>Aynı Ağıza Atılan A.S.</h5></td>
                                <td colspan="2"><Center><h5>Gramajlar</h5></Center></td>
                                <td><h5></h5></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> @isset($patterndetail)
                    		@foreach ($patterndetail as $list)
                    	<tr>
                    	 	<td>{{ $loop->iteration }}</td>
                    	 	<td>{{ $list->iplikseridi->name }}</td>
                            <td>{{ $list->iplik_no }}/{{$list->iplik_kalin}}  {{ $list->aciklama }}</td>
                            <td>{{ $list->iplikcins->name }}</td>
                            <td>{{ $list->renk_no }}</td>
                            <td>{{ $list->renk }}</td>
                            <td>{{ $list->renk_sayisi }}</td>
                            <td>{{ $list->harf }}{{ $list->sayi }}</td>
                            <td>{{ $list->atki_sikligi }}</td>
                            <td>{{ $list->cozgu_sikligi }}</td>
                            <td>{{ $list->tekrar }}</td>
                            <td>{{ $list->bos_atki_sayisi }}</td>
                            <td>{{ $list->ayni_agiza_atilan_atki_sayisi }}</td>
                            <td>{{ $list->cozgu_gr }}</td>
                            <td>{{ $list->atki_gr }}</td>
                             <td align="right">
                                <a class="btn btn-xs btn-secondary" href="{{route('patterndetail.edit',$list->id)}}">Düzenle</a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('patterndetail.destroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Sil</button>
                                    </form>
                                </div> 
                            </td>
                        </tr>@endforeach @endisset
                    </tbody>
                </table>
					<div class="form-group row">
						<a href="javascript:history.back()" class="btn btn-primary">Geri</a>
					</div>				
                </div>    
			</div>
		</div>
	</div>
</div>
@endsection
