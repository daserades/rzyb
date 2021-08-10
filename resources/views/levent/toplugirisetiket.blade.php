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
  <body onload="window.print()">
    @isset($leventirsaliye->leventhareket)
    @foreach($leventirsaliye->leventhareket as $list)
    <br>
  <table border="1" width="380">
  <tr><th colspan="2">BAYZARA TEKSTİL ({{date('d-m-Y',strtotime($list->created_at ?? ''))}})</th></tr>
  <tr>
  <td><b><center>Sipariş No<br>@isset($list->order->order_no) {{mb_substr($list->order->order_no,0,4)}} {{mb_substr($list->order->order_no,4,2)}} {{mb_substr($list->order->order_no,6,4)}} @endisset</td>
  <td><center>{!! QrCode::size(100)->generate($list->barcode); !!} <br> No:{{$list->barcode}}</td>
  </tr>
  <tr>
    <td>
      Levent No
    </td>
    <td>
      {{$list->leventno}}
    </td>
  </tr>
  <tr>
    <td>
     Çözgü Tel Sayısı
    </td>
    <td>
      {{$list->telsayi}}
    </td>
  </tr>
  <tr>
    <td>
      Levent Eni
    </td>
    <td>
      {{$list->leventeni}}
    </td>
  </tr>
  <tr>
    <td>
      Metraj
    </td>
    <td>
      {{$list->metraj}}
    </td>
  </tr>
  <tr>
    <td>
      KG
    </td>
    <td>
      {{$list->kg}}
    </td>
  </tr>
  <tr>
  <td colspan="2" height="70" id="iplik">
    <b>İplikler =</b>
    @isset($list->order->orderdetailwarp)
    @foreach($list->order->orderdetailwarp as $liste)
    {{'('.$liste->cinsne.'/'.$liste->crenkno.')'}}
    @endforeach
    @endisset
  </td>
  </tr>
  </table>
  @endforeach
  @endisset
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