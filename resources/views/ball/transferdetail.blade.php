@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Top Aktarma') }}</div>

                @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                @elseif($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                @endif      
                <div class="card-body">
                    <form method="POST"  action="{{route('transferstore')}}">
                        @csrf
                        <div class="form-group row">
                                Seçilen Sipariş= {{$demand->oldorder->order_no}} <input type="hidden" name="oldorder_no" value="{{$demand->oldorder->order_no}} ">
                                 Aktarılacak Sipariş= {{$demand->order->order_no}} <input type="hidden" name="order_no" value="{{$demand->order->order_no}} ">
                              </div>
                        <div class="form-group row">
                            <label for="barcode" class="col-md-4 col-form-label text-md-right">{{ __('Aktarılacak Kumaş Barkodunu Okutunuz') }}</label>

                            <div class="col-md-8">
                                <input id="barcode" type="password" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="" required autocomplete="barcode" autofocus>
                                <input type="hidden" name="oldorder_id" value="{{$demand->oldorder_id}} ">
                                <input type="hidden" name="order_id" value="{{$demand->order_id}} ">

                                @error('barcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Devam Et') }}
                                </button>
                            </div>
                        </div>
                    </form> <br><center>
                    <table class="table-striped table-hover" border="1">
                        <tr>
                                <th colspan="10">Aktarılan Kumaşlar(Toplar)</th>
                            </tr>    
                        <tr>
                                <td>Barcode</td>
                                <td>Top no </td>
                                <td>Metre</td>
                                <td>Brut Metre</td>
                                <td>Kumaş Eni</td>
                                <td>KG</td>
                                <td>Makina No</td>
                                <td>Ebat</td>
                                <td>Tarih</td>
                        </tr>
                        @php $toplam=0;  $hatayuzdesi=0; @endphp 
                        @isset($ball)
                        @foreach ($ball as $list)
                        <tr>
                            <td><a href="{{route('ballerror',$list->id)}}"> {{ $list->barcode }}</a></td>
                            <td>{{ $list->type }}</td>
                            <td>{{ $list->metre }}</td>
                            <td>{{ $list->brutmetre }}</td>
                            <td>{{ $list->kumaseni }}</td>
                            <td>{{ $list->kg }}</td>
                            <td>{{ $list->machine->name ?? ''}}</td>
                            <td>{{ $list->ebat }}</td>
                            <td>{{ $list->trh }}</td>

                        </tr>
                        @php $toplam += $list->metre;  @endphp
                        @endforeach @endisset

                        <tr>
                            <td colspan="1">Toplam</td> 
                            <td> {{ count($ball) }} top </td> 
                            <td> {{$toplam }} metre </td> 
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    
            /*
        $("input[id=barcode]").change(function(){
            $id=$(this).val();
             if(id){
                
                 window.open('{{url('/kkform/kabul')}}/'+id); 
            $.ajax({
             type:"get",
             url:'{{url('/kkform/kabul')}}/'+id, 
             success:function(res)
             {     var kayitSay = res.length;  
                if(kayitSay > 0)
                    {//console.log; 
                         $("textarea[name='adres']").empty();
                         $("textarea[name='adres']").append(res[0].adres1);
                        }
                        else {
                           //$("textarea[name='adres']").empty();
                          // $("input[name='vade").val('');
                           $("textarea[name='adres']").val('');
                            }
                   }
               });
        }

    });
               */
</script>

@endsection