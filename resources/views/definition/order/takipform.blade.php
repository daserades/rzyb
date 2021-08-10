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
				<div class="card-header">{{ __('Üretim Takip Formu') }}</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<div class="card-body">
					<table  border="2" width="900"> 
					<tr><td colspan="1">
						<label for="order_no" class="col-md-12 col-form-label text-md-center"><font size="6">{{ __('Sipariş No:  ') }} 
							@if(Str::length($order->firma->zarano)<=2 )
							{{ mb_substr($order->order_no,0,4).'-'.mb_substr($order->order_no,4,2).'-'.mb_substr($order->order_no,6) }}
							@else
							{{ mb_substr($order->order_no,0,4).'-'.mb_substr($order->order_no,4,3).'-'.mb_substr($order->order_no,7) }}
							@endif
						</font></label>
					</td>

					<td rowspan="2"><center>
						Çıktı Tarihi: {{date('d-m-Y',strtotime(now()))}}<br>
						{!! QrCode::size(100)->generate($order->id ?? ''); !!}
					</center>
					</td>
				</tr>
					<tr>
						<td colspan="1"><input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">	
						<label for="desenadi" class="col-md-12 col-form-label text-md-left"><font size="6">{{ __('Tezgah No  :')   }} 
									<select name='machine_id' id="machine_id">
                                        <option value="">Seçiniz..</option>
                                            @foreach($machine as $mac)
                                        		<option value="{{$mac->id}}">{{$mac->name}}</option>
											@endforeach
                                    </select>

                               {{$order->machineplan->machine->name ?? ''}}
						 </font></label>	
					</td>
					</tr>
					<tr>
						<td>	
						<label for="desenadi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('Desen Adı  :')   }}<b>&nbsp;{{ $order->desenadi }}</font></b></label>	
					</td>
					<td rowspan="5">
						<?php 
					if(file_exists('storage/uploads/'.$order->order_no)){
					$klasor = opendir( 'storage/uploads/'.$order->order_no);
					    while (false !== ($girdi = readdir($klasor))) {
					        if ($girdi != "." && $girdi != "..") {
					        	$ext = pathinfo($girdi);
					        	$uzanti= $ext['extension']; $namedosya=basename($girdi);
					     ?>
					<img src="{{ Storage::url('uploads/'.$order->order_no.'/'.$namedosya) }}" width="340" height="150"/>	
					<br>
					           <?php
					        }
					    }
					    closedir($klasor);
					}
					?> 
					</td>
					</tr>
					<tr>
						<td>	
						<label for="desen->no" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('Desen No  :')   }}<b>&nbsp;{{ $order->desen->no ?? ''}}</font></b></label>	
					</td>
					</tr>
					<tr><td>	
						<label for="cts" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('Çözgü Tel Sayısı  :')   }}<b>&nbsp;{{ $order->cts }}</font></b></label>	
					</td>
				</tr>
					<tr><td>	
						<label for="tarakeni" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('Tarak Eni  :')   }}<b>&nbsp;{{ $order->tarakeni }}</font></b></label>	
					</td>
				</tr>
					<tr><td>	
						<label for="tarakno" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('Tarak No  :')   }}<b>&nbsp;{{ $order->tarakno }}</font></b></label>	
					</td>
				</tr>
					<tr><td>	
						<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('Atkı Sıklığı:  ') }}<b>&nbsp;{{ $order->atkisikligi }}</font></b></label>	
					</td>
					<td>	
						<label for="kenarcinsi_id" class="col-md-12 col-form-label text-md-left"><font size="3">{{ __('Kenar Cinsi:  ') }}<b>&nbsp;{{ $order->kenarcinsi->name ?? ''}}</font></b></label>	
					</td>
					</tr>
					<tr><td>	
						<label for="cozgumetraji" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('Çözgü Metrajı:  ') }}<b>&nbsp;{{ $order->cozgumetraji }}mt.</font></b></label>	
					</td>
					<td>	
						<label for="kalite" class="col-md-12 col-form-label text-md-left"><font size="3">{{ __('Kalite:  ') }}<b>&nbsp;{{ $order->kalite ?? ''}}</font></b></label>	
					</td>
					</tr>

						@if( $order->id > 364)
						
                                	@foreach($order->orderdetailwarp as $list)
                                    <tr>
                                    <td colspan="2">
						<label for="cozgumetraji" class="col-md-12 col-form-label text-md-left"><font size="5">{{ $list->sira.'.Çözgü İplik No:  ' }}&nbsp;{{ $list->cinsne.' '.$list->crenkno.' '.$list->crenk.' '.$list->boyanankg }}</font></label>	
                                    </td>
                                	</tr>
                                    @endforeach
                                    <tr bgcolor="red">
                                    	<td colspan="2">&nbsp;</td>
                                    </tr>
									@foreach($order->orderdetailweft as $list)
                                    <tr>
                                    <td colspan="2">
						<label for="cozgumetraji" class="col-md-12 col-form-label text-md-left"><font size="5"><b>{{ $list->sira.'.ATKI İplik No:  ' }}&nbsp;{{ $list->acinsne.' '.$list->arenkno.' '.$list->arenk.' '.$list->aboyanankg }}</font></b></label>	
                                    </td>
                                	</tr>
									@endforeach
                                
					@else


					@isset($order->orderwarp->cno1)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('1.Çözgü İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderwarp->cno1.' '.$order->orderwarp->cne1.' '.$order->orderwarp->crenk1. ' '. $order->orderwarp->cgr1.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderwarp->cno2)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('2.Çözgü İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderwarp->cno2.' '.$order->orderwarp->cne2.' '.$order->orderwarp->crenk2. ' '. $order->orderwarp->cgr2.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderwarp->cno3)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('3.Çözgü İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderwarp->cno3.' '.$order->orderwarp->cne3.' '.$order->orderwarp->crenk3. ' '. $order->orderwarp->cgr3.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderwarp->cno4)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('4.Çözgü İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderwarp->cno4.' '.$order->orderwarp->cne4.' '.$order->orderwarp->crenk4. ' '. $order->orderwarp->cgr4.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderwarp->cno5)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('5.Çözgü İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderwarp->cno5.' '.$order->orderwarp->cne5.' '.$order->orderwarp->crenk5. ' '. $order->orderwarp->cgr5.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderwarp->cno6)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('6.Çözgü İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderwarp->cno6.' '.$order->orderwarp->cne6.' '.$order->orderwarp->crenk6. ' '. $order->orderwarp->cgr6.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderwarp->cno7)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('7.Çözgü İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderwarp->cno7.' '.$order->orderwarp->cne7.' '.$order->orderwarp->crenk7. ' '. $order->orderwarp->cgr7.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderwarp->cno8)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('8.Çözgü İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderwarp->cno8.' '.$order->orderwarp->cne8.' '.$order->orderwarp->crenk8. ' '. $order->orderwarp->cgr8.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderwarp->cno9)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('9.Çözgü İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderwarp->cno9.' '.$order->orderwarp->cne9.' '.$order->orderwarp->crenk9. ' '. $order->orderwarp->cgr9.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderweft->ano1)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('1.Atkı İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderweft->ano1.' '.$order->orderweft->ane1.' '.$order->orderweft->arenk1. ' '. $order->orderweft->agr1.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderweft->ano2)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('2.Atkı İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderweft->ano2.' '.$order->orderweft->ane2.' '.$order->orderweft->arenk2. ' '. $order->orderweft->agr2.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderweft->ano3)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('3.Atkı İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderweft->ano3.' '.$order->orderweft->ane3.' '.$order->orderweft->arenk3. ' '. $order->orderweft->agr3.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderweft->ano4)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('4.Atkı İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderweft->ano4.' '.$order->orderweft->ane4.' '.$order->orderweft->arenk4. ' '. $order->orderweft->agr4.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderweft->ano5)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('5.Atkı İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderweft->ano5.' '.$order->orderweft->ane5.' '.$order->orderweft->arenk5. ' '. $order->orderweft->agr5.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderweft->ano6)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('6.Atkı İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderweft->ano6.' '.$order->orderweft->ane6.' '.$order->orderweft->arenk6. ' '. $order->orderweft->agr6.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderweft->ano7)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('7.Atkı İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderweft->ano7.' '.$order->orderweft->ane7.' '.$order->orderweft->arenk7. ' '. $order->orderweft->agr7.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderweft->ano8)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('8.Atkı İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderweft->ano8.' '.$order->orderweft->ane8.' '.$order->orderweft->arenk8. ' '. $order->orderweft->agr8.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset
					@isset($order->orderweft->ano9)
					<tr>
						<td colspan="2">	
							<label for="atkisikligi" class="col-md-12 col-form-label text-md-left"><font size="5">{{ __('9.Atkı İplik No:  ') }}<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $order->orderweft->ano9.' '.$order->orderweft->ane9.' '.$order->orderweft->arenk9. ' '. $order->orderweft->agr9.'kg' }}</font></b></label>	
						</td>
					</tr>
					@endisset

					@endif
					<tr><td colspan="2">
						<label for="aciklama1" class="col-md-12 col-form-label text-md-left"><font size="4">{{ __('Açıklama1  :  ') }}{{ $order->aciklama1 }}</label>	
					</td></tr><tr><td colspan="2">	
						
						<label for="aciklama2" class="col-md-12 col-form-label text-md-left"><font size="4">{{ __('Açıklama2  :  ') }}{{ $order->aciklama2 }}</label>	

					</td></tr>					
					<tr><td colspan="2">	
						
						<label for="aciklama2" class="col-md-12 col-form-label text-md-left"><font size="4">{{ __('Açıklama3  :  ') }}{{ $order->aciklama3 }}</label>	

					</td></tr>					
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('css')
<style type="text/css">
   @media print {
      #machine_id {
        display :  none;
    }

}
</style>
@endsection
@section('js')
<script type="text/javascript">
	$('select[id=machine_id]').change(function(){
        $(this).toggle( "highlight" );
        machine_id= $(this).val();
        order_id= $('#order_id').val();
            $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            sayfa = '{{ route('machine') }}';
            $.post(sayfa, { machine_id:machine_id , order_id:order_id }, function(data) {
            	console.log('asd');
            	location.reload();
                $("#machine_id").toggle( "highlight" );
            });
     });
</script>
@endsection