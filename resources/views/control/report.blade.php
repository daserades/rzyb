@extends('layouts.app')

@section('content')
	<div>
		<div >
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
			 <div align="center">{{ __('Mola Alanı Rapor') }}
			</div>
			<div class="col-md-6">
                        <form action="{{route('reportpost')}}" method="post">
                        	@csrf
                            <div class="input-group">
                            	<select name='personel_id' id="personel_id" class="form-control  @error('personel_id') is-invalid @enderror" required>
                                        <option value="">Personel Seçiniz..</option>
                                        @foreach ($personel as $list)
                                            <option value="{{$list->id}}">{{$list->name}} {{$list->surname}}</option>
                                        @endforeach
                                </select>
                                Başlangıç Tarih = <input type="date" name="gtrh" class="form-control" placeholder="Sipariş No" required>
                                Bitiş Tarih = <input type="date" name="ctrh" class="form-control" placeholder="Sipariş No">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
				<div class="panel body">
					<center>
					<table id="table" class="table table-hover table-striped" border="2">
						<thead>
							<tr>
								<th>Kart No</th>
								<th>Personel Ad Soyad</th>
								<th>Giriş Zamanı</th>
								<th></th>
								<th>Çıkış Zamanı</th>
								<th></th>
								<th>Geçen Zaman</th>
							</tr>
						</thead>
						<tbody>
								@php $t=0; $minutes=0; $seconds=0; $i=0; $s=0; @endphp
							@isset($data) 
							@foreach ($data as $list)
								<tr>
									<td>{{$list[0]['personel']['no'] ?? ''}} </td>
									<td>{{$list[0]['personel']['name'] ?? ''}} {{$list[0]['personel']['surname'] ?? ''}} </td>
									<td>{{ date('d-m-Y H:i:s',strtotime($list[0]['gtrh'])) ?? ''}} </td>
									<td>&nbsp;&nbsp; </td>
									@if($list[0]['ctrh'] > 0)<td>{{date('d-m-Y H:i:s',strtotime($list[0]['ctrh'])) ?? ''}} </td> @else <td bgcolor="red"></td> @endif 
									<td>&nbsp; &nbsp; </td>
									@if($list[0]['ctrh'] > 0)<td>{{ $s= date('H:i:s', strtotime($list[0]['fark'])) ?? ''}} </td> @else <td>@php $s='00:00:00'; @endphp </td> @endif
									@php 
									list($hour, $minute, $second) = explode(':', $s);
								        $minutes += $hour * 60;
								        $minutes += $minute;
								        $seconds += $second;
									@endphp
								</tr>
							@endforeach
							@endisset
								@php  $hours = floor($minutes / 60);
								      $minutes -= $hours * 60;
								      $minute = floor($seconds /60);
								      $minutes += $minute;
								      $second = $seconds%60; 
								    @endphp
							<tr>
								<td colspan="6">Toplam</td>
								<td>{{ sprintf('%02d:%02d:%02d', $hours, $minutes,$second)}} </td>
							</tr>
						</tbody>
					
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<style type="text/css">
    	/*th { font-size: 12px; }
    	td {
    		 font-size: 12px; 
    		font-weight: bold;
    	}*/
    	tr:hover td {background:#FF7F50}
    	
			
    </style>
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script>
    $('#personel_id').select2({ width: '320px' });
</script>
@endsection
