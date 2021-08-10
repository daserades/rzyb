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

    #iplik{
    font-size: 10px;
    }

    @media print {
          #btn {
      display :  none;
    }
  }
  </style>
  <body onload="window.print()"><br>
  <table border="1" width="380" class="table">
  <tr><th colspan="2">BAYZARA TEKSTİL ({{date('d-m-Y',strtotime($leventdepo->created_at ?? ''))}})</th></tr>
  <tr>
  <td><b><center>Sipariş No<br>
    @isset($leventdepo->order->order_no)
    {{mb_substr($leventdepo->order->order_no,0,4)}} {{mb_substr($leventdepo->order->order_no,4,2)}} {{mb_substr($leventdepo->order->order_no,6,4)}}
    @endisset
  </td>
  <td><center>{!! QrCode::size(100)->generate($leventdepo->barcode); !!} <br> No:{{$leventdepo->barcode}}</td>
</tr>
  <tr>
    <td>
      Levent No
    </td>
    <td>
      {{$leventdepo->leventno}}
    </td>
  </tr>
  <tr>
    <td>
      Çözgü Tel Sayısı
    </td>
    <td>
      {{$leventdepo->telsayi}}
    </td>
  </tr>
  <tr>
    <td>
      Levent Eni
    </td>
    <td>
      {{$leventdepo->leventeni}}
    </td>
  </tr>
  <tr>
    <td>
      Metraj
    </td>
    <td>
      {{$leventdepo->metraj}}
    </td>
  </tr>
  <tr>
    <td>
      KG
    </td>
    <td>
      {{$leventdepo->kg}}
    </td>
  </tr>
<tr>
  <td colspan="2" height="70" id="iplik">
    <p>
    <b>İplikler</b>
    @isset($leventdepo->order->orderdetailwarp)
    @foreach($leventdepo->order->orderdetailwarp as $liste)
    {{'('.$liste->cinsne.'/'.$liste->crenkno.')'}}
    @endforeach
    @endisset
  </p>
  </td>
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