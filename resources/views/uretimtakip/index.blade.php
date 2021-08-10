@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('Üretim Takip') }}</div> 
                <div class="card-body">
                    <table class="table" border="1">
                        <tbody>
                        <tr>
                            @foreach($machine as $deger)
                            @if( ($loop->iteration % 5) == 0)
                            <td>
                                <center>{{$deger->name}}</center><br>
                                    @if($deger->type==1)<center><input type="image" id="{{$deger->name}}" name="machine_id" src="{{ Storage::url('icons/jak.jpg') }}" width="80" height="100"/></center>
                                    @else <center><input type="image" id="{{$deger->name}}" name="machine_id" src="{{ Storage::url('icons/jakar.png') }}" width="100" height="80"/></center>
                                    @endif
                                    <center><label id="barcode{{$deger->name}}">{{$uretimtakip->where('machine_id',$deger->name)->pluck('barcode')->first() }}</label><br></center>
                                    <center><label>{{$uretimtakip->where('machine_id',$deger->name)->pluck('order.order_no')->first() }}</label></center>
                            </td>
                        </tr>
                        @else 
                        <td>
                            <center>{{$deger->name}}</center><br>
                              @if($deger->type==1)<center><input type="image" id="{{$deger->name}}" name="machine_id" src="{{ Storage::url('icons/jak.jpg') }}" width="80" height="100"/></center>
                                    @else <center><input type="image" id="{{$deger->name}}" name="machine_id" src="{{ Storage::url('icons/jakar.png') }}" width="100" height="80"/></center>
                                    @endif
                                <center><label id="barcode{{$deger->name}}">{{$uretimtakip->where('machine_id',$deger->name)->pluck('barcode')->first() }}</label><br></center>
                                <center><label>{{$uretimtakip->where('machine_id',$deger->name)->pluck('order.order_no')->first() }}</label></center>
                        </td>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<!--
<div id="dialog" title="Levent Gir">
  <label for="name">MAKİNA NO= </label>
  <label id="makinano" for="makinano"></label><br>
  <label id="leventbar" for="leventbar"></label>
  
  <form>
    <fieldset>
      <div class="form-group row" id="levent">
        <label for="leventdepo_id" class="col-md-4 col-form-label text-md-right">{{ __('Levent No Seçiniz') }}</label>

        <div class="col-md-6">
            <select name='leventdepo_id' id="leventdepo_id" class="form-control  @error('leventdepo_id') is-invalid @enderror">
                <option value="">Seçiniz..</option>
                @-foreach ($leventdepo as $list)
                <option value="{{--$list->id}}">{{$list->barcode--}}</option>
                @-endforeach
            </select>
            @-error('leventdepo_id')
            <span class="invalid-feedback" role="alert">
            </span>
            @-enderror
        </div>
    </div>  
 <input type="submit" tabindex="-1" style="position:absolute; top:-1000px"> 
    <center>
        <a href="#" id="stop" style="color:black" title="DURDUR"><i class="fas fa-stop fa-3x"></i></a>&nbsp; &nbsp; &nbsp; 
        <a href="#" id="play" style="color:black" title="BAŞLAT"><i class="fas fa-play fa-3x"></i></a>
    </center>
</fieldset>
</form>
</div>
-->
@endsection

@section('css')
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script type="text/javascript">

    $("input[type=image]").click(function(){
        machine_id=$(this).attr('id');
        $(location).attr('href', '{{ url('uretimtakip/create1') }}/'+machine_id);
    //location.reload();
});

   /* 
    dialog = $( "#dialog" ).dialog({
      autoOpen: false,
      height: 400,
      width: 500,
      modal: true,
      show: {
        effect: "explode",
        duration: 300
    },
    hide: {
        effect: "explode",
        duration: 300
    },
    buttons: {
        Cancel: function() {
          dialog.dialog( "close" );

      }
  }
});

    $("input[type=image]").click(function(){
        machine_id= $(this).attr('id');
        barcode=$("#barcode"+machine_id).text();
        if(barcode)
        {
            $("#leventbar").show();
            $('#play,#levent').hide();
            $('#stop').show();
            //var label = $("<br>BARCODE = <label id='barcode'>").text(barcode);
            //$(label).insertAfter( "#makinano" );
            $("#leventbar").text(barcode);
        }
        else
        {
            $("#leventbar").hide();
            $('#play,#levent').show();
            $('#stop').hide();
        }
        $( "#dialog" ).dialog( "open" );
        $("#makinano").text(machine_id);
        //$("select[name='leventdepo_id']").append('<option selected>'+barcode+'</option>');

    });

    $("#play").click(function(){
        machine_id=$("#makinano").text();
        barcode=$("#leventdepo_id option:selected").text();
        leventdepo_id=$("#leventdepo_id option:selected").attr('id');
        $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
        sayfa = '{{ route('uretimtakip.store') }}';
        $.post(sayfa, {leventdepo_id:leventdepo_id,barcode:barcode,machine_id:machine_id}, function(data) {
          dialog.dialog( "close" );
          location.reload();
      });

    });

    $("#stop").click(function(){
        machine_id=$("#makinano").text();
        //barcode=$("#barcode").text();
        leventdepo_id=$("#leventdepo_id option:selected").attr('id');
        $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
        sayfa = '{{ route('stop') }}';
        $.post(sayfa, {leventdepo_id:leventdepo_id,barcode:barcode,machine_id:machine_id}, function(data) {
          dialog.dialog( "close" );
          location.reload();
      });
    });
    */

</script>
@endsection
