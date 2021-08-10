<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\iplikirsaliye;
use App\models\iplikbukum;
use App\models\iplikbukumdetail;
use App\models\iplikboya;
use App\models\iplikirsaliyedetail;
use App\models\iplikhareket;
use App\models\iplikdepo;
use Yajra\Datatables\Datatables;    
use App\models\hareketturu;
use App\models\order;
use App\models\cozgudetail;
use App\models\cozgu;
use App\models\firma;
use App\models\firmatipi;
use App\models\iplikcins;
use App\models\boyacins;
use App\models\unit;
use App\models\kur;
use Auth;
use DB;
use QrCode;

class iplikirsaliyeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $iplikirsaliye= iplikirsaliye::with('iplikirsaliyedetail.iplikcins')
    ->leftjoin('firmas as f','f.id','=','iplikirsaliyes.firma_id')
    ->leftjoin('orders as o','o.id','=','iplikirsaliyes.order_id')
    ->leftjoin('firmatipis as ft','ft.id','=','iplikirsaliyes.firmatipi_id')
    ->leftjoin('hareketturus as h','h.id','=','iplikirsaliyes.hareketturu_id')
    ->select('iplikirsaliyes.id','f.name as firma','h.id as hareketturu_id','h.name as hareket','o.order_no as order','ft.name as firmatipi','iplikirsaliyes.irsaliye_no','iplikirsaliyes.fatura_no','iplikirsaliyes.gtrh','iplikirsaliyes.ctrh','iplikirsaliyes.aciklama')
    ->orderBy('id','DESC')->paginate(15); 
    return view('iplikirsaliye.index',compact('iplikirsaliye'));
    }

    public function iplikirsaliyesearch(Request $request)
    {
      $iplikmarka=$request->iplikmarka;$iplikcins=$request->iplikcins;$renk=$request->renk;$iplikno=$request->iplikno;$ne=$request->ne;
    $iplikirsaliye=new iplikirsaliye; 
    $iplikirsaliye = $iplikirsaliye->with(['iplikirsaliyedetail.iplikcins']);
    if(isset($request->iplikmarka)) $iplikirsaliye = $iplikirsaliye->whereHas('iplikirsaliyedetail', function($q) use ($iplikmarka) {
    $q->where('iplikmarka','like','%'.$iplikmarka.'%');
       });
    if(isset($request->iplikcins)) $iplikirsaliye = $iplikirsaliye->whereHas('iplikirsaliyedetail.iplikcins', function($q) use ($iplikcins) {
    $q->where('name','like','%'.$iplikcins.'%');
       });
    if(isset($request->renk)) $iplikirsaliye = $iplikirsaliye->whereHas('iplikirsaliyedetail', function($q) use ($renk) {
    $q->where('renk','like','%'.$renk.'%');
       });
    if(isset($request->iplikno)) $iplikirsaliye = $iplikirsaliye->whereHas('iplikirsaliyedetail', function($q) use ($iplikno) {
    $q->where('iplikno','like','%'.$iplikno.'%');
       });
    if(isset($request->ne)) $iplikirsaliye = $iplikirsaliye->whereHas('iplikirsaliyedetail', function($q) use ($ne) {
    $q->where('ne','like','%'.$ne.'%');
       });
    $iplikirsaliye = $iplikirsaliye->leftjoin('firmas as f','f.id','=','iplikirsaliyes.firma_id')
    ->leftjoin('orders as o','o.id','=','iplikirsaliyes.order_id')
    ->leftjoin('firmatipis as ft','ft.id','=','iplikirsaliyes.firmatipi_id')
    ->leftjoin('hareketturus as h','h.id','=','iplikirsaliyes.hareketturu_id');
    if(isset($request->order))$iplikirsaliye = $iplikirsaliye->where('o.order_no','like','%'.$request->order.'%');
    if(isset($request->firma))$iplikirsaliye = $iplikirsaliye->where('f.name','like','%'.$request->firma.'%');
    if(isset($request->hareket))$iplikirsaliye = $iplikirsaliye->where('h.name','like','%'.$request->hareket.'%');
    if(isset($request->firmatipi))$iplikirsaliye = $iplikirsaliye->where('ft.name','like','%'.$request->firmatipi.'%');
    if(isset($request->irsaliye_no))$iplikirsaliye = $iplikirsaliye->where('irsaliye_no','like','%'.$request->irsaliye_no.'%');
    if(isset($request->aciklama))$iplikirsaliye = $iplikirsaliye->where('iplikirsaliyes.aciklama','like','%'.$request->aciklama.'%');
    if(isset($request->gtrh))$iplikirsaliye = $iplikirsaliye->where('iplikirsaliyes.gtrh','like','%'.$request->gtrh.'%');
    if(isset($request->ctrh))$iplikirsaliye = $iplikirsaliye->where('iplikirsaliyes.ctrh','like','%'.$request->ctrh.'%');
    $iplikirsaliye = $iplikirsaliye->select('iplikirsaliyes.id','h.id as hareketturu_id','f.name as firma','h.name as hareket','o.order_no as order','ft.name as firmatipi','iplikirsaliyes.irsaliye_no','iplikirsaliyes.fatura_no','iplikirsaliyes.gtrh','iplikirsaliyes.ctrh','iplikirsaliyes.aciklama')
    ->orderBy('id','DESC')->paginate(50); 
    return view('iplikirsaliye.index')->with(compact('iplikirsaliye'));
    }

    /**     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $hareketturu= hareketturu::get();
      $cozgu= cozgu::get();
      $iplikbukum= iplikbukum::get();
      $iplikboya= iplikboya::get();
      $order= order::orderBy('order_no')->get();
      $firmatipi= firmatipi::get();
      $firma= firma::get();
      $kur= kur::get();
      return view('iplikirsaliye.create', compact('firma','cozgu','firmatipi','iplikboya','iplikbukum','hareketturu','order','kur'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $iplikirsaliye = new iplikirsaliye
      ([
        'hareketturu_id'=>$request->get('hareketturu_id'),
        'firma_id'=>$request->get('firma_id'),
        'firmatipi_id'=>$request->get('firmatipi_id'),
        'iplikbukum_id'=>$request->get('iplikbukum_id'),
        'iplikboya_id'=>$request->get('iplikboya_id'),
        'order_id'=>$request->get('order_id'),
        'gtrh'=>$request->get('gtrh'),
        'ctrh'=>$request->get('ctrh'),
       'fiyat'=>$request->get('fiyat'),
       'kur_id'=>$request->get('kur_id'),
       'cozgu_id'=>$request->get('cozgu_id'),
       'barcode_adet'=>$request->get('barcode_adet'),
       'irsaliye_no'=>$request->get('irsaliye_no'),
        'fatura_no'=>$request->get('fatura_no'),
        'aciklama'=>$request->get('aciklama'),
        'users_id'=>Auth::id()
      ]);
       $iplikirsaliye->save();
       if ($request->get('hareketturu_id')==2){
              return redirect('iplikirsaliye/showdetail/'.$iplikirsaliye['id'])->with(compact('iplikirsaliye'));
            }
            elseif($request->get('hareketturu_id')==1)
            {
              return redirect('iplikirsaliye/iplikgiris/'.$iplikirsaliye['id'])->with(compact('iplikirsaliye'));
            }
    }

     public function iplikgiris($id)
     {
      $iplikirsaliye=iplikirsaliye::with('iplikirsaliyedetail','iplikirsaliyedetail.boyacins','iplikirsaliyedetail.iplikcins','iplikirsaliyedetail.unit')->find($id);
      $unit= unit::get();
      $iplikcins= iplikcins::get();
      $boyacins= boyacins::get(); 
      $iplikbukum=iplikbukum::with('iplikbukumdetail.iplikirsaliyedetail')->where('id',$iplikirsaliye->iplikbukum_id)->get();
    //return $iplikbukum;
        return view('iplikirsaliye.iplikgiris',compact('iplikirsaliye','iplikbukum','unit','iplikcins','boyacins'));
     }

     public function iplikgirisdetail(Request $request)
     {
    $iplikirsaliye = iplikirsaliye::find($request->get('iplikirsaliye_id'));
    $iplikirsaliyedetail_id = iplikirsaliyedetail::Where([['sira',$request->get('sira')],
                                                  ['iplikirsaliye_id',$request->get('iplikirsaliye_id')]
                                                ])
                                      ->first();
     $iplikdepo=iplikdepo::where('barcode',$iplikirsaliyedetail_id['barcode'])->first();                                 
        if ($iplikirsaliyedetail_id)
        {
                    $iplikirsaliyedetail_id->sira =$request->get('sira');
                    $iplikirsaliyedetail_id->iplikcins_id =$request->get('iplikcins_id');
                    $iplikirsaliyedetail_id->boyacins_id =$request->get('boyacins_id');
                    $iplikirsaliyedetail_id->iplikmarka =$request->get('iplikmarka');
                    $iplikirsaliyedetail_id->iplikno =$request->get('iplikno');
                    $iplikirsaliyedetail_id->ne =$request->get('ne');
                    $iplikirsaliyedetail_id->renk =$request->get('renk');
                    $iplikirsaliyedetail_id->renkno =$request->get('rno');
                    $iplikirsaliyedetail_id->renksim =$request->get('sim');
                    $iplikirsaliyedetail_id->renknosim =$request->get('rs');
                    $iplikirsaliyedetail_id->partino =$request->get('partino');
                    $iplikirsaliyedetail_id->miktar =$request->get('miktar'); 
                    $iplikirsaliyedetail_id->brutmiktar =$request->get('brutmktr');
                    $iplikirsaliyedetail_id->unit_id =$request->get('unit_id');
                    $iplikirsaliyedetail_id->users_id=Auth::id();
                    $iplikirsaliyedetail_id -> save();

                    $iplikdepo->sira =$request->get('sira');
                    $iplikdepo->iplikcins_id =$request->get('iplikcins_id');
                    $iplikdepo->boyacins_id =$request->get('boyacins_id');
                    $iplikdepo->iplikmarka =$request->get('iplikmarka');
                    $iplikdepo->iplikno =$request->get('iplikno');
                    $iplikdepo->ne =$request->get('ne');
                    $iplikdepo->renk =$request->get('renk');
                    $iplikdepo->renkno =$request->get('rno');
                    $iplikdepo->renksim =$request->get('sim');
                    $iplikdepo->renknosim =$request->get('rs');
                    $iplikdepo->partino =$request->get('partino');
                    $iplikdepo->miktar =$request->get('miktar');
                    $iplikdepo->brutmiktar =$request->get('brutmktr');
                    $iplikdepo->unit_id =$request->get('unit_id');
                    $iplikdepo->users_id=Auth::id();
                    $iplikdepo -> save();
                  return $iplikirsaliyedetail_id;
        }
        else{
                  $iplikdeponew = new iplikdepo([
                   'iplikirsaliye_id'=>$iplikirsaliye['id'],
                   'sira'=>$request->get('sira'),
                   'firma_id'=>$iplikirsaliye['firma_id'],
                    'order_id'=>$iplikirsaliye['order_id'],
                    'iplikcins_id'=>$request->get('iplikcins_id'),
                    'boyacins_id'=>$request->get('boyacins_id'),
                    'iplikmarka'=>$request->get('iplikmarka'),
                    'iplikno'=>$request->get('iplikno'),
                    'ne'=>$request->get('ne'),
                    'renk'=>$request->get('renk'),
                    'renkno'=>$request->get('rno'),
                    'renksim'=>$request->get('sim'),
                    'renknosim'=>$request->get('rs'),
                    'partino'=>$request->get('partino'),
                    'gtrh'=>$iplikirsaliye['gtrh'],
                    'miktar'=>$request->get('miktar'),
                    'brutmiktar'=>$request->get('brutmktr'),
                    'unit_id'=>$request->get('unit_id'),
                    'fiyat'=>$iplikirsaliye['fiyat'],
                    'kur_id'=>$iplikirsaliye['kur_id'],
                    'irsaliye_no'=>$iplikirsaliye['irsaliye_no'],
                    'fatura_no'=>$iplikirsaliye['fatura_no'],
                    'aciklama'=>$iplikirsaliye['aciklama'],
                    'users_id'=>Auth::id()
                 ]);
                  $iplikirsaliyedetail= new iplikirsaliyedetail([
                    'hareketturu_id'=>1,
                    'iplikirsaliye_id'=>$request->get('iplikirsaliye_id'),
                    'sira'=>$request->get('sira'),
                    'iplikcins_id'=>$request->get('iplikcins_id'),
                    'boyacins_id'=>$request->get('boyacins_id'),
                    'iplikmarka'=>$request->get('iplikmarka'),
                    'iplikno'=>$request->get('iplikno'),
                    'ne'=>$request->get('ne'),
                    'renk'=>$request->get('renk'),
                    'renkno'=>$request->get('rno'),
                   'renksim'=>$request->get('sim'),
                   'renknosim'=>$request->get('rs'),
                    'partino'=>$request->get('partino'),
                    'miktar'=>$request->get('miktar'),
                    'brutmiktar'=>$request->get('brutmktr'),
                    'unit_id'=>$request->get('unit_id'),
                    'users_id'=>Auth::id()
                 ]);
                   $iplikdeponew->save();
                   $iplikirsaliyedetail->save();
                   $asd = iplikdepo::where('barcode','like','ZR'.date('Ymd').$iplikdeponew['id'].'%')->select('barcode')->first();
                   if($asd) 
                   {
                    return back()->with('error','Hatalı Barcode !');
                  }
                  else
                  {
                   $barcode =  'ZR'.date('Ymd').$iplikdeponew['id']; 
                   iplikdepo::where('id',$iplikdeponew['id'])->update(['barcode'=>$barcode]);
                   iplikirsaliyedetail::where('id',$iplikirsaliyedetail['id'])->update(['barcode'=>$barcode]);
                 }
     return  $iplikirsaliyedetail;
               }
     }

public function etiket($id)
{
        $iplikirsaliyedetail= iplikirsaliyedetail::where('id',$id)->first();
        $asd=QrCode::size(130)->generate($iplikirsaliyedetail->barcode);
        return 
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
      <tr><th colspan="2"><h3>BAYZARA TEKSTİL</h3>Tarih='.date('d-m-Y',strtotime($iplikirsaliyedetail->created_at)).'</th></tr>
      <tr>
      <td><b><center>Sipariş No<br>'.mb_substr($iplikirsaliyedetail->iplikirsaliye->order->order_no,0,4).'-'.mb_substr($iplikirsaliyedetail->iplikirsaliye->order->order_no,4,2).'-'.mb_substr($iplikirsaliyedetail->iplikirsaliye->order->order_no,6,3).'</td>
      <td><center>'.$asd.'<br> No:'.$iplikirsaliyedetail->barcode.'</td>
      </tr>
      <tr>
      <td>Lot No-Marka </td>
      <td>'.$iplikirsaliyedetail->partino.'---'.$iplikirsaliyedetail->iplikmarka.'</td>
      </tr>
      <tr>
      <td>İplik Cinsi</td>
      <td>'.$iplikirsaliyedetail->iplikcins->name.'</td>
      </tr>
      <tr>
      <td>Boya Cinsi</td>
      <td>'.$iplikirsaliyedetail->boyacins->name.'</td>
      </tr>
      <tr>
      <td>İplik No-Ne</td>
      <td>'.$iplikirsaliyedetail->iplikno.'/'.$iplikirsaliyedetail->ne.'</td>
      </tr>
      <tr>
      <td>İplik Renk</td>
      <td>'.$iplikirsaliyedetail->renk.'+'.$iplikirsaliyedetail->renksim.'</td>
      </tr>
      <tr>
      <td>İplik Renk No</td>
      <td>'.$iplikirsaliyedetail->renkno.'+'.$iplikirsaliyedetail->renknosim.'</td>
      </tr>
      <tr>
      <td>Miktar</td>
      <td>'.$iplikirsaliyedetail->miktar.$iplikirsaliyedetail->unit->name.'</td>
      </tr>
      <tr>
      <td>Brüt Miktar</td>
      <td>'.$iplikirsaliyedetail->brutmiktar.$iplikirsaliyedetail->unit->name.'</td>
      </tr>
      <tr>
      <td>Çuval No</td>
      <td>'.$iplikirsaliyedetail->sira.'</td>
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
}
public function topluetiket($id)
{
        $iplikirsaliyedetail= iplikirsaliyedetail::where('iplikirsaliye_id',$id)->orderby('sira')->get();
        $q='';
        $q .= '<!DOCTYPE html>
                        <html>
                        <head>
                        <title>ASD</title>
                        </head>
                        <style type="text/css">
                        body{
                          margin-top:0px;
                          margin-left:1px;
                        }
                        
                        @media print {
                          #btn {
                          display :  none;
                        }
                        .baslik{
                         font-size: 14px; 
                        font-weight: bold;
                      }
                      td{
                         font-size: 15px; 
                        font-weight: bold;
                      }
                      }
                      </style>
                      <body onload="window.print()">';
        foreach ($iplikirsaliyedetail as $list)
        {  
                $asd=QrCode::size(100)->generate($list->barcode);
                $q .=
                '<br><table border="1" width="380">
              <tr><th colspan="2">BAYZARA TEKSTİL <br>Tarih='.date('d-m-Y',strtotime($list->created_at)).'</th></tr>
              <tr>
              <th><font size="4"><b><center>Sipariş No<br>'.mb_substr($list->iplikirsaliye->order->order_no,0,4).'-'.mb_substr($list->iplikirsaliye->order->order_no,4,2).'-'.mb_substr($list->iplikirsaliye->order->order_no,6,4).'</th>
              <th rowspan="2"><center>'.$asd.'</th>
              </tr>
              <tr><th>
               <font size="4">Çuval No:'.$list->sira.'<br>'.$list->barcode.'</font>
              </th></tr>
              <tr>
              <td width="120" class="baslik">Lot No-İplik Marka </td>
              <td>'.$list->partino.'---'.$list->iplikmarka.'</td>
              </tr>
              <tr>
              <td class="baslik">İplik Cinsi</td>
              <td>'.$list->iplikcins->name.'</td>
              </tr>
              <tr>
              <td class="baslik">Boya Cinsi</td>
              <td>'.$list->boyacins->name.'</td>
              </tr>
              <tr>
              <td class="baslik">İplik No-Ne</td>
              <td>'.$list->iplikno.'/'.$list->ne.'</td>
              </tr>
              <tr>
              <td class="baslik">İplik Renk</td>
              <td>'.$list->renk.'+'.$list->renksim.'</td>
              </tr>
              <tr>
              <td class="baslik">İplik Renk No</td>
              <td>'.$list->renkno.'+'.$list->renknosim.'</td>
              </tr>
              <tr>
              <td class="baslik">Miktar</td>
              <td>'.$list->miktar.$list->unit->name.'</td>
              </tr>
              <tr>
              <td class="baslik">Brüt Miktar</td>
              <td>'.$list->brutmiktar.$list->unit->name.'</td>
              </tr>
              </table>
              ';}
              $q .= '
              <!--<button id="btn" style="width: 100px; height: 100px;" onclick="goBack()">Geri</button> -->
              </body>
              </html>
              <script type="text/javascript">
              setTimeout( function() {
                   history.go(-1);
              }, 4000);
              function goBack() {
                window.history.back();
              }
              </script>';
              return $q;

}
     public function storedetail(Request $request)
    {
      $iplikdepo=iplikdepo::where('barcode',$request->get('barcode'))->first();
      $iplikirsaliye=iplikirsaliye::with('iplikirsaliyedetail')->where('id',$request->get('iplikirsaliye_id'))->first();
      
        if($iplikdepo)
            {
                   $iplikirsaliyedetailbarcode= iplikirsaliyedetail::where('barcode',$iplikdepo['barcode'])->where('hareketturu_id',2)->first();
                     
                     if($iplikirsaliyedetailbarcode)
                     { return back();}
                   else
                     {
                          if($iplikirsaliye->firmatipi_id == 6)
                         {
                          // $iplikbukum=iplikbukum::where('id',$iplikirsaliye->iplikbukum_id)->with('iplikbukumdetail')->first();
                          $iplikbukumdetail=iplikbukumdetail::where('iplikbukum_id',$iplikirsaliye->iplikbukum_id)
                          ->where([['iplikno',$iplikdepo->iplikno],['ne',$iplikdepo->ne],['iplikcins_id',$iplikdepo->iplikcins_id],['renkno',$iplikdepo->renkno]])
                          ->first();
                          $kg=iplikirsaliyedetail::where('iplikirsaliye_id',$request->iplikirsaliye_id)
                          ->where([['iplikno',$iplikdepo->iplikno],['ne',$iplikdepo->ne],['iplikcins_id',$iplikdepo->iplikcins_id],['renkno',$iplikdepo->renkno]])
                          ->get();
                          $depo= iplikdepo::leftjoin('iplikcins','iplikcins.id','=','iplikdepos.iplikcins_id')
                        ->leftjoin('boyacins','boyacins.id','=','iplikdepos.boyacins_id')
                        ->leftjoin('units','units.id','=','iplikdepos.unit_id')
                        ->select(
                                  'iplikmarka',
                                  'partino', 
                                  DB::raw('SUM(miktar) as miktar'),
                                  DB::raw('SUM(brutmiktar) as brutmiktar'),
                                  'units.name as unit',
                                  'renk',
                                  'boyacins.name as boyacins',
                                  'iplikcins.name as iplikcins',
                                  'iplikno',
                                  'ne',
                                  'renk',
                                  'renkno',
                                  'renksim',
                                  'renknosim',
                                  'irsaliye_no'
                                )
                          ->where([['iplikdepos.iplikno',$iplikdepo->iplikno],['ne',$iplikdepo->ne],['iplikcins.id',$iplikdepo->iplikcins_id],['renkno',$iplikdepo->renkno]])
                          ->groupBy('iplikno','ne','iplikcins','partino','renkno','renksim')->get();

                          // return $kg;
                          if($iplikbukumdetail->maxmiktar > $kg->sum('miktar'))
                            return redirect('iplikirsaliye/showdetail/'.$request->iplikirsaliye_id)->with('error','Max. Miktardan Fazla Sevk Yapılamaz !!');
                           //$iplikbukumdetail->maxmiktar;
                              // $iplikirsaliyedetail->cozgu_id = $iplikirsaliye->cozgu_id;
                              // $iplikirsaliyedetail->iplikirsaliyedetail_id = $iplikirsaliyedetail->id;
                              // $cozgudetail=cozgudetail::create($iplikirsaliyedetail->toArray());
                          }

                      $iplikirsaliyedetail= new iplikirsaliyedetail([
                            'iplikirsaliye_id'=>$request->get('iplikirsaliye_id'),
                            'sira'=>$iplikdepo['sira'],
                            'hareketturu_id'=>2,
                            'barcode'=>$iplikdepo['barcode'],
                            'iplikmarka'=>$iplikdepo['iplikmarka'],
                            'iplikcins_id'=>$iplikdepo['iplikcins_id'],
                            'boyacins_id'=>$iplikdepo['boyacins_id'],
                            'iplikno'=>$iplikdepo['iplikno'],
                            'ne'=>$iplikdepo['ne'],
                            'renk'=>$iplikdepo['renk'],
                            'renkno'=>$iplikdepo['renkno'],
                            'partino'=>$iplikdepo['partino'],
                            'miktar'=>$iplikdepo['miktar'],
                            'brutmiktar'=>$iplikdepo['brutmiktar'],
                            'unit_id'=>$iplikdepo['unit_id'],
                            'users_id'=>Auth::id()
                          ]);
                        $iplikirsaliyedetail->save();
                  $a=iplikdepo::where('barcode',$request->get('barcode'))->first();
                  $a->delete();
                  if($iplikirsaliye->firmatipi_id == 2)
                     {
                          $iplikirsaliyedetail->cozgu_id = $iplikirsaliye->cozgu_id;
                          $iplikirsaliyedetail->iplikirsaliyedetail_id = $iplikirsaliyedetail->id;
                          $cozgudetail=cozgudetail::create($iplikirsaliyedetail->toArray());
                      }
                  $iplikirsaliyedetail=iplikirsaliyedetail::where('iplikirsaliye_id',$iplikirsaliye['id'])->get();
                  $iplikbukum=iplikbukum::with('iplikbukumdetail')->where('id',$iplikirsaliye->iplikbukum_id)->get();
                   return redirect('iplikirsaliye/showdetail/'.$request->get('iplikirsaliye_id'))->with(compact('iplikirsaliye','iplikbukum','iplikirsaliyedetail'))->with('success','Barkod Ekleme Başarılı');
                 }
            }
          else {
                  $iplikirsaliyedetail=iplikirsaliyedetail::where('iplikirsaliye_id',$iplikirsaliye['id'])->get();
             return redirect('iplikirsaliye/showdetail/'.$request->get('iplikirsaliye_id'))->with(compact('iplikirsaliye','iplikirsaliyedetail'));

            } 
    }
    public function showdetail($id)
    {
      $iplikirsaliye=iplikirsaliye::where('id',$id)->first();
      $iplikirsaliyedetail=iplikirsaliyedetail::where('iplikirsaliye_id',$id)->get();
       $iplikbukum=iplikbukum::with('iplikbukumdetail')->where('id',$iplikirsaliye->iplikbukum_id)->get();
       return view('iplikirsaliye.iplikirsaliyestoredetail')->with(compact('iplikirsaliye','iplikbukum','iplikirsaliyedetail'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
      $iplikirsaliye=iplikirsaliye::with('iplikirsaliyedetail')->find($id);
      return view('iplikirsaliye.show',compact('iplikirsaliye'));
    }
    public function show2($id)
    {
      $iplikirsaliye=iplikirsaliye::with('iplikirsaliyedetail')->find($id);
      return view('iplikirsaliye.show2',compact('iplikirsaliye'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $iplikirsaliye=iplikirsaliye::find($id);
        $hareketturu= hareketturu::get();
      $order= order::orderBy('order_no')->get();
      $firmatipi= firmatipi::get();
      $firma= firma::get();
      $kur= kur::get();
      return view('iplikirsaliye.edit', compact('iplikirsaliye','firma','firmatipi','hareketturu','order','kur'));
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
         $iplikirsaliye = iplikirsaliye::find($id);
        $iplikirsaliye ->firmatipi_id = $request->get('firmatipi_id');
        $iplikirsaliye ->order_id= $request->get('order_id');
        $iplikirsaliye ->firma_id= $request->get('firma_id');
        $iplikirsaliye ->gtrh= $request->get('gtrh');
        $iplikirsaliye ->ctrh= $request->get('ctrh');
        $iplikirsaliye ->barcode_adet= $request->get('barcode_adet');
        $iplikirsaliye ->fiyat= $request->get('fiyat');
        $iplikirsaliye ->kur_id= $request->get('kur_id');
        $iplikirsaliye ->cozgu_id= $request->get('cozgu_id');
        $iplikirsaliye ->irsaliye_no= $request->get('irsaliye_no');
        $iplikirsaliye ->fatura_no= $request->get('fatura_no');
        $iplikirsaliye ->aciklama= $request->get('aciklama');
        $iplikirsaliye ->users_id= Auth::id();
        $iplikirsaliye -> save();
        return redirect('/iplikirsaliye/iplikirsaliye')->with('success','Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function js ()
   {
    $iplikirsaliye= iplikirsaliye::with('iplikirsaliyedetail.iplikcins','firmatipi','hareketturu','order','firma')->orderBy('id','DESC')->get();
    // $iplikirsaliye= iplikirsaliye::orderBy('id','DESC')->get();
    return Datatables::of($iplikirsaliye)
    ->addColumn('action', function ($iplikirsaliye) {
      $sql= '<table><tr>';
      if($iplikirsaliye['hareketturu_id']==1) 
        {
          $sql .='<td><a href="iplikirsaliye/'.$iplikirsaliye->id.'" title="Detay" target="_blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
          if(!auth()->user()->hasRole('konfeksiyon plan')) $sql .='<td><a href="iplikgiris/'.$iplikirsaliye->id.'" title="İplik Giriş" target="_blank" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>';
        }
        if($iplikirsaliye['hareketturu_id']==2) 
        {
          $sql .='<td><a href="show2/'.$iplikirsaliye->id.'" title="Detay" target="_blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
         if(!auth()->user()->hasRole('konfeksiyon plan'))$sql .= '<td><a href="showdetail/'.$iplikirsaliye->id.'" title="İplik Çıkış" target="_blank" style="color:black"><i class="fas fa-truck-loading fa-1x"></i></a></td>';
       }
        if(!auth()->user()->hasRole('konfeksiyon plan'))$sql .='<td><a href="iplikirsaliye/'.$iplikirsaliye->id.'/edit" style="color:black" target="_blank" title="Düzenle"><i class="far fa-edit fa-2x"></i></a></td>
      </tr></table>';
      return $sql;
    })
    ->removeColumn('password')
    ->make(true);
  }
  public function showreport()
  {
      return view('iplikirsaliye.report');
  }
   public function showjs ()
   {
    $iplikdepo= iplikdepo::leftjoin('iplikcins','iplikcins.id','=','iplikdepos.iplikcins_id')
                        ->leftjoin('boyacins','boyacins.id','=','iplikdepos.boyacins_id')
                        ->leftjoin('units','units.id','=','iplikdepos.unit_id')
                        ->select(
                                  'iplikmarka',
                                  'partino', 
                                  DB::raw('SUM(miktar) as miktar'),
                                  DB::raw('SUM(brutmiktar) as brutmiktar'),
                                  'units.name as unit',
                                  'renk',
                                  'boyacins.name as boyacins',
                                  'iplikcins.name as iplikcins',
                                  'iplikcins.id as iplikcins_id',
                                  'iplikno',
                                  'ne',
                                  'renk',
                                  'renkno',
                                  'renksim',
                                  'renknosim',
                                  'irsaliye_no'
                                )
                          ->groupBy('iplikno','ne','iplikcins','partino','renkno','renksim')->get();
                          //return $iplikdepo;
    return Datatables::of($iplikdepo)
    ->removeColumn('password')
    ->make(true);
  }
       public function showreport2()
    {
      return view('iplikirsaliye.report2');
    }
    public function showjs2 ()
    {
      $iplikdepo=iplikdepo::with('iplikcins','boyacins','unit')->get();
      return Datatables::of($iplikdepo)
      ->removeColumn('password')
      ->make(true);
    }
    public function cuvalbol(Request $request)
    {
     $iplikirsaliyedetail=iplikirsaliyedetail::where('barcode',$request->get('barcode'))->where('hareketturu_id',1)->first();
     if ($iplikirsaliyedetail)
     {$iplikirsaliye=iplikirsaliye::where('id',$iplikirsaliyedetail['iplikirsaliye_id'])->first();
     $cikanlar=iplikirsaliyedetail::where('barcode','like','B'.$request->get('barcode').'%')->where('hareketturu_id',2)->sum('miktar');
          $miktar= $iplikirsaliyedetail['miktar'] - $request->get('val')-($cikanlar);
          $brutmiktar= $iplikirsaliyedetail['brutmiktar'] - $request->get('val')-($cikanlar);
          iplikdepo::insert([
                         'iplikirsaliye_id'=>$iplikirsaliye['id'],
                         'sira'=>$iplikirsaliyedetail['sira'],
                         'barcode'=>$iplikirsaliyedetail['barcode'],
                         'firma_id'=>$iplikirsaliye['firma_id'],
                         'order_id'=>$iplikirsaliye['order_id'],
                         'iplikcins_id'=>$iplikirsaliyedetail['iplikcins_id'],
                         'boyacins_id'=>$iplikirsaliyedetail['boyacins_id'],
                         'iplikmarka'=>$iplikirsaliyedetail['iplikmarka'],
                         'iplikno'=>$iplikirsaliyedetail['iplikno'],
                         'ne'=>$iplikirsaliyedetail['ne'],
                         'renk'=>$iplikirsaliyedetail['renk'],
                         'renkno'=>$iplikirsaliyedetail['renkno'],
                         'partino'=>$iplikirsaliyedetail['partino'],
                         'miktar'=> $miktar,
                         'brutmiktar'=>$brutmiktar,
                         'unit_id'=>$iplikirsaliyedetail['unit_id'],
                         'fiyat'=>$iplikirsaliye['fiyat'],
                         'kur_id'=>$iplikirsaliye['kur_id'],
                         'irsaliye_no'=>$iplikirsaliye['irsaliye_no'],
                         'fatura_no'=>$iplikirsaliye['fatura_no'],
                         'aciklama'=>$iplikirsaliye['aciklama'],
                         'created_at'=>$iplikirsaliyedetail['created_at'],
                         'updated_at'=>$iplikirsaliyedetail['updated_at'],
                         'users_id'=>Auth::id()
             ]);
          $barcodenew= 'B'.$iplikirsaliyedetail['barcode'];
             //$iplikirsaliyedetailcikis=iplikirsaliyedetail::where('barcode',$request->get('barcode'))->where('hareketturu_id',2)->decrement('miktar',$miktar,['barcode'=>$barcodenew]);
             $iplikirsaliyedetailcikis=iplikirsaliyedetail::where('barcode',$request->get('barcode'))->where('hareketturu_id',2)->update([
               'miktar'=> $request->get('val'),
               'brutmiktar'=> $request->get('val'),
               'barcode'=> $barcodenew
             ]);
        return $iplikirsaliyedetailcikis;
           }
   else return 'hatalı işlem...';

      }
    public function iplikirsaliyedetaildestroy($id)
     {
   $iplikirsaliyedetail=iplikirsaliyedetail::where('id',$id)->first();
   if ( strpos($iplikirsaliyedetail->barcode,'B') === FALSE)
   {
    $iplikirsaliyedetailOLD=iplikirsaliyedetail::where('barcode',$iplikirsaliyedetail['barcode'])->where('hareketturu_id','1')->first();
    $iplikirsaliye=iplikirsaliye::where('id',$iplikirsaliyedetail['iplikirsaliye_id'])->first();
    $iplikcikis=iplikirsaliyedetail::where('barcode',$iplikirsaliyedetailOLD['barcode'])->where('hareketturu_id',2)->get();
    if (count($iplikcikis) <= 1)
    {
     iplikdepo::insert([
       'firma_id'=>$iplikirsaliye['firma_id'],
       'order_id'=>$iplikirsaliye['order_id'],
       'iplikirsaliye_id'=>$iplikirsaliyedetailOLD['iplikirsaliye_id'],
       'barcode'=>$iplikirsaliyedetailOLD['barcode'],
       'sira'=>$iplikirsaliyedetailOLD['sira'],
       'iplikmarka'=>$iplikirsaliyedetailOLD['iplikmarka'],
       'iplikcins_id'=>$iplikirsaliyedetailOLD['iplikcins_id'],
       'boyacins_id'=>$iplikirsaliyedetailOLD['boyacins_id'],
       'iplikno'=>$iplikirsaliyedetailOLD['iplikno'],
       'ne'=>$iplikirsaliyedetailOLD['ne'],
       'renk'=>$iplikirsaliyedetailOLD['renk'],
       'renkno'=>$iplikirsaliyedetailOLD['renkno'],
       'partino'=>$iplikirsaliyedetailOLD['partino'],
       'miktar'=>$iplikirsaliyedetail['miktar'],
       'brutmiktar'=>$iplikirsaliyedetail['brutmiktar'],
       'unit_id'=>$iplikirsaliyedetailOLD['unit_id'],
       'fiyat'=>$iplikirsaliye['fiyat'],
       'kur_id'=>$iplikirsaliye['kur_id'],
       'irsaliye_no'=>$iplikirsaliye['irsaliye_no'],
       'fatura_no'=>$iplikirsaliye['fatura_no'],
       'created_at'=>$iplikirsaliyedetailOLD['created_at'],
       'updated_at'=>$iplikirsaliyedetailOLD['updated_at'],
       'aciklama'=>$iplikirsaliye['aciklama'],
       'users_id'=>Auth::id()
     ]);
   } 
   $iplikirsaliyedetail->delete();
 }
 else {
  $barcode = explode ("B",$iplikirsaliyedetail->barcode);
  $iplikdepo = iplikdepo::where('barcode',$barcode[1])->update(['miktar'=> \DB::raw( 'miktar +'.$iplikirsaliyedetail->miktar ),'brutmiktar'=> \DB::raw( 'brutmiktar +'.$iplikirsaliyedetail->miktar )]);
  $iplikirsaliyedetail->delete();
}
return back()->with('success','Barkod Silindi');
}
    public function cuvalboletiket($id)
      {
        $q='';
        $iplikirsaliyedetail= iplikirsaliyedetail::where('id',$id)->first();
        $barcode = explode ("B",$iplikirsaliyedetail['barcode']);
        $iplikdepo = iplikdepo::where('barcode',$barcode[1])->first(); 
          $asd=QrCode::size(100)->generate($iplikirsaliyedetail->barcode);
          $q .=
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
              td{
                         font-size: 15px; 
                        font-weight: bold;
                      }
          @media print {
                  #btn {
            display :  none;
          }
        }
        </style>
        <body onload="window.print()">
        <br><table border="1" width="380">
        <tr><th colspan="2">BAYZARA TEKSTİL <br>Tarih='.date('d-m-Y',strtotime($iplikirsaliyedetail->created_at)).'</th></tr>
        <tr>';
         if($iplikirsaliyedetail->iplikirsaliye->order) $q .='<td><center>Sipariş No<br>'.mb_substr($iplikirsaliyedetail->iplikirsaliye->order->order_no,0,4).'-'.mb_substr($iplikirsaliyedetail->iplikirsaliye->order->order_no,4,2).'-'.mb_substr($iplikirsaliyedetail->iplikirsaliye->order->order_no,6,3).'<br>Bölünmüş Çuval-'.$iplikirsaliyedetail->sira.'<br> No:'.$iplikirsaliyedetail->barcode.'</td>';
         $q .='<td><center>'.$asd.'</td>
        </tr>
        <tr>
        <td>Lot No-Marka </td>
        <td>'.$iplikirsaliyedetail->partino.'---'.$iplikirsaliyedetail->iplikmarka.'</td>
        </tr>
        <tr>
        <td>İplik Cinsi</td>
        <td>'.$iplikirsaliyedetail->iplikcins->name.'</td>
        </tr>
        <tr>
        <td>Boya Cinsi</td>
        <td>'.$iplikirsaliyedetail->boyacins->name.'</td>
        </tr>
        <tr>
        <td>İplik No-Ne</td>
        <td>'.$iplikirsaliyedetail->iplikno.'/'.$iplikirsaliyedetail->ne.'</td>
        </tr>
        <tr>
        <td>İplik Renk</td>
        <td>'.$iplikirsaliyedetail->renk.'+'.$iplikirsaliyedetail->renksim.'</td>
        </tr>
        <tr>
        <td>İplik Renk No</td>
        <td>'.$iplikirsaliyedetail->renkno.'+'.$iplikirsaliyedetail->renknosim.'</td>
        </tr>
        <tr>
        <td>Miktar</td>
        <td>'.$iplikirsaliyedetail->miktar.$iplikirsaliyedetail->unit->name.'</td>
        </tr>
        <tr>
        <td>Brüt Miktar</td>
        <td>'.$iplikirsaliyedetail->brutmiktar.$iplikirsaliyedetail->unit->name.'</td>
        </tr>
        
        </table>
        <!--<button id="btn" style="width: 100px; height: 100px;" onclick="goBack()">Geri</button> -->
        </body>
        </html>
        
        ';
         $q .=
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
            td{
                         font-size: 14px; 
                        font-weight: bold;
                      }
          @media print {
                  #btn {
            display :  none;
          }
        }
        </style>
        <body onload="window.print()">
        <br><table border="1" width="380">
        <tr><th colspan="2">BAYZARA TEKSTİL <br>Tarih='.date('d-m-Y',strtotime($iplikdepo->created_at)).'</th></tr>
        <tr>';
       if ($iplikdepo->iplikirsaliye->order) $q .='<td><center>Sipariş No<br>'.mb_substr($iplikdepo->iplikirsaliye->order->order_no,0,4).'-'.mb_substr($iplikdepo->iplikirsaliye->order->order_no,4,2).'-'.mb_substr($iplikdepo->iplikirsaliye->order->order_no,6,3).
            '</td>';
        $q .= '<td rowspan="2"><center>'.$asd.'</td>
        </tr>
        <tr><th>
               <font size="4">Çuval No:'.$iplikdepo->sira.'<br>'.$iplikdepo->barcode.'</font>
              </th></tr>
        <tr>
        <td>Lot No-İplik Marka </td>
        <td>'.$iplikdepo->partino.'---'.$iplikdepo->iplikmarka.'</td>
        </tr>
        <tr>
        <td>İplik Cinsi</td>
        <td>'.$iplikdepo->iplikcins->name.'</td>
        </tr>
        <tr>
        <td>Boya Cinsi</td>
        <td>'.$iplikdepo->boyacins->name.'</td>
        </tr>
        <tr>
        <td>İplik No-Ne</td>
        <td>'.$iplikdepo->iplikno.'/'.$iplikdepo->ne.'</td>
        </tr>
        <tr>
        <td>İplik Renk</td>
        <td>'.$iplikdepo->renk.'</td>
        </tr>
        <tr>
        <td>İplik Renk No</td>
        <td>'.$iplikdepo->renkno.'</td>
        </tr>
        <tr>
        <td>Miktar</td>
        <td>'.$iplikdepo->miktar.$iplikdepo->unit->name.'</td>
        </tr>
        <tr>
        <td>Brüt Miktar</td>
        <td>'.$iplikdepo->brutmiktar.$iplikdepo->unit->name.'</td>
        </tr>
        
        </table>
        <!--<button id="btn" style="width: 100px; height: 100px;" onclick="goBack()">Geri</button> -->
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
        return $q;

      }

      public function showreport3($iplikno,$ne,$iplikcins,$partino,$renkno)
      {        
        $iplikirsaliye=iplikirsaliyedetail::with('iplikirsaliye.firma','iplikirsaliye.order','iplikirsaliye.firmatipi','hareketturu','iplikcins','unit','boyacins')->where([['iplikno',$iplikno],['ne',$ne],['iplikcins_id',$iplikcins],['partino',$partino],['renkno',$renkno]])
        ->orderby('id')
        ->get();
        $iplikdepo= iplikdepo::leftjoin('iplikcins','iplikcins.id','=','iplikdepos.iplikcins_id')
                        ->leftjoin('boyacins','boyacins.id','=','iplikdepos.boyacins_id')
                        ->leftjoin('units','units.id','=','iplikdepos.unit_id')
                        ->select(
                                  'iplikmarka',
                                  'partino', 
                                  DB::raw('SUM(miktar) as miktar'),
                                  DB::raw('SUM(brutmiktar) as brutmiktar'),
                                  'units.name as unit',
                                  'renk',
                                  'boyacins.name as boyacins',
                                  'iplikcins.name as iplikcins',
                                  'iplikcins.id as iplikcins_id',
                                  'iplikno',
                                  'ne',
                                  'renk',
                                  'renkno',
                                  'renksim',
                                  'renknosim',
                                  'irsaliye_no'
                                )
                          ->where([['iplikno',$iplikno],['ne',$ne],['iplikcins_id',$iplikcins],['partino',$partino],['renkno',$renkno]])
                          ->groupBy('iplikno','ne','iplikcins','partino','renkno','renksim')->first();
        return view('iplikirsaliye.report3',compact('iplikirsaliye','iplikdepo'));
      }
}
