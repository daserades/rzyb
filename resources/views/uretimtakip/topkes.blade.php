@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Top Kes Ekranı') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST"  action="{{route('topkes')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="machine_id" class="col-md-4 col-form-label text-md-right">{{ __('Makina Barkodunu Okutunuz') }}</label>

                            <div class="col-md-8">
                                <input id="machine_id" type="password" class="form-control @error('machine_id') is-invalid @enderror" name="machine_id" value="" required autocomplete="machine_id" autofocus>

                                @error('machine_id')
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
                    </form>
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