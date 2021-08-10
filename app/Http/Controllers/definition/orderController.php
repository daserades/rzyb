<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\order;
use App\models\orderdetailweft;
use App\models\orderdetailwarp;
//use Freshbitsweb\Laratables\Laratables;
use App\models\firma;
use App\models\desen;
use App\models\tesis;
use App\models\sevkham_detail;
use App\models\sevkmamul_detail;
use App\models\ordertur;
use App\models\kur;
use Storage;
use Auth;
use File;
use App\models\irsaliyesekli;
use App\models\unit;
use App\models\onay;
use App\models\orderweft;
use App\models\orderwarp;
use App\models\ebatcins;
use App\models\kenartipi;
use App\models\kenarcinsi;
use App\models\kalitedetay;
use App\models\iplikcins;
use App\models\machine;
use App\models\machineplan;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('definition.order.index');
    }

    public function kapananindex()
    {
      return view('definition.order.kapananindex');
    }
    public function priceindex()
    {
      return view('definition.order.priceindex');
    }

    public function takipform($id)
    {
      $machine=machine::all();
      $order=order::with(['orderweft','machineplan'=>function($q){
        $q->latest();
      },'orderdetailweft','orderdetailwarp'])->where('id',$id)->first();
      return view('definition.order.takipform',compact('order','machine'));
    }
    public function machine(Request $request)
    {
      machineplan::Create($request->all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderno($id) 
    {
  /*    if ($id<10) $id=str_pad($id, 2 , "0",STR_PAD_LEFT);
      
         $orderno = order::where('order_no','like',date('Y').$id.'%')->select('order_no')->orderBy('order_no', 'desc')->first();
         if($orderno) 
         {
         $getno = mb_substr($orderno->order_no, -4, null, 'utf8'); $getno = $getno+1;
         $no=str_pad($getno, 4 , "0",STR_PAD_LEFT);
         $order_no =  date('Y').$id.$no; 
         }
         else $order_no =  date('Y').$id.'0001';   

         return $order_no;
*/

         $firma=firma::where('id',$id)->first();
         if ($firma->zarano<10) $firma->zarano=str_pad($id, 2 , "0",STR_PAD_LEFT);
         $orderno = order::where('order_no','like',date('Y').$firma->zarano.'%')->select('order_no')->orderBy('order_no', 'desc')->first();

         if($orderno)
         {
           $getno = mb_substr($orderno->order_no, -4, null, 'utf8'); $getno = $getno+1;

           $no=str_pad($getno, 4 , "0",STR_PAD_LEFT);
           $order_no =  date('Y').$firma->zarano.$no;
         }
         else $order_no =  date('Y').$firma->zarano.'0001';

         return $order_no;

       }
       public function images($id)
       {
        $order=order::where('id',$id)->select('order_no')->first();
        return view('definition.order.images',compact('order'));
      }
      public function imagedestroy($id,$no)
      {
      //return $id.'-'.$no;
      //$asd='/'.$id.'-'.$no;
        $image_path = 'storage/uploads/'.$id.'/'.$no; 
        if(file_exists($image_path)) {
          File::delete($image_path);
          return back()->with('success','Silme İşlemi Başarılı');
        }
        else return back()->with('error','Bir Sorunla Karşılaşıldı !!');

      }
      public function create()
      {
        $firma = firma::where('firmatipi_id',1)->get();
        $desen = desen::orderBydesc('id')->get();
        $tesis = tesis::get();
        $ordertur=ordertur::get();
        $irsaliyesekli=irsaliyesekli::get();
        $kur = kur::get();
        $unit = unit::orderBydesc('name')->get();
        $ebatcins = ebatcins::get();
        $kenartipi = kenartipi::get();
        $kenarcinsi = kenarcinsi::get();
        $kalitedetay = kalitedetay::get();
        return view('definition.order.create',compact('firma','desen','tesis','irsaliyesekli','ordertur','kur','unit','ebatcins','kenartipi','kenarcinsi','kalitedetay'));
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* if ($request->get('firma_id')<10)
            $firma_id=str_pad($request->get('firma_id'), 2 , "0",STR_PAD_LEFT);
        else 
            $firma_id=$request->get('firma_id');
         $orderno = order::where('order_no','like',date('Y').$firma_id.'%')->select('order_no')->orderBy('order_no', 'desc')->first();
         if($orderno) 
         {
         $getno = mb_substr($orderno->order_no, -4, null, 'utf8'); $getno = $getno+1;
         $no=str_pad($getno, 4 , "0",STR_PAD_LEFT);
         $order_no =  date('Y').$firma_id.$no; 
         }
         else $order_no =  date('Y').$firma_id.'0001';
         */

         if ($request->get('numune')== 'on'){
        $request['numune']='N';
        }elseif($request->get('numune')== '')
        {
            $request['numune']=null;
        }

         $firma=firma::where('id', $request->firma_id)->first();
         if ($firma->zarano<10)
          $firma->zarano=str_pad($request->firma_id, 2 , "0",STR_PAD_LEFT);
        $orderno = order::where('order_no','like',date('Y').$firma->zarano.'%')->select('order_no')->orderBy('order_no', 'desc')->first();
        if($orderno)
        {
         $getno = mb_substr($orderno->order_no, -4, null, 'utf8'); $getno = $getno+1;
         $no=str_pad($getno, 4 , "0",STR_PAD_LEFT);
         $order_no =  date('Y').$firma->zarano.$no;
       }
       else $order_no =  date('Y').$firma->zarano.'0001';

       $fiyat= str_replace(['.',','], ['.','.'], $request ->get('fiyat'));


       $request['order_no']= $order_no;
       $request['fiyat']=$fiyat;

       $order=order::create($request->all());

       $filename=$order_no;
       $resimler = $request->file('resimler'); 
       if (!empty($resimler))
        {   $i=1;
          foreach ($resimler as $resim) {
           $resim_uzantı=$resim->getClientOriginalExtension();
           $resim_isim=$filename.'-'.$i.'.'.$resim_uzantı;
           Storage::disk('uploads')->put($filename.'/'.$resim_isim,file_get_contents($resim));
           order::where('id',$order->id)->update(['picture'=>$i]);
           $i++;
         }
       }
       for ($i=1; $i <= 12; $i++)
       {
        $request['sira']=$i; 
        $request['order_id']=$order['id'];
        $cinsne='cinsne'.$i; $request['cinsne']=$request->$cinsne;
        $crenkno='crenkno'.$i; $request['crenkno']=$request->$crenkno;
        $crenk='crenk'.$i; $request['crenk']=$request->$crenk;
        $boyanankg='boyanankg'.$i; $request['boyanankg']=$request->$boyanankg;
        $gelenkg='gelenkg'.$i; $request['gelenkg']=$request->$gelenkg;
        $request['users_id']=Auth::id();
        if (isset($request->gelenkg)||isset($request->boyanankg)||isset($request->crenk)||isset($request->crenkno)||isset($request->cinsne))
          orderdetailwarp::create($request->all());
      }
      for ($i=1; $i <= 12; $i++)
      {
        $request['sira']=$i; $request['order_id']=$order['id'];
        $acinsne='acinsne'.$i; $request['acinsne']=$request->$acinsne;
        $arenkno='arenkno'.$i; $request['arenkno']=$request->$arenkno;
        $ar='ar'.$i; $request['arenk']=$request->$ar;
        $aboyanankg='aboyanankg'.$i; $request['aboyanankg']=$request->$aboyanankg;
        $agelenkg='agelenkg'.$i; $request['agelenkg']=$request->$agelenkg;
        $asiklik='asiklik'.$i; $request['asiklik']=$request->$asiklik;
        $request['users_id']=Auth::id();
        if (isset($request->agelenkg)||isset($request->asiklik)||isset($request->aboyanankg)||isset($request->arenk)||isset($request->arenkno)||isset($request->acinsne))
          orderdetailweft::create($request->all());
      }
      
      onay::create(['sipdurum_id'=>3,'table'=>'order','table_id'=>$order['id'],'users_id'=>Auth::id()]);
      return redirect('/order/order')->with('success','Sipariş Ekleme Başarılı..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
      $order = order::find($id);
      $sevkhamdetail = sevkham_detail::where('order_id',$id)->sum('metre');
      $sevkmamuldetail = sevkmamul_detail::where('order_id',$id)->sum('metre');
      return view('definition.order.show',compact('order','sevkhamdetail','sevkmamuldetail'));
    }

    public function show2($id)
    {   
      $order = order::find($id);
      return view('definition.order.show2',compact('order'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $order=order::find($id);
      $desen = desen::orderBy('no')->get();
      $firma = firma::where('firmatipi_id',1)->get();
      $tesis = tesis::get();
      $irsaliyesekli=irsaliyesekli::get();
      $ordertur=ordertur::get();
      $orderwarp=orderwarp::where('order_id',$id)->first();
      $orderweft=orderweft::where('order_id',$id)->first();
      $kur = kur::get();
      $unit=unit::get();
      $unit2=unit::get();
      $ebatcins = ebatcins::get();
      $kenartipi = kenartipi::get();
      $kenarcinsi = kenarcinsi::get();
      $kalitedetay = kalitedetay::get();
      return view('definition.order.edit',compact('order','desen','firma','tesis','irsaliyesekli','ordertur','kur','unit2','unit','ebatcins','kenartipi','orderwarp','orderweft','kenarcinsi','kalitedetay'));
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
      if ($_POST['action'] == 'Güncelle') {

       if ($request->get('exampleCheck1')== 'on'){
        order::where('id',$id)->update(['onay1'=>'K']);
      }elseif($request->get('exampleCheck1')== '')
      {
        order::where('id',$id)->update(['onay1'=>null]);
      }

      if ($request->get('numune')== 'on'){
        order::where('id',$id)->update(['numune'=>'N']);
      }elseif($request->get('numune')== '')
      {
        order::where('id',$id)->update(['numune'=>null]);
      }

      $order = order::find($id);

      $filename=$order->order_no;
      $resimler = $request->file('resimler'); 
      if (!empty($resimler))
      {  
        $q=order::where('id',$id)->select('picture')->first();
        $resimsayi= $q->picture; $resimsayi++;
        if( $q->picture > 0 )
        {
         $i=$resimsayi;
         foreach ($resimler as $resim) 
         {
           $resim_uzantı=$resim->getClientOriginalExtension();
           $resim_isim=$filename.'-'.$i.'.'.$resim_uzantı;
           Storage::disk('uploads')->put($filename.'/'.$resim_isim,file_get_contents($resim));
           order::where('id',$id)->update(['picture'=>$i]);
           $i++;
         }
       }
       else 
       {
        $i=1;
        foreach ($resimler as $resim) 
        {
         $resim_uzantı=$resim->getClientOriginalExtension();
         $resim_isim=$filename.'-'.$i.'.'.$resim_uzantı;
         Storage::disk('uploads')->put($filename.'/'.$resim_isim,file_get_contents($resim));
         order::where('id',$id)->update(['picture'=>$i]);
         $i++;
       }  
     }
   }  

   $order ->firma_no = $request->get('firma_no');
   $order ->order_no = $request->get('order_no');
   $order ->firma_id= $request->get('firma_id');
   $order ->desen_id= $request->get('desen_id');
   $order ->varyant= $request->get('varyant');
   $order ->desenadi= $request->get('desenadi');
   $order ->tesis_id= $request->get('tesis_id');
   $order ->ordertur_id= $request->get('ordertur_id');
   $order ->kalite= $request->get('kalite');
   $order ->leventgenisligi= $request->get('leventgenisligi');
   $order ->irsaliyesekli_id= $request->get('irsaliyesekli_id');
   $order ->cts= $request->get('cts');
   $order ->tarakeni= $request->get('tarakeni');
   $order ->tarakno= $request->get('tarakno');
   $order ->makinatip= $request->get('makinatip');
   $order ->atkisikligi= $request->get('atkisikligi');
   $order ->cozgumetraji= $request->get('cozgumetraji');
   $order ->ortakcozgumetraji= $request->get('ortakcozgumetraji');
   $order ->hamen= $request->get('hamen');
   $order ->en= $request->get('en');
   $order ->boy= $request->get('boy');
   $order ->ebatcins_id= $request->get('ebatcins_id');
   $order ->kenartipi_id= $request->get('kenartipi_id');
   $order ->kenarcinsi_id= $request->get('kenarcinsi_id');
   $order ->kalitedetay_id= $request->get('kalitedetay_id');
   $order ->miktar= $request->get('miktar');
   $order ->munit_id= $request->get('munit_id');
   $order ->termin= $request->get('termin');
   $order ->siptrh= $request->get('siptrh');
   $order ->renk= $request->get('renk');
   $order ->renk2= $request->get('renka2');
   $order ->const= $request->get('const');
   if($request->get('fiyat') > 0) $order ->fiyat=str_replace(['.',','], ['.','.'], $request ->get('fiyat'));
   if(Auth::user()->hasRole('admin|genel mudur'))$order ->unit_id= $request->get('unit_id');
   if(Auth::user()->hasRole('admin|genel mudur'))$order ->kur_id= $request->get('kur_id');
   $order ->vade= $request->get('vade');
   $order ->bazkur= $request->get('bazkur');
   $order ->hamsip= $request->get('hamsip');
   $order ->mamulsip= $request->get('mamulsip');
   $order ->gelencozgumetre= $request->get('gelencozgumetre');
   $order ->dokumaadet= $request->get('dokumaadet');
   $order ->dokumatelsayi= $request->get('dokumatelsayi');
   $order ->dokumateleni= $request->get('dokumateleni');
   $order ->duzboyarenkno= $request->get('duzboyarenkno');
   $order ->odemesekli= $request->get('odemesekli');
   $order ->orderadres= $request->get('orderadres');
   $order ->sevkiyat= $request->get('sevkiyat');
   $order ->orderproses= $request->get('orderproses');
   $order ->aciklama1= $request->get('aciklama1');
   $order ->aciklama2= $request->get('aciklama2');
   $order ->aciklama3= $request->get('aciklama3');
   $order ->users_id=Auth::id();
   $order->save();

   $request['order_id']= $order->id;
   if( $order->id > 412)
   {
    for ($i=0; $i < 12; $i++)
    {
      $request['sira']=$i; 
      $orderdetailwarpupdate=orderdetailwarp::where('order_id',$id)->where('sira',$i)->first();
      $cinsne='cinsne'.$i; $request['cinsne']=$request->$cinsne;
      $crenkno='crenkno'.$i; $request['crenkno']=$request->$crenkno;
      $crenk='crenk'.$i; $request['crenk']=$request->$crenk;
      $boyanankg='boyanankg'.$i; $request['boyanankg']=$request->$boyanankg;
      $gelenkg='gelenkg'.$i; $request['gelenkg']=$request->$gelenkg;
      $request['users_id']=Auth::id();
      if (isset($request->gelenkg) || isset($request->boyanankg)||isset($request->crenk)||isset($request->crenkno)||isset($request->cinsne) )
      {
        if ( isset($orderdetailwarpupdate['sira']) )
          {$orderdetailwarpupdate->update($request->all());}
        else
         { orderdetailwarp::create($request->all());}
     }
     else if(isset($orderdetailwarpupdate['sira']) && empty($request->cinsne))
     {
        $orderdetailwarpupdate->delete();
     }
   }
   return back();
   for ($i=0; $i < 12; $i++)
   {
    $request['sira']=$i;
    $orderdetailweftupdate=orderdetailweft::where('order_id',$id)->where('sira',$i)->first();
    $acinsne='acinsne'.$i; $request['acinsne']=$request->$acinsne;
    $arenkno='arenkno'.$i; $request['arenkno']=$request->$arenkno;
    $ar='ar'.$i; $request['arenk']=$request->$ar;
    $aboyanankg='aboyanankg'.$i; $request['aboyanankg']=$request->$aboyanankg;
    $agelenkg='agelenkg'.$i; $request['agelenkg']=$request->$agelenkg;
    $asiklik='asiklik'.$i; $request['asiklik']=$request->$asiklik;
    $request['users_id']=Auth::id();
    if (isset($request->agelenkg)||isset($request->asiklik)||isset($request->aboyanankg)||isset($request->arenk)||isset($request->arenkno)||isset($request->acinsne) )
    {
      if (isset($orderdetailweftupdate['sira']))
       $orderdetailweftupdate->update($request->all());
     else 
       orderdetailweft::create($request->all());
   }
   else if(isset($orderdetailweftupdate['sira']) && empty($request->acinsne))
     {
        $orderdetailweftupdate->delete();
     }
 }
}
else {

  orderweft::where('order_id',$id)->update([
    'order_id'=>$order['id'],
    'desenadi'=>$request->get('desen_id'),
    'ano1'=>$request->get('ano1'),
    'ane1'=>$request->get('ane1'),
    'arenk1'=>$request->get('arenk1'),
    'asik1'=>$request->get('asik1'),
    'agr1'=>$request->get('agr1'),
    'ano2'=>$request->get('ano2'),
    'ane2'=>$request->get('ane2'),
    'arenk2'=>$request->get('arenk2'),
    'asik2'=>$request->get('asik2'),
    'agr2'=>$request->get('agr2'),
    'ano3'=>$request->get('ano3'),
    'ane3'=>$request->get('ane3'),
    'arenk3'=>$request->get('arenk3'),
    'asik3'=>$request->get('asik3'),
    'agr3'=>$request->get('agr3'),
    'ano4'=>$request->get('ano4'),
    'ane4'=>$request->get('ane4'),
    'arenk4'=>$request->get('arenk4'),
    'asik4'=>$request->get('asik4'),
    'agr4'=>$request->get('agr4'),
    'ano5'=>$request->get('ano5'),
    'ane5'=>$request->get('ane5'),
    'arenk5'=>$request->get('arenk5'),
    'asik5'=>$request->get('asik5'),
    'agr5'=>$request->get('agr5'),
    'ano6'=>$request->get('ano6'),
    'ane6'=>$request->get('ane6'),
    'arenk6'=>$request->get('arenk6'),
    'asik6'=>$request->get('asik6'),
    'agr6'=>$request->get('agr6'),
    'ano7'=>$request->get('ano7'),
    'ane7'=>$request->get('ane7'),
    'arenk7'=>$request->get('arenk7'),
    'asik7'=>$request->get('asik7'),
    'agr7'=>$request->get('agr7'),
    'ano8'=>$request->get('ano8'),
    'ane8'=>$request->get('ane8'),
    'arenk8'=>$request->get('arenk8'),
    'asik8'=>$request->get('asik8'),
    'agr8'=>$request->get('agr8'),
    'ano9'=>$request->get('ano9'),
    'ane9'=>$request->get('ane9'),
    'arenk9'=>$request->get('arenk9'),
    'asik9'=>$request->get('asik9'),
    'agr9'=>$request->get('agr9'),
    'ano10'=>$request->get('ano10'),
    'ane10'=>$request->get('ane10'),
    'arenk10'=>$request->get('arenk10'),
    'asik10'=>$request->get('asik10'),
    'agr10'=>$request->get('agr10'),
    'ano11'=>$request->get('ano11'),
    'ane11'=>$request->get('ane11'),
    'arenk11'=>$request->get('arenk11'),
    'asik11'=>$request->get('asik11'),
    'agr11'=>$request->get('agr11'),
    'ano12'=>$request->get('ano12'),
    'ane12'=>$request->get('ane12'),
    'arenk12'=>$request->get('arenk12'),
    'asik12'=>$request->get('asik12'),
    'agr12'=>$request->get('agr12'),
    'abg1'=>$request->get('abg1'),
    'abg2'=>$request->get('abg2'),
    'abg3'=>$request->get('abg3'),
    'abg4'=>$request->get('abg4'),
    'abg5'=>$request->get('abg5'),
    'abg6'=>$request->get('abg6'),
    'abg7'=>$request->get('abg7'),
    'abg8'=>$request->get('abg8'),
    'abg9'=>$request->get('abg9'),
    'abg10'=>$request->get('abg10'),
    'abg11'=>$request->get('abg11'),
    'abg12'=>$request->get('abg12'),
    'users_id'=>Auth::id()
  ]);
  orderwarp::where('order_id',$id)->update([
   'order_id'=>$order['id'],
   'desenadi'=>$request->get('desen_id'),
   'cno1'=>$request->get('cno1'),
   'cne1'=>$request->get('cne1'),
   'crenk1'=>$request->get('crenk1'),
   'cgr1'=>$request->get('cgr1'),           
   'cno2'=>$request->get('cno2'),
   'cne2'=>$request->get('cne2'),
   'crenk2'=>$request->get('crenk2'),
   'cgr2'=>$request->get('cgr2'),           
   'cno3'=>$request->get('cno3'),
   'cne3'=>$request->get('cne3'),
   'crenk3'=>$request->get('crenk3'),
   'cgr3'=>$request->get('cgr3'),
   'cno4'=>$request->get('cno4'),
   'cne4'=>$request->get('cne4'),
   'crenk4'=>$request->get('crenk4'),
   'cgr4'=>$request->get('cgr4'),
   'cno5'=>$request->get('cno5'),
   'cne5'=>$request->get('cne5'),
   'crenk5'=>$request->get('crenk5'),
   'cgr5'=>$request->get('cgr5'),
   'cno6'=>$request->get('cno6'),
   'cne6'=>$request->get('cne6'),
   'crenk6'=>$request->get('crenk6'),
   'cgr6'=>$request->get('cgr6'),
   'cno7'=>$request->get('cno7'),
   'cne7'=>$request->get('cne7'),
   'crenk7'=>$request->get('crenk7'),
   'cgr7'=>$request->get('cgr7'),
   'cno8'=>$request->get('cno8'),
   'cne8'=>$request->get('cne8'),
   'crenk8'=>$request->get('crenk8'),
   'cgr8'=>$request->get('cgr8'),
   'cno9'=>$request->get('cno9'),
   'cne9'=>$request->get('cne9'),
   'crenk9'=>$request->get('crenk9'),
   'cgr9'=>$request->get('cgr9'),
   'cno10'=>$request->get('cno10'),
   'cne10'=>$request->get('cne10'),
   'crenk10'=>$request->get('crenk10'),
   'cgr10'=>$request->get('cgr10'),    
   'cno11'=>$request->get('cno11'),
   'cne11'=>$request->get('cne11'),
   'crenk11'=>$request->get('crenk11'),
   'cgr11'=>$request->get('cgr11'),        
   'cno12'=>$request->get('cno12'),
   'cne12'=>$request->get('cne12'),
   'crenk12'=>$request->get('crenk12'),
   'cgr12'=>$request->get('cgr12'),
   'cbg1'=>$request->get('cbg1'),
   'cbg2'=>$request->get('cbg2'),
   'cbg3'=>$request->get('cbg3'),
   'cbg4'=>$request->get('cbg4'),
   'cbg5'=>$request->get('cbg5'),
   'cbg6'=>$request->get('cbg6'),
   'cbg7'=>$request->get('cbg7'),
   'cbg8'=>$request->get('cbg8'),
   'cbg9'=>$request->get('cbg9'),
   'cbg10'=>$request->get('cbg10'),
   'cbg11'=>$request->get('cbg11'),
   'cbg12'=>$request->get('cbg12'),
   'users_id'=>Auth::id()
 ]);
}
return redirect('/order/order')->with('success','Sipariş Güncellendi');
}
else if ($_POST['action'] == 'Farklı Kaydet') 
{


  $firma=firma::where('id', $request->firma_id)->first();
  if ($firma->zarano<10)
    $firma->zarano=str_pad($request->firma_id, 2 , "0",STR_PAD_LEFT);
  $orderno = order::where('order_no','like',date('Y').$firma->zarano.'%')->select('order_no')->orderBy('order_no', 'desc')->first();

  if($orderno)
  {
    $getno = mb_substr($orderno->order_no, -4, null, 'utf8'); $getno = $getno+1;
    $no=str_pad($getno, 4 , "0",STR_PAD_LEFT);
    $order_no =  date('Y').$firma->zarano.$no;
  }
  else $order_no =  date('Y').$firma->zarano.'0001';


  $fiyat= str_replace(['.',','], ['.','.'], $request ->get('fiyat'));

  $request['order_no']= $order_no;
  $request['fiyat']=$fiyat;
  $order=order::create($request->all());
            /*
            $filename=$order_no;
            $resimler = $request->file('resimler');
            if (!empty($resimler))
            {   $i=1;
                foreach ($resimler as $resim) {
                    $resim_uzantı=$resim->getClientOriginalExtension();
                    $resim_isim=$filename.'-'.$i.'.'.$resim_uzantı;
                    Storage::disk('uploads')->put($filename.'/'.$resim_isim,file_get_contents($resim));
                    order::where('id',$order->id)->update(['picture'=>$i]);
                    $i++;
                }
            }
            */
            for ($i=1; $i <= 12; $i++)
            {
              $request['sira']=$i;
              $request['order_id']=$order['id'];
              $cinsne='cinsne'.$i; $request['cinsne']=$request->$cinsne;
              $crenkno='crenkno'.$i; $request['crenkno']=$request->$crenkno;
              $crenk='crenk'.$i; $request['crenk']=$request->$crenk;
              $boyanankg='boyanankg'.$i; $request['boyanankg']=$request->$boyanankg;
              $gelenkg='gelenkg'.$i; $request['gelenkg']=$request->$gelenkg;
              $request['users_id']=Auth::id();
              if (isset($request->gelenkg)||isset($request->boyanankg)||isset($request->crenk)||isset($request->crenkno)||isset($request->cinsne))
                orderdetailwarp::create($request->all());
            }
            for ($i=1; $i <= 12; $i++)
            {
              $request['sira']=$i; $request['order_id']=$order['id'];
              $acinsne='acinsne'.$i; $request['acinsne']=$request->$acinsne;
              $arenkno='arenkno'.$i; $request['arenkno']=$request->$arenkno;
              $ar='ar'.$i; $request['arenk']=$request->$ar;
              $aboyanankg='aboyanankg'.$i; $request['aboyanankg']=$request->$aboyanankg;
              $agelenkg='agelenkg'.$i; $request['agelenkg']=$request->$agelenkg;
              $asiklik='asiklik'.$i; $request['asiklik']=$request->$asiklik;
              $request['users_id']=Auth::id();
              if (isset($request->agelenkg)||isset($request->asiklik)||isset($request->aboyanankg)||isset($request->arenk)||isset($request->arenkno)||isset($request->acinsne))
                orderdetailweft::create($request->all());
            }


            //onay::create(['sipdurum_id'=>3,'table'=>'order','table_id'=>$order['id'],'users_id'=>Auth::id()]);
            return redirect('/order/order')->with('success','Sipariş Ekleme Başarılı..');

          }
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $order = order::find($id);
      $order -> delete();
      return redirect('/order/order')->with('success','Sipariş Silindi');
    }
    public function js ()
    {   
      $orders= order::with('firma','desen','ordertur','irsaliyesekli','unit','orderwarp','orderweft','orderdetailweft','orderdetailwarp')->whereNull('onay1')->orwhere('onay1','')->orderBy('id','DESC')->get();
      return Datatables::of($orders)
      ->addColumn('action', function ($order) {
        $action='';
        $action='<table><tr>
        <td><a href="report/'.$order->id.'" title="Rapor" target="_blank" style="color:black"><i class="far fa-sticky-note fa-2x"></i></a></td>
        <td><a href="order/'.$order->id.'" title="Planlama Detay" target="_blank" style="color:black"><i class="fas fa-desktop fa-2x"></i></a></td>
        <td><a href="takipform/'.$order->id.'" title="Üretim Takip" target="_blank" style="color:gray"><i class="fas fa-desktop fa-2x"></i></a></td>
        <td><a href="'.route('instructions.create',$order->id).'" target="_blank" style="color:black" title="Talimat Formu"><i class="fas fa-chalkboard-teacher fa-2x"></i></a></td>';
        if(!auth()->user()->hasRole('konfeksiyon plan')) $action .='<td><a href="order/'.$order->id.'/edit" style="color:black" target="_blank" title="Düzenle"><i class="far fa-edit fa-2x"></i></a></td>'; 
        if(auth()->user()->can('delete')){
          $action .='<td class="sil"> <div class="delete-form">
          <form action="order/'.$order->id.'" method="POST">
          <input type="hidden" name="_token" value="'.csrf_token().'">
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
          </form>
          </div>
          </td>';
        } 
        $action .='</tr></table>';
        return $action;
      })
      ->removeColumn('password')
      ->make(true);

    }
    public function kjs ()
    {   
      $orders= order::with('firma','desen','ordertur','irsaliyesekli','unit','orderwarp','orderweft','orderdetailweft','orderdetailwarp')->where('onay1','K')->orderBy('id','DESC')->get();
      return Datatables::of($orders)
      ->addColumn('action', function ($order) {
        $action='';
        $action='<table><tr>
        <td><a href="order/'.$order->id.'" title="Planlama Detay" target="_blank" style="color:black"><i class="fas fa-desktop fa-2x"></i></a></td>
        <td><a href="'.route('instructions.create',$order->id).'" target="_blank" style="color:black" title="Talimat Formu"><i class="fas fa-chalkboard-teacher fa-2x"></i></a></td>';
        if(auth()->user()->can('delete')){
          $action .='<td><a href="order/'.$order->id.'/edit" style="color:black" target="_blank" title="Düzenle"><i class="far fa-edit fa-2x"></i></a></td>
          <td class="sil"> <div class="delete-form">
          <form action="order/'.$order->id.'" method="POST">
          <input type="hidden" name="_token" value="'.csrf_token().'">
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
          </form>
          </div>
          </td>';
        } 
        $action .='</tr></table>';
        return $action;
      })
      ->removeColumn('password')
      ->make(true);

    }

    public function pricejs ()
    {   
      $orders= order::with('firma','unit2','kur')->whereNull('onay1')->orwhere('onay1','')->orderBy('id','DESC')->get();
      return Datatables::of($orders)
      ->removeColumn('password')
      ->make(true);
    }
    public function sortable()
    {
      foreach ($_POST['item'] as $key => $value) {
        $orderdetailwarp = orderdetailwarp::find(intval($value));
        $orderdetailwarp->sira = intval($key);
        $orderdetailwarp->save();
      }
      echo true;
    }

    public function sortable2()
    {
      foreach ($_POST['item'] as $key => $value) {
        $orderdetailweft = orderdetailweft::find(intval($value));
        $orderdetailweft->sira = intval($key);
        $orderdetailweft->save();
      }
      echo true;
    }
    public function report ($id)
    {
      $order=order::with(['iplikirsaliye.iplikirsaliyedetail'
        =>function($q){$q->groupby('iplikirsaliye_id','iplikno','ne','partino','renkno');}
                    ,'desen','firma','ordertur','ebatcins','kalitedetay','kenartipi','kenarcinsi','unit','unit2','kur','User','orderdetailwarp','orderdetailweft','leventhareket','sevkham_detail'
                  ,'ball'
                  =>function($q){$q->whereNotNull('type');}
                ])
                    ->where('id',$id)
                    ->first();


      // $order = order::join('iplikirsaliyes','iplikirsaliyes.order_id','=','orders.id')
      // ->join('iplikirsaliyedetails','iplikirsaliyes.id','=','iplikirsaliyedetails.iplikirsaliye_id')
      // ->join('iplikcins','iplikirsaliyedetails.iplikcins_id','=','iplikcins.id')
      // // ->join('leventharekets','orders.id','=','leventharekets.order_id')
      // ->join('desens','orders.desen_id','=','desens.id')
      // ->join('units','orders.munit_id','=','units.id')
      // // ->join('orderdetailwefts','orders.id','=','orderdetailwefts.order_id')
      // // ->join('orderdetailwarps','orders.id','=','orderdetailwarps.order_id')
      //  ->select('orders.order_no','desens.no','orders.miktar','units.name as birim','cozgumetraji'
      //     ,'iplikirsaliyedetails.iplikno'
      //     ,'iplikirsaliyedetails.ne'
      //     ,'iplikcins.name'
      //     )
      //  ->where('orders.id',$id)
      //  ->groupBy('iplikirsaliyedetails.iplikno','iplikirsaliyedetails.ne','iplikirsaliyedetails.iplikcins_id','iplikirsaliyedetails.partino')
      // ->first();
      // return $order;
      return view('definition.order.report',compact('order'));
    }
  }
