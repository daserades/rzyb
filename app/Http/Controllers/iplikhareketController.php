<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\iplikhareket;
use App\models\iplikdepo;
use Yajra\Datatables\Datatables;    
use App\models\hareketturu;
use App\models\order;
use App\models\firma;
use App\models\firmatipi;
use App\models\stokturu;
use App\models\iplikcins;
use App\models\boyacins;
use App\models\unit;
use App\models\kur;
use Auth;
use DB;
use QrCode;


class iplikhareketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('iplikhareket.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $hareketturu= hareketturu::get();
      $order= order::get();
      $firmatipi= firmatipi::get();
      $firma= firma::get();
      $iplikcins= iplikcins::get();
      $iplikdepo= iplikdepo::get();
      $boyacins= boyacins::get();
      $unit= unit::get();
      $kur= kur::get();
      return view('iplikhareket.create', compact('firma','firmatipi','hareketturu','order','iplikcins','iplikdepo','boyacins','unit','kur'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $miktar = str_replace(['.', ','], [',', '.'], $request ->get('miktar'));
        $fiyat = str_replace(['.', ','], [',', '.'], $request ->get('fiyat'));

      $iplikhareket = new iplikhareket
      ([
        'hareketturu_id'=>$request->get('hareketturu_id'),
        'firma_id'=>$request->get('firma_id'),
        'iplikcins_id'=>$request->get('iplikcins_id'),
        'boyacins_id'=>$request->get('boyacins_id'),
        'firmatipi_id'=>$request->get('firmatipi_id'),
        'iplikmarka'=>$request->get('iplikmarka'),
        'iplikno'=>$request->get('iplikno'),
        'ne'=>$request->get('ne'),
        'renk'=>$request->get('renk'),
        'renkno'=>$request->get('renkno'),
        'partino'=>$request->get('partino'),
        'order_id'=>$request->get('order_id'),
        'iplikdepo_id'=>$request->get('iplikdepo_id'),
        'gtrh'=>$request->get('gtrh'),
        'ctrh'=>$request->get('ctrh'),
        'siparismiktar'=>$request->get('siparismiktar'),
        'miktar'=>$miktar,
        'brutmiktar'=>$request->get('brutmiktar'),
        'unit_id'=>$request->get('unit_id'),
        'fiyat'=>$fiyat,
        'kur_id'=>$request->get('kur_id'),
        'irsaliye_no'=>$request->get('irsaliye_no'),
        'fatura_no'=>$request->get('fatura_no'),
        'iademiktar'=>$request->get('iademiktar'),
        'aciklama'=>$request->get('aciklama'),
        'users_id'=>Auth::id()
      ]);
      $iplikdepo= new iplikdepo([
       'firma_id'=>$request->get('firma_id'),
       'iplikhareket_id'=>$iplikhareket['id'],
       'order_id'=>$request->get('order_id'),
       'iplikcins_id'=>$request->get('iplikcins_id'),
       'iplikmarka'=>$request->get('iplikmarka'),
       'boyacins_id'=>$request->get('boyacins_id'),
       'iplikno'=>$request->get('iplikno'),
       'ne'=>$request->get('ne'),
       'renk'=>$request->get('renk'),
       'renkno'=>$request->get('renkno'),
       'partino'=>$request->get('partino'),
       'miktar'=>$miktar,
       'brutmiktar'=>$request->get('brutmiktar'),
       'unit_id'=>$request->get('unit_id'),
       'fiyat'=>$fiyat,
       'kur_id'=>$request->get('kur_id'),
       'irsaliye_no'=>$request->get('irsaliye_no'),
       'fatura_no'=>$request->get('fatura_no'),
       'aciklama'=>$request->get('aciklama'),
       'users_id'=>Auth::id()
     ]);
      if ($request->get('hareketturu_id')==1)  
      { 
       $iplikhareket->save();
       $iplikdepo->save();
       $asd = iplikdepo::where('barcode','like','Z'.date('Ymd').$iplikdepo['id'].'%')->select('barcode')->first();
       if($asd) 
       {
        return back()->with('error','Hatalı Barcode !');
      }
      else
      {
       $barcode =  'Z'.date('Ymd').$iplikdepo['id']; 
          //return $barcode;
       iplikhareket::where('id',$iplikhareket['id'])->update(['iplikdepo_id'=>$iplikdepo['id'],'barcode'=>$barcode]);
       iplikdepo::where('id',$iplikdepo['id'])->update(['barcode'=>$barcode]);
     }
   }
   elseif ($request->get('hareketturu_id')==2)  
   {
    $iplikdepo=iplikdepo::where('id',$request->get('iplikdepo_id'))->first();
    if ($iplikdepo['miktar'] < $request->get('miktar')) 
    {
      return back()->with('error','Depodaki iplik miktarları eşleşmiyor !');
    }
    elseif($iplikdepo['miktar'] == $request->get('miktar')) {
     $iplikdepo->delete(); 
     $iplikhareket->save();
   }
   else{
     iplikdepo::where('id',$request->get('iplikdepo_id'))->decrement('miktar', $request->get('miktar'));
     $iplikhareket->save();
   }

 }
  //QrCode::size(500)->generate('ItSolutionStuff.com');
 //return view('iplikhareket/iplikhareket')->with('success','İplik Hareketi Ekleme Başarılı..');
 return  redirect(route('etiket',$iplikhareket->id));
}

public function etiket($id)
{
  $iplikhareket= iplikhareket::where('id',$id)->first();
  $asd=QrCode::size(130)->generate($iplikhareket->barcode);
 $page= 
  '<!DOCTYPE html>
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
        <table border="2" width="400">
        <tr><th colspan="2"><h3>BAYZARA TEKSTİL</h3>Tarih='.date('d-m-Y',strtotime($iplikhareket->created_at)).'</th></tr>
        <tr>
          <td><b><center>Sipariş No<br>'.mb_substr($iplikhareket->order->order_no,0,4).'-'.mb_substr($iplikhareket->order->order_no,4,2).'-'.mb_substr($iplikhareket->order->order_no,6,3).'</td>
          <td><center>'.$asd.'<br> No:'.$iplikhareket->barcode.'</td>
        </tr>
        <tr>
          <td>Lot No</td>
          <td>'.$iplikhareket->partino.'</td>
        </tr>
        <tr>
          <td>İplik Cinsi</td>
          <td>'.$iplikhareket->iplikcins->name.'</td>
        </tr>
        <tr>
          <td>Boya Cinsi</td>
          <td>'.$iplikhareket->boyacins->name.'</td>
        </tr>
        <tr>
          <td>İplik No-Ne</td>
          <td>'.$iplikhareket->iplikno.'/'.$iplikhareket->ne.'</td>
        </tr>
        <tr>
          <td>İplik Renk</td>
          <td>'.$iplikhareket->renk.'</td>
        </tr>
        <tr>
          <td>İplik Renk No</td>
          <td>'.$iplikhareket->renkno.'</td>
        </tr>
        <tr>
          <td>Miktar</td>
          <td>'.$iplikhareket->miktar.$iplikhareket->unit->name.'</td>
        </tr>
        <tr>
          <td>Brüt Miktar</td>
          <td>'.$iplikhareket->brutmiktar.$iplikhareket->unit->name.'</td>
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
';
return $page;
}

 
  public function show($id)
  {

  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $iplikhareket = iplikhareket::find($id);
     $iplikdepo= iplikdepo::get();
     $hareketturu= hareketturu::get();
     $firmatipi= firmatipi::get();
     $order= order::get();
     $firma= firma::get();
     $iplikcins= iplikcins::get();
     $boyacins= boyacins::get();
     $unit= unit::get();
     $kur= kur::get();
     return view('iplikhareket.edit', compact('iplikhareket','firmatipi','iplikdepo','firma','hareketturu','order','iplikcins','boyacins','unit','kur'));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if(iplikdepo::Where('id',$request->get('iplikdepo_id'))->first())
      {
        $iplikhareket = iplikhareket::find($id);
        $iplikhareket ->order_id= $request->get('order_id');
        $iplikhareket ->iplikdepo_id= $request->get('iplikdepo_id');
        $iplikhareket ->firmatipi_id= $request->get('firmatipi_id');
        $iplikhareket ->firma_id= $request->get('firma_id');
        $iplikhareket ->gtrh= $request->get('gtrh');
        $iplikhareket ->ctrh= $request->get('ctrh');
        $iplikhareket ->iplikcins_id= $request->get('iplikcins_id');
        $iplikhareket ->boyacins_id= $request->get('boyacins_id');
        $iplikhareket ->iplikmarka= $request->get('iplikmarka');
        $iplikhareket ->iplikno= $request->get('iplikno');
        $iplikhareket ->ne= $request->get('ne');
        $iplikhareket ->renk= $request->get('renk');
        $iplikhareket ->renkno= $request->get('renkno');
        $iplikhareket ->partino= $request->get('partino');
        $iplikhareket ->miktar= $request->get('miktar');
        $iplikhareket ->brutmiktar= $request->get('brutmiktar');
        $iplikhareket ->unit_id= $request->get('unit_id');
        $iplikhareket ->fiyat= $request->get('fiyat');
        $iplikhareket ->kur_id= $request->get('kur_id');
        $iplikhareket ->irsaliye_no= $request->get('irsaliye_no');
        $iplikhareket ->fatura_no= $request->get('fatura_no');
        $iplikhareket ->aciklama= $request->get('aciklama');
        $iplikhareket ->users_id= Auth::id();

        if ($iplikhareket['hareketturu_id']== 1)
        {
          $iplikhareket->save();
          $iplikdepo = iplikdepo::where('id',$iplikhareket['iplikdepo_id'])->first();
          $iplikdepo ->order_id= $request->get('order_id');
          $iplikdepo ->firma_id= $request->get('firma_id');
          $iplikdepo ->iplikcins_id= $request->get('iplikcins_id');
          $iplikdepo ->boyacins_id= $request->get('boyacins_id');
          $iplikdepo ->iplikno= $request->get('iplikno');
          $iplikdepo ->ne= $request->get('ne');
          $iplikdepo ->renk= $request->get('renk');
          $iplikdepo ->renkno= $request->get('renkno');
          $iplikdepo ->iplikmarka= $request->get('iplikmarka');
          $iplikdepo ->partino= $request->get('partino');
          $iplikdepo ->miktar= $request->get('miktar');
          $iplikdepo ->brutmiktar= $request->get('brutmiktar');
          $iplikdepo ->unit_id= $request->get('unit_id');
          $iplikdepo ->fiyat= $request->get('fiyat');
          $iplikdepo ->kur_id= $request->get('kur_id');
          $iplikdepo ->irsaliye_no= $request->get('irsaliye_no');
          $iplikdepo ->fatura_no= $request->get('fatura_no');
          $iplikdepo ->aciklama= $request->get('aciklama');
          $iplikdepo ->users_id= Auth::id();
          $iplikdepo->save();
        }
        elseif ($iplikhareket['hareketturu_id']== 2)
        {
         $iplikdepo=iplikdepo::where('id',$request->get('iplikdepo_id'))->first();
         if($iplikdepo['miktar'] < $request->get('miktar')) {
          return back()->with('error','Depodaki iplik miktarları eşleşmiyor !');
        }
        elseif($iplikdepo['miktar'] == $request->get('miktar')) {
          $iplikhareket->save();
          $iplikdepo->delete(); 
        }
        else{
          $miktar=iplikhareket::where('id',$id)->first();
          iplikdepo::where('id',$request->get('iplikdepo_id'))->increment('miktar', $miktar['miktar']);
          $iplikhareket->save();
          iplikdepo::where('id',$request->get('iplikdepo_id'))->decrement('miktar', $request->get('miktar'));
        }

      }

      return redirect('iplikhareket/iplikhareket')->with('success','İplik Hareketi Güncelleme Başarılı..');

    }

    else return back()->with('error','Depoda iplik bulunmamaktadır..');
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $iplikhareket = iplikhareket::find($id);
     //iplikdepo::where([['partino',$iplikhareket['partino']],['firma_id',$iplikhareket['firma_id']]])->decrement('miktar',$iplikhareket['miktar']);
     $iplikhareket -> delete();
     return redirect('/iplikhareket/iplikhareket')->with('success','Hareket Silindi');
   }
   public function js ()
   {
    $iplikhareket= iplikhareket::with('hareketturu','order')->orderBy('id','DESC')->get();
    return Datatables::of($iplikhareket)
    ->addColumn('action', function ($iplikhareket) {
      return '<table><tr>
      <td><a href="iplikhareket/'.$iplikhareket->id.'" title="Detay" style="color:black"><i class="fas fa-desktop fa-2x"></i></a></td>
      <td><a href="iplikhareket/'.$iplikhareket->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-2x"></i></a></td>
      <td><div class="delete-form">
      <form action="iplikhareket/'.$iplikhareket->id.'" method="POST">
      <input type="hidden" name="_token" value="'.csrf_token().'">
      <input type="hidden" name="_method" value="DELETE">
      <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
      </form>
      </div></td></tr></table>';
    })
    ->removeColumn('password')
    ->make(true);
  }



}
