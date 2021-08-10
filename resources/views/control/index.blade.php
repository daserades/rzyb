@extends('layouts.app')
@section('content')   
<div class="container">
    <div class="card bg-light mt-3">
       @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
        <div class="card-header">
            Dosya Aktarma 
        </div>
        <div>
            
        <div class="float-left">
            <form action="{{route('control.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Perkotek Txt Seç</label>
                <input type="file" name="file" class="form-control">
            </div>
            <center>
                <button class="btn btn-success">YÜKLE</button>
            </center>
            </form>
        </div>
      
        </div>
            
    </div>
</div>
   
@endsection
@section('js')
<script type="text/javascript">
    
//     $("#checkAll").click(function(){
//     $('input:checkbox').not(this).prop('checked', this.checked);
// });

</script>
@endsection