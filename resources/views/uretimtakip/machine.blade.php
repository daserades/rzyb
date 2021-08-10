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
    @foreach($machine as $list)
    <br>
  <table border="1" width="380" class="table">
  <tr><th colspan="2">BAYZARA TEKSTİL</th></tr>
  <tr>
  <td colspan="2"><b><center>Makina No 
      {{ $list->name ?? ''}}
  </td>
  </tr>
  <tr>
  <td colspan="2"><center>{!! QrCode::size(290)->generate($list->name); !!}</td>
</tr>
  </table>
  @endforeach
  </body>
  </html>

  
  <script type="text/javascript">
  
  setTimeout( function() {
   history.go(-1);
   }, 1000);
  </script>