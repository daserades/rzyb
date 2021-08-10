@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">{{ __('Sipariş Detayı') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<div class="card-body"><center>
					<table border="1"> 
					<tr>
						<td colspan="2">
					<div>
						<label for="order_no" class="col-md-12 col-form-label text-md-center"><font size="6">{{ __('Sipariş No:  ') }} 
							@if(Str::length($order->firma->zarano)<=2 )
							{{ mb_substr($order->order_no,0,4).'-'.mb_substr($order->order_no,4,2).'-'.mb_substr($order->order_no,6) }}
							@else
							{{ mb_substr($order->order_no,0,4).'-'.mb_substr($order->order_no,4,3).'-'.mb_substr($order->order_no,7) }}
							@endif
						</font></label>	
					</div>
					<br>Müşteriye Sevk Edilen Miktar :@if($sevkhamdetail > 0) {{$sevkhamdetail}} ham MT.@endif @if($sevkmamuldetail > 0) {{$sevkmamuldetail}} Mamül MT.@endif
				</td>
					<td>
					<div class="card-body text-md-center"><img src="{{ Storage::url('icons/asd.jpg') }}" alt="Smiley face" height="80" width="150"></div>
					<center><b>Müşteri Sipariş Tarihi ={{date('d-m-Y', strtotime($order->siptrh))}}</b></center>
				</td>
				</tr><tr><td>
					<div>
						<label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('Firma Adı:  ') }}{{$order->firma->zarano}}</label>	
					</div></td><td>
					<div>
						<label for="firma_no" class="col-md-12 col-form-label text-md-left">{{ __('Firma Sip. No:  ') }}{{ $order->firma_no }}</label>	
					</div></td>
					<td><div>
						<label for="tesis_id" class="col-md-12 col-form-label text-md-left">{{ __('Desen No:  ') }}{{ $order->desen->no ?? ''}}</label>	
					</div></td></tr>
					<tr><td>
					<div>
						<label for="ordertur_id" class="col-md-12 col-form-label text-md-left">{{ __('Sipariş Türü  :')   }} @isset($order->ordertur->name){{ $order->ordertur->name }} @endisset</label>	
					</div></td><td>	
					<div>
						<label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('Desen Adı:  ') }}@isset($order->desenadi){{ $order->desenadi }}@endisset</label>	
					</div></td><td>	
					<div>
						<label for="ordertur_id" class="col-md-12 col-form-label text-md-left">{{ __('Varyant  :')   }} {{ $order->varyant }} </label>	
					</div></td></tr>
					<tr><td>
					<div>
						<label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('Levent Genişliği:  ') }}@isset($order->leventgenisligi){{ $order->leventgenisligi }}@endisset</label>	
					</div></td><td>
					<div>
						<label for="firma_no" class="col-md-12 col-form-label text-md-left">{{ __('Top Tel Sayısı:  ') }} @isset($order->cts){{ $order->cts }} @endisset</label>	
					</div></td>
					<td><div>
						<label for="tesis_id" class="col-md-12 col-form-label text-md-left">{{ __('Tarak Eni:  ') }}@isset($order->tarakeni){{ $order->tarakeni }}@endisset</label>	
					</div></td></tr>
					<tr><td>
					<div>
						<label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('Tarak No:  ') }}@isset($order->tarakno){{ $order->tarakno }}@endisset</label>	
					</div></td><td>
					<div>
						<label for="firma_no" class="col-md-12 col-form-label text-md-left">{{ __('Makina Tip:  ') }} @isset($order->makinatip){{ $order->makinatip }} @endisset</label>	
					</div></td>
					<td><div>
						<label for="tesis_id" class="col-md-12 col-form-label text-md-left">{{ __('ORT. Atkı Sıklığı:  ') }}@isset($order->atkisikligi){{ $order->atkisikligi }}@endisset</label>	
					</div></td></tr>
					<tr><td>
					<div>
						<label for="firma_no" class="col-md-12 col-form-label text-md-left">{{ __('Kalite:  ') }} @isset($order->kalite){{ $order->kalite }} @endisset</label>	
					</div></td>	<td>	
					<div>
						<label for="en" class="col-md-12 col-form-label text-md-left">{{ __('En  :')   }}{{ $order->en }}</label>	
					</div></td><td>
					<div>
						<label for="boy" class="col-md-12 col-form-label text-md-left">{{ __('Boy  :  ') }}{{ $order->boy }}</label>	
					</div></td></tr>
					<tr><td>	
					<div>
						<label for="ebatcinsi_id" class="col-md-12 col-form-label text-md-left">{{ __('Ebat Cinsi  :  ') }} @isset($order->ebatcins->name) {{ $order->ebatcins->name }} @endisset</label>
					</div></td><td>	
					<div>
						<label for="kenarcinsi_id" class="col-md-12 col-form-label text-md-left">{{ __('Kenar Cinsi  :  ') }} @isset($order->kenarcinsi->name){{ $order->kenarcinsi->name }} @endisset</label>	
					</div></td>
						<td>	
					<div>
						<label for="kenartipi_id" class="col-md-12 col-form-label text-md-left">{{ __('Kenar Tipi  :  ') }} @isset($order->kenartipi->name){{ $order->kenartipi->name }} @endisset</label>	
					</div></td><tr>
					<td>	
					<div>
						<label for="miktar" class="col-md-12 col-form-label text-md-left">{{ __('Müşteri Sipariş Miktarı  :  ') }}{{ $order->miktar }} @isset($order->unit->name){{ $order->unit->name}} @endisset</label>	
					</div></td><td>	
					<div>
						<label for="cozgumetraji" class="col-md-12 col-form-label text-md-left">{{ __('Çözgü Metrajı  :  ') }}{{ $order->cozgumetraji }}</label>	
					</div></td><td>	
					<div>
						<label for="vade" class="col-md-12 col-form-label text-md-left">{{ __('Ham Sipariş Met.  :  ') }}{{ $order->hamsip }}</label>	
					</div></td></tr>
					<tr><td>	
					<div>
						<label for="renk" class="col-md-12 col-form-label text-md-left">{{ __('Çözgü Renk  :  ') }}{{ $order->renk }}</label>	
					</div></td><td>	
					<div>
						<label for="renk2" class="col-md-12 col-form-label text-md-left">{{ __('Atkı Renk:  ') }}{{ $order->renk2 }}</label>	
					</div></td><td>	
					<div>
						<label for="termin" class="col-md-12 col-form-label text-md-left">{{ __('Termin  :  ') }}{{ date('d-m-Y', strtotime($order->termin)) }}</label>	
					</div></td></tr>
					<tr><td>	
					<div>@role('admin|genel mudur|muhasebe|konfeksiyon')
						<label for="fiyat" class="col-md-12 col-form-label text-md-left">{{ __('Fiyat  :  ') }}{{ $order->fiyat }}  {{ $order->kur->name ?? ''}} / {{$order->unit2->name ?? ''}}</label>	
					@endrole </div></td>
					<td>	
					<div>
						<label for="vade" class="col-md-12 col-form-label text-md-left">{{ __('Vade  :  ') }}{{ $order->vade }}</label>	
					</div></td><td>	
					<div>
						<label for="const" class="col-md-12 col-form-label text-md-left">{{ __('Konstruksiyon  :  ') }}{{ $order->const }}</label>
					</div></td>
					</tr>
					<tr><td>		
					<div>
						<label for="ordertur_id" class="col-md-12 col-form-label text-md-left">{{ __('İrsaliye Şekli  :')   }} @isset($order->irsaliyesekli->name){{ $order->irsaliyesekli->name }} @endisset</label>	
					</div></td>
					<td>	
					<div>
						<label for="duzboyarenkno" class="col-md-12 col-form-label text-md-left">{{ __('Düz Boya Renk No  :  ') }}{{ $order->duzboyarenkno }}</label>	
					</div></td>
					<td>	
					<div>
						<label for="odemesekli" class="col-md-12 col-form-label text-md-left">{{ __('Ödeme Şekli  :  ') }}{{ $order->odemesekli }}</label>	
					</div></td>
				</tr><tr><td colspan="2">	
					<div>
						<label for="orderadres" class="col-md-12 col-form-label text-md-left"><p>{{ __('Teslimat Adresi  :  ') }}{{ $order->orderadres }}</p></label>	
					</div></td>
					<td colspan="1">		
					<div>
						<label for="sevkiyat" class="col-md-12 col-form-label text-md-left">{{ __('Sevkiyat Şekli  :  ') }}{{ $order->sevkiyat }}</label>	
					</div></td></tr>
					<tr><td colspan="3">	
					<div>
						<label for="orderproses" class="col-md-12 col-form-label text-md-left">{{ __('Boyahane Firma/Proses  :  ') }}{{ $order->orderproses }}</label>	
					</div></td></tr>
					<tr><td colspan="3">	
					<div>
						<label for="aciklama1" class="col-md-12 col-form-label text-md-left">{{ __('Açıklama1  :  ') }}{{ $order->aciklama1 }}</label>	
					</div></td></tr><tr><td colspan="3">	
					<div>
						<label for="aciklama2" class="col-md-12 col-form-label text-md-left">{{ __('Açıklama2  :  ') }}{{ $order->aciklama2 }}</label>	
					</div></td></tr><tr><td colspan="3">	
					<div>
						<label for="aciklama3" class="col-md-12 col-form-label text-md-left">{{ __('Açıklama3  :  ') }}{{ $order->aciklama3 }}</label>	
					</div></td></tr>					
					</table>
					<?php 
					if(file_exists('storage/uploads/'.$order->order_no)){
					$klasor = opendir( 'storage/uploads/'.$order->order_no);
					    while (false !== ($girdi = readdir($klasor))) {
					        if ($girdi != "." && $girdi != "..") {
					        	$ext = pathinfo($girdi);
					        	$uzanti= $ext['extension']; $namedosya=basename($girdi);
					     ?>
					<img src="{{ Storage::url('uploads/'.$order->order_no.'/'.$namedosya) }}" width="340" height="150"/>	
					           <?php
					        }
					    }
					    closedir($klasor);
					}
					?> 
					<br>
					<a href="{{route('images',$order->id)}}">Tam Ekran</a>

						@if( $order->id > 412)
						 <div class="row justify-content-center">
                            <div class="left">
                              <table border="1">
                                 <thead>
                                    <th>Ç</th>
                                    <th>İplik No/Ne</th>
                                    <th>Renk No</th>
                                    <th>Renk Adı</th>
                                    <th>B.İplik KG</th>
                                    <th>G.İplik KG</th>
                                </thead>
                                <tbody id="sortable">
                                	@foreach($order->orderdetailwarp->sortBy('sira') as $list)
                                    <tr id="item-{{$list->id}}">
                                    <td width="2">{{$list->sira}}</td>
                                    <td class="sortable"  width="70">{{$list->cinsne}}</td>
                                    <td width="70">{{$list->crenkno}}</td>
                                    <td width="70">{{$list->crenk}}</td>
                                    <td width="40">{{$list->boyanankg}}</td>
                                    <td width="40">{{$list->gelenkg}}</td>
                                    </tr>
                                    @endforeach
	                            </tbody>
                                </table>
                            </div>
                            <div class="right">
                                <table border="1">
                                   <thead>
                                    <th>A</th>
                                    <th>İplik No/Ne</th>
                                    <th>Renk No</th>
                                    <th>Renk Adı</th>
                                    <th>B.İplik KG</th>
                                    <th>G.İplik KG</th>
                                    <th>Atkı Sıklık</th>
                                   </thead>
                                   <tbody id="sortable2">
									@foreach($order->orderdetailweft->sortBy('sira') as $list)
                                    <tr id="item-{{$list->id}}">
                                    <td width="2">{{$list->sira}}</td>
                                    <td class="sortable2"  width="70">{{$list->acinsne}}</td>
                                    <td width="70">{{$list->arenkno}}</td>
                                    <td width="70">{{$list->arenk}}</td>
                                    <td width="70">{{$list->aboyanankg}}</td>
                                    <td width="40">{{$list->agelenkg}}</td>
                                    <td width="40">{{$list->asiklik}}</td>
                                     </tr>   
									@endforeach
                                   </tbody>
                                </table>
                            </div>
                        </div>      

					@else
					<table border="2">
                                <tr>
                                    <th>Ç</th>
                                      <th>İplik No/Ne</th>
                                    <th>Renk No</th>
                                    <th>Renk Adı</th>
                                    <th>B.İplik KG</th>
                                    <th>G.İplik KG</th>
                                    <th>A</th>
                                    <th>İplik No/Ne</th>
                                    <th>Renk No</th>
                                    <th>Renk Adı</th>
                                    <th>B.İplik KG</th>
                                    <th>G.İplik KG</th>
                                    <th>Atkı Sıklık</th>
                                </tr>
                            <tr>
                                    <th>1</th>
                                    <td>{{$order->orderwarp->cno1 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne1 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk1 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cgr1 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cbg1 ?? ''}}</td>
                                    <th>1 </th>
                                    <td>{{$order->orderweft->ano1 ?? ''}}</td>
                                    <td> {{$order->orderweft->ane1 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk1 ?? ''}}</td>
                                    <td>{{$order->orderweft->agr1 ?? ''}}</td>
                                    <td>{{$order->orderweft->abg1 ?? ''}}</td>
                                    <td>{{$order->orderweft->asik1 ?? ''}}</td>
                                                
                            </tr>
                           <tr>
                                    <th>2</th>
                                    <td>{{$order->orderwarp->cno2 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne2 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk2 ?? ''}}</td>      
                                    <td>{{$order->orderwarp->cgr2 ?? ''}}</td>      
                                    <td>{{$order->orderwarp->cbg2 ?? ''}}</td>      
                                    <th>2 </th>
                                    <td>{{$order->orderweft->ano2 ?? ''}}</td>
                                    <td>{{$order->orderweft->ane2 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk2 ?? ''}}</td> 
                                    <td>{{$order->orderweft->agr2 ?? ''}}</td> 
                                    <td>{{$order->orderweft->abg2 ?? ''}}</td> 
                                    <td>{{$order->orderweft->asik2 ?? ''}}</td> 
                            </tr>
                            <tr>
                                    <th>3 </th>
                                    <td>{{$order->orderwarp->cno3 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne3 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk3 ?? ''}}</td>   
                                    <td>{{$order->orderwarp->cgr3 ?? ''}}</td>   
                                    <td>{{$order->orderwarp->cbg3 ?? ''}}</td>   
                                     <th>3 </th>
                                    <td>{{$order->orderweft->ano3 ?? ''}}</td>
                                    <td>{{$order->orderweft->ane3 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk3 ?? ''}}</td>     
                                    <td>{{$order->orderweft->agr3 ?? ''}}</td>     
                                    <td>{{$order->orderweft->abg3 ?? ''}}</td>     
                                    <td>{{$order->orderweft->asik3 ?? ''}}</td>     
                            </tr>
                             <tr>
                                    <th>4 </th>
                                    <td>{{$order->orderwarp->cno4 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne4 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk4 ?? ''}}</td>  
                                    <td>{{$order->orderwarp->cgr4 ?? ''}}</td>  
                                    <td>{{$order->orderwarp->cbg4 ?? ''}}</td>  
                                     <th>4 </th>
                                    <td>{{$order->orderweft->ano4 ?? ''}}</td>
                                    <td>{{$order->orderweft->ane4 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk4 ?? ''}}</td>      
                                    <td>{{$order->orderweft->agr4 ?? ''}}</td>      
                                    <td>{{$order->orderweft->abg4 ?? ''}}</td>      
                                    <td>{{$order->orderweft->asik4 ?? ''}}</td>      
                            </tr>
                            <tr>
                                    <th>5 </th>
                                    <td>{{$order->orderwarp->cno5 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne5 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk5 ?? ''}}</td>   
                                    <td>{{$order->orderwarp->cgr5 ?? ''}}</td>   
                                    <td>{{$order->orderwarp->cbg5 ?? ''}}</td>   
                                     <th>5 </th>
                                    <td>{{$order->orderweft->ano5 ?? ''}}</td>
                                    <td>{{$order->orderweft->ane5 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk5 ?? ''}}</td>     
                                    <td>{{$order->orderweft->agr5 ?? ''}}</td>     
                                    <td>{{$order->orderweft->abg5 ?? ''}}</td>     
                                    <td>{{$order->orderweft->asik5 ?? ''}}</td>     
                            </tr>
                            <tr>
                                    <th>6 </th>
                                    <td>{{$order->orderwarp->cno6 ?? ''}}</td>
                                    <td> {{$order->orderwarp->cne6 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk6 ?? ''}}</td>     
                                    <td>{{$order->orderwarp->cgr6 ?? ''}}</td>     
                                    <td>{{$order->orderwarp->cbg6 ?? ''}}</td>     
                                     <th>6 </th>
                                    <td>{{$order->orderweft->ano6 ?? ''}}</td>
                                    <td> {{$order->orderweft->ane6 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk6 ?? ''}}</td>   
                                    <td>{{$order->orderweft->agr6 ?? ''}}</td>     
                                    <td>{{$order->orderweft->abg6 ?? ''}}</td>   
                                    <td>{{$order->orderweft->asik6 ?? ''}}</td>   
                            </tr>
                            <tr>
                                    <th>7 </th>
                                    <td>{{$order->orderwarp->cno7 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne7 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk7 ?? ''}}</td>         
                                    <td>{{$order->orderwarp->cgr7 ?? ''}}</td>         
                                    <td>{{$order->orderwarp->cbg7 ?? ''}}</td>         
                                     <th>7 </th>
                                    <td>{{$order->orderweft->ano7 ?? ''}}</td>
                                    <td>{{$order->orderweft->ane7 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk7 ?? ''}}</td> 
                                    <td>{{$order->orderweft->agr7 ?? ''}}</td> 
                                    <td>{{$order->orderweft->abg7 ?? ''}}</td> 
                                    <td>{{$order->orderweft->asik7 ?? ''}}</td> 
                            </tr>
                            <tr>
                                    <th>8 </th>
                                    <td>{{$order->orderwarp->cno8 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne8 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk8 ?? ''}}</td> 
                                    <td>{{$order->orderwarp->cgr8 ?? ''}}</td> 
                                    <td>{{$order->orderwarp->cbg8 ?? ''}}</td> 
                                     <th>8 </th>
                                    <td>{{$order->orderweft->ano8 ?? ''}}</td>
                                    <td>{{$order->orderweft->ane8 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk8 ?? ''}}</td>    
                                    <td>{{$order->orderweft->agr8 ?? ''}}</td>    
                                    <td>{{$order->orderweft->abg8 ?? ''}}</td>    
                                    <td>{{$order->orderweft->asik8 ?? ''}}</td>    
                            </tr>
                            <tr>
                                    <th>9 </th>
                                    <td>{{$order->orderwarp->cno9 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne9 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk9 ?? ''}}</td>     
                                    <td>{{$order->orderwarp->cgr9 ?? ''}}</td>     
                                    <td>{{$order->orderwarp->cbg9 ?? ''}}</td>     
                                     <th>9 </th>
                                    <td>{{$order->orderweft->ano9 ?? ''}}</td>
                                    <td>{{$order->orderweft->ane9 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk9 ?? ''}}</td>   
                                    <td>{{$order->orderweft->agr9 ?? ''}}</td>   
                                    <td>{{$order->orderweft->abg9 ?? ''}}</td>   
                                    <td>{{$order->orderweft->asik9 ?? ''}}</td>   
                            </tr>
                            <tr>
                                    <th>10</th>
                                    <td>{{$order->orderwarp->cno10 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne10 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk10 ?? ''}}</td>       
                                    <td>{{$order->orderwarp->cgr10 ?? ''}}</td>       
                                    <td>{{$order->orderwarp->cbg10 ?? ''}}</td>       
                                     <th>10</th>
                                    <td>{{$order->orderweft->ano10 ?? ''}}</td>
                                    <td>{{$order->orderweft->ane10 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk10 ?? ''}}</td> 
                                    <td>{{$order->orderweft->agr10 ?? ''}}</td> 
                                    <td>{{$order->orderweft->abg10 ?? ''}}</td> 
                                    <td>{{$order->orderweft->asik10 ?? ''}}</td> 
                            </tr>
                            <tr>
                                    <th>11</th>
                                    <td>{{$order->orderwarp->cno11 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne11 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk11 ?? ''}}</td>       
                                    <td>{{$order->orderwarp->cgr11 ?? ''}}</td>       
                                    <td>{{$order->orderwarp->cbg11 ?? ''}}</td>       
                                     <th>11</th>
                                    <td>{{$order->orderweft->ano11 ?? ''}}</td>
                                    <td>{{$order->orderweft->ane11 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk11 ?? ''}}</td> 
                                    <td>{{$order->orderweft->agr11 ?? ''}}</td> 
                                    <td>{{$order->orderweft->abg11 ?? ''}}</td> 
                                    <td>{{$order->orderweft->asik11 ?? ''}}</td> 
                            </tr>
                            <tr>
                                    <th>12</th>
                                    <td>{{$order->orderwarp->cno12 ?? ''}}</td>
                                    <td>{{$order->orderwarp->cne12 ?? ''}}</td>
                                    <td>{{$order->orderwarp->crenk12 ?? ''}}</td>   
                                    <td>{{$order->orderwarp->cgr12 ?? ''}}</td>   
                                    <td>{{$order->orderwarp->cbg12 ?? ''}}</td>   
                                    <th>12</th>
                                    <td>{{$order->orderweft->ano12 ?? ''}}</td>
                                    <td>{{$order->orderweft->ane12 ?? ''}}</td>
                                    <td>{{$order->orderweft->arenk12 ?? ''}}</td>     
                                    <td>{{$order->orderweft->agr12 ?? ''}}</td>     
                                    <td>{{$order->orderweft->abg12 ?? ''}}</td>     
                                    <td>{{$order->orderweft->asik12 ?? ''}}</td>     
                            </tr>
                        </table>  
                        		@endif

				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('css')
    <!-- CSS -->
    <link rel="stylesheet" href="/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="/css/themes/default.min.css"/>
@endsection
@section('js')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="/js/alertify.min.js"></script>
<script type="text/javascript">
	
 	$(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#sortable').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{ route('show.Sortable') }}",
                        success: function (msg) {
                            if (msg) {
                                alertify.success("İşlem Başarılı");
                            } else {
                                alertify.error("İşlem Başarısız!");
                            }
                        }

                    });
                }
            });
            $('#sortable').disableSelection();
        });


        $(function () {

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
            });

            $('#sortable2').sortable({
                revert: true,
                handle: ".sortable2",
                stop: function (event,ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{ route('show.Sortable2') }}",
                        success: function (msg) {
                            if (msg) {
                                alertify.success("İşlem Başarılı");
                            } else
                            {
                                alertify.error("İşlem Başarısız");
                            }
                        }
                    });
                }
            });

            $('#sortable2').disableSelection();

        });
</script>
@endsection
