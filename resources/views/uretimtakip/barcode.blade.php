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
  <table border="2" width="400" height="443" class="table">
  <tr><th colspan="2">BAYZARA TEKSTİL ({{date('d-m-Y',strtotime($ball->created_at ?? ''))}})</th></tr>
  <tr>
  <td colspan="2"><center>{!! QrCode::size(130)->generate($ball->barcode); !!}</td>
  </tr>
  <tr>
    <td>Top No:</td>
    <td> {{$ball->barcode}} </td>
  </tr>
  <tr>
    <td>Sipariş No:</td>
    <td>{{$ball->order->order_no}}</td>
  </tr>
  <tr>
    <td>Desen No:</td>
    <td>{{$ball->order->desenadi}}</td>
  </tr>
  <tr>
    <td>Levent No:</td>
    <td>{{$ball->levent_barcode}}</td>
  </tr>
  <tr>
    <td>Makina No:</td>
    <td>{{$ball->machine->name}}</td>
  </tr>
  </table>
  <button id="btn" style="width: 100px; height: 100px;" onclick="goBack()">Geri</button>
  </body>
  </html>
  <script type="text/javascript">
  
  setTimeout( function() {
     window.location = "{{url('uretimtakip/uretimtakip/create')}}";  
   //history.go(-1);
   }, 1000);
   function goBack() {
    window.history.back();
  }
  </script>