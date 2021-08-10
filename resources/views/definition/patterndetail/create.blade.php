@extends('layouts.app')
@section('content')
<div class="container">

    <h4 align="center">İplik Girişi</h4>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <form method="post" class="form-group" action="{{ route('patterndetail.store') }}"  enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
         <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Desen Adı</label>
                 <div class="col-md-6">
                @foreach ($desen as $list)
                <label  for="desen_id" value="{{$list->id}}"><h3>{{$list->name}}</h3></label>
                <input type="hidden" class="form-control" id="desen_id" name='desen_id' value="{{$list->id}}">
                @endforeach
            </div>
        </div>
       <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">İplik</label>
            <div class="col-md-12">
                <select name='iplikseridi_id' class="form-control  @error('iplikseridi_id') is-invalid @enderror" required>
                    <option value="">Seçiniz..</option>
                    @foreach ($iplikseridi as $list)
                    @if(old('iplikseridi_id')== $list->id)
                    <option value="{{$list->id}}" id="iplikseridi_id" selected>{{$list->name}}</option>
                    @else
                    <option value="{{$list->id}}" id="iplikseridi_id">{{$list->name}}</option>
                    @endif
                    @endforeach
                </select>
                @error('iplikseridi_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div> 
        <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
            <label class="control-label col-md-6 col-sm-3 col-xs-12" for="first-name">İplik Cinsi</label>
            <div class="col-md-12">
                <select name='iplikcins_id' class="form-control  @error('iplikcins_id') is-invalid @enderror" required>
                    <option value="">Seçiniz..</option>
                    @foreach ($iplikcins as $list)
                    @if(old('iplikcins_id')== $list->id)
                    <option value="{{$list->id}}" id="iplikcins_id" selected>{{$list->name}}</option>
                    @else
                    <option value="{{$list->id}}" id="iplikcins_id">{{$list->name}}</option>
                    @endif
                    @endforeach
                </select>
                @error('iplikcins_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div> 
        <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
            <label class="control-label col-md-6 col-sm-3 col-xs-12" for="first-name">İplik Boya Cinsi</label>
            <div class="col-md-12">
                <select name='boyacins_id' class="form-control  @error('boyacins_id') is-invalid @enderror"  >
                    <option value="">Seçiniz..</option>
                    @foreach ($boyacins as $list)
                     @if(old('boyacins_id')== $list->id)
                    <option value="{{$list->id}}" selected>{{$list->name}}</option>
                    @else
                    <option value="{{$list->id}}" id="boyacins_id">{{$list->name}}</option>
                    @endif
                    @endforeach
                </select>
                @error('boyacins_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div> 
        <div class="col-md-3 col-sm-4 col-xs-8 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">İplik No</label>
                <input type="text" class="form-control" id="iplik_no" name='iplik_no' value="{{old('iplik_no')}}" placeholder="İplik No">
            </div>
        <div class="col-md-1 col-sm-2 col-xs-4 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">NE</label>
                <input type="text" value="{{old('iplik_kalin')}}" class="form-control" id="iplik_kalin" name='iplik_kalin' placeholder="NE">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Renk No</label>
                <input type="text" class="form-control" id="renk_no" name='renk_no' value="{{old('renk_no')}}" placeholder="Renk No">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Renk</label>
                <input type="text" class="form-control" id="renk" name='renk' value="{{old('renk')}}" placeholder="Renk">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">K.Tel Sayısı</label>
                <input type="text" class="form-control" id="renk_sayisi" name='renk_sayisi' value="{{old('renk_sayisi')}}" placeholder="Kullanılan Tel Sayısı">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Atkı Sıklığı</label>
                <input type="text" class="form-control" id="atki_sikligi" name='atki_sikligi' value="{{old('atki_sikligi')}}" placeholder="Atkı Sıklığı (Ör:20.3)">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Çözgü Sıklığı</label>
                <input type="text" class="form-control" id="cozgu_sikligi" name='cozgu_sikligi' value="{{old('cozgu_sikligi')}}" placeholder="Çözgü Sıklığı (Ör:20.3)">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Tekrar</label>
                <input type="text" class="form-control" id="tekrar" name='tekrar' value="{{old('tekrar')}}" placeholder="Tekrar Sayısı">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Boş Atkı S.</label>
                <input type="text" class="form-control" id="bos_atki_sayisi" name='bos_atki_sayisi' value="{{old('bos_atki_sayisi')}}" placeholder="Boş Atkı Sayısı">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Aynı Ağıza Atılan A.S.</label>
                <input type="text" class="form-control" id="ayni_agiza_atilan_atki_sayisi" name='ayni_agiza_atilan_atki_sayisi' value="{{old('ayni_agiza_atilan_atki_sayisi')}}" placeholder="ayni_agiza_atilan_atki_sayisi">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Açıklama</label>
                <textarea type="text" class="form-control" id="aciklama" name='aciklama' value="{{old('aciklama')}}" placeholder="Açıklama"></textarea>
            </div>

    </div> 

    <div align="center"  class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
            <button type="submit" class="btn btn-success">Kaydet</button>
        </div>
    </div>
</form>
<div class="card-body">
                        <div class="card-header text-md-center"><H2>{{ __('İPLİK ÇEŞİTLERİ') }}</H2></div>
                <table id="datatable" border="2">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h6></h6></td>
                                <td><h6>İplik </h6></td>
                                <td><h6>İplik No</h6></td>
                                <td><h6>İplik Cinsi</h6></td>
                                <td><h6>Boya Cinsi</h6></td>
                                <td><h6>Renk No</h6></td>
                                <td><h6>Renk</h6></td>
                                <td><h6>K.Tel S.</h6></td>
                                <td><h6>Harf</h6></td>
                                <td><h6>Atkı Sıklığı</h6></td>
                                <td><h6>Çözgü Sıklığı</h6></td>
                                <td><h6>Tekrar</h6></td>
                                <td><h6>Boş Atkı S.</h6></td>
                                <td><h6>Aynı Ağıza Atılan A.S.</h6></td>
                                <td colspan="2"><h6></h6></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> @isset($patterndetail)
                            @foreach ($patterndetail as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->iplikseridi->name }}</td>
                            <td>{{ $list->iplik_no }}/{{$list->iplik_kalin}}</td>
                            <td>{{ $list->iplikcins->name }}</td>
                            <td>{{ $list->boyacins->name ?? '' }}</td>
                            <td>{{ $list->renk_no }}</td>
                            <td>{{ $list->renk }}</td>
                            <td>{{ $list->renk_sayisi }}</td>
                            <td>{{ $list->sayi }}{{ $list->harf }}</td>
                            <td>{{ $list->atki_sikligi }}</td>
                            <td>{{ $list->cozgu_sikligi }}</td>
                            <td>{{ $list->tekrar }}</td>
                            <td>{{ $list->bos_atki_sayisi }}</td>
                            <td>{{ $list->ayni_agiza_atilan_atki_sayisi }}</td>
                            <td>
                                 <a  href="{{route('patterndetail.edit',$list->id)}}"style="color:black" title="Düzenle"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('patterndetail.destroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>@endforeach @endisset
                    
                     @isset($patterndetailweft)
                            @foreach ($patterndetailweft as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->iplikseridi->name }}</td>
                            <td>{{ $list->iplik_no }}/{{$list->iplik_kalin}}</td>
                            <td>{{ $list->iplikcins->name }}</td>
                            <td>{{ $list->boyacins->name ?? '' }}</td>
                            <td>{{ $list->renk_no }}</td>
                            <td>{{ $list->renk }}</td>
                            <td>{{ $list->renk_sayisi }}</td>
                            <td>{{ $list->sayi }}{{ $list->harf }}</td>
                            <td>{{ $list->atki_sikligi }}</td>
                            <td>{{ $list->cozgu_sikligi }}</td>
                            <td>{{ $list->tekrar }}</td>
                            <td>{{ $list->bos_atki_sayisi }}</td>
                            <td>{{ $list->ayni_agiza_atilan_atki_sayisi }}</td>
                            <td>
                                 <a  href="{{route('patterndetail.edit',$list->id)}}"style="color:black" title="Düzenle"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('patterndetail.destroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>@endforeach @endisset
                    </tbody>
                </table>
                <div class="form-group row">
                        <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                    </div>              
                </div>    
</div>

@endsection
@section('js')
<script type="text/javascript">
    
  $('button[name=copy]').click(function() {
            id = $(this).attr('id');
            if(id){
            $.ajax({
             type:"get",
             url:'{{url('patterndetail')}}/'+id, 
             success:function(res)
                {
                  var kayitSay = res.length;  
                if(kayitSay > 0)
                    {//console.log; 
                        //$("select[name='firmadetay_id").empty();
                        //$("input[name='vade").empty();
                            for (var i = 0; i < kayitSay; i++)
                            {
                            $("input[name='iplik_kalin']").val(res[0].iplik_kalin);
                            $("input[name='iplik_no']").val(res[0].iplik_no);
                            $("input[name='tekrar']").val(res[0].tekrar);
                            $("input[name='renk_sayisi']").val(res[0].renk_sayisi);
                            $("input[name='harf']").val(res[0].harf);
                            $("input[name='sayi']").val(res[0].sayi);
                            $("input[name='atki_sikligi']").val(res[0].atki_sikligi);
                            $("input[name='cozgu_sikligi']").val(res[0].cozgu_sikligi);
                            $("input[name='bos_atki_sayisi']").val(res[0].bos_atki_sayisi);
                            $("input[name='ayni_agiza_atilan_atki_sayisi']").val(res[0].ayni_agiza_atilan_atki_sayisi);
                            $("select[name='iplikseridi_id']").children("option:selected").val(res[0].iplikseridi_id).text(res[0].iplikseridi.name);
                            $("select[name='iplikcins_id']").children("option:selected").val(res[0].iplikcins_id).text(res[0].iplikcins.name);
                            $("select[name='boyacins_id']").children("option:selected").val(res[0].boyacins_id).text(res[0].boyacins.name);
                            };
                            }
                        else {
                           //$("select[name='firmadetay_id").empty();
                           //$("input[name='vade").val('');
                           //$("select[name='kur_id']select").val('');
                       }
                   }
               });
        }
            
        });

</script>
@endsection
@section('css')

@endsection

