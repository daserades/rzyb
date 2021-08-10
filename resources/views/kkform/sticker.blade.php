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
  <tr><th colspan="2">BAYZARA TEKSTİL ({{date('d-m-Y',strtotime($kkform->created_at ?? ''))}})</th></tr>
  <tr>
  <td colspan="2"><center>{!! QrCode::size(110)->generate($kkform->barcode); !!}</td>
  </tr>
  <tr>
    <td>Top No:</td>
    <td> {{$kkform->barcode}} </td>
  </tr>
  <tr>
    <td>Sipariş No:</td>
    <td>{{$kkform->order->order_no}}</td>
  </tr>
  <tr>
    <td>Desen Adı:</td>
    <td>{{$kkform->order->desen->name ?? ''}}</td>
  </tr>
  <tr>
    <td>Desen No:</td>
    <td>{{$kkform->order->desenadi ?? ''}}</td>
  </tr>
  <tr>
    <td>Makina No:</td>
    <td>{{$kkform->machine->name ?? ''}}</td>
  </tr>
  <tr>
    <td>Metresi:</td>
    <td>{{$kkform->metre}}</td>
  </tr>
  <tr>
    <td>Brüt Metresi:</td>
    <td>{{$kkform->brutmetre}}</td>
  </tr>
  <tr>
    <td>Kumaş Eni:</td>
    <td>{{$kkform->kumaseni}}</td>
  </tr>
  <tr>
    <td>Ebat:</td>
    <td>{{$kkform->ebat}}</td>
  </tr>
  </table>
  <button id="btn" style="width: 100px; height: 100px;" onclick="goBack()">Geri</button>
  </body>
  </html>
  <script type="text/javascript">
  
  setTimeout( function() {
   history.go(-1);
   }, 1000);
   function goBack() {
    window.history.back();
  }
  </script>