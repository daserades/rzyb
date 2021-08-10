<!DOCTYPE html>
    <html>
    <head>
    <title>ASD</title>
    </head>
    <style type="text/css">
    body{
      margin-top:0px;
      margin-left:0px;
    }

    @media print {
          #btn {
      display :  none;
    }
  }
  </style>
  <body onload="window.print()">
@foreach($ball as $list)
  <table border="2" width="400" height="443" class="table">
  <tr><th colspan="2">BAYZARA TEKSTİL ({{date('d-m-Y',strtotime($list->created_at ?? ''))}})</th></tr>
  <tr>
  <td colspan="2"><center>{!! QrCode::size(130)->generate($list->barcode); !!}</td>
  </tr>
  <tr>
    <td>Top No:</td>
    <td> {{$list->barcode ?? ''}} </td>
  </tr>
  <tr>
    <td>Sipariş No:</td>
    <td>{{$list->order->order_no ?? ''}}</td>
  </tr>
  <tr>
    <td>Desen No:</td>
    <td>{{$list->order->desenadi}}</td>
  </tr>
  <tr>
    <td>Makina No:</td>
    <td>{{$list->machine->name ?? ''}}</td>
  </tr>
  <tr>
    <td>Metresi:</td>
    <td>{{$list->metre}}</td>
  </tr>
  <tr>
    <td>Brüt Metresi:</td>
    <td>{{$list->brutmetre}}</td>
  </tr>
  <tr>
    <td>Kumaş Eni:</td>
    <td>{{$list->kumaseni}}</td>
  </tr>
  <tr>
    <td>Ebat:</td>
    <td>{{$list->ebat}}</td>
  </tr>
  </table>
@endforeach
  <button id="btn" style="width: 100px; height: 100px;" onclick="goBack()">Geri</button>
  </body>
  </html>
  <script src="http://bayzara.s/js/app.js"></script>
  <script type="text/javascript">
  setTimeout( function() {
    {{-- sayfa = '{{ url('kkform/kabul') }}/'+barcode; window.location.href = sayfa; --}}
   history.go(-1);
   }, 1000);

  </script>
