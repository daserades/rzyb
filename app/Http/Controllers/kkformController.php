<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\models\kkform;
use App\models\kkformdetail;
use App\models\sevkham_detail;
use App\models\order;
use App\models\ball;
use App\models\hatalist;
use App\models\hatapuan;
use App\models\vardiya;
use App\models\iskarta;
use QrCode;
use Auth;

class kkformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kkform.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order= order::orderby('order_no','asc')->get();
        return view('kkform.create',compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // kabul bilgi
    {
        $kkform=kkform::where('barcode',$request->barcode)->first();

        if(isset($kkform))
        {
         $kkform=kkform::where('barcode',$request->barcode)->update($request->all());

         $ball=ball::where('barcode','like','%'.$request->barcode.'%')->update([
                'kumaseni'=>$request->kumaseni,
                'ebat'=>$request->ebat,
                'hamboy'=>$request->hamboy,
                'trh'=>$request->trh
         ]);
        //$ball=ball::where('barcode',$request->barcode)->with('order')->first();
        //return redirect('kkform/kabul')->with(compact('kkform','ball'));
        }
        else 
        {
            $metre = str_replace(['.', ','], [',', '.'], $request ->get('metre'));
            $brutmetre = str_replace(['.', ','], [',', '.'], $request ->get('brutmetre'));
            $kg = str_replace(['.', ','], [',', '.'], $request ->get('kg'));
            $kkform = new kkform([
                'order_id'=> $request->get('order_id'),
                'barcode'=>$request->get('barcode'),
                'metre'=>$metre,
                'brutmetre'=>$brutmetre,
                'kumaseni'=>$request->get('kumaseni'),
                'kg'=>$kg,
                'ebat'=>$request->get('ebat'),
                'trh'=>$request->get('trh'),
                'machine_id'=>$request->get('machine_id'),
                'aciklama'=>$request->get('aciklama'), 
                'users_id'=>Auth::id()
            ]);
            $kkform->save();
            $ball=ball::with('order')->where('barcode',$request->barcode)->first();
            $kkformdetail=kkformdetail::where('kkform_id',$kkform->id)->first();
         // return redirect('/kkform/kkform/create')->withInput()->with('success','KK Form Ekleme Başarılı..');
         // return redirect('kkform/kabul')->with(compact('kkform','ball','kkformdetail'));
        }

    }  
    public function create1(Request $request)
    {
        $metre = str_replace(['.', ','], [',', '.'], $request ->get('metre'));
        $brutmetre = str_replace(['.', ','], [',', '.'], $request ->get('brutmetre'));
        $kg = str_replace(['.', ','], [',', '.'], $request ->get('kg'));
        $kkform = new kkform([
            'order_id'=> $request->get('order_id'),
            'barcode'=>$request->get('barcode'),
            'metre'=>$metre,
            'brutmetre'=>$brutmetre,
            'kumaseni'=>$request->get('kumaseni'),
            'kg'=>$kg,
            'ebat'=>$request->get('ebat'),
            'trh'=>$request->get('trh'),
            'machine_id'=>$request->get('machine_id'),
            'aciklama'=>$request->get('aciklama'), 
            'users_id'=>Auth::id()
        ]);
        $kkform->save();
        return redirect('kkform/kkform/create')->withInput()->with('success','KK Form Ekleme Başarılı..');
    }

    /**
     * Display the specified resource.//12,3
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kkform=kkform::where('order_id',$id)->get();
        //$toplam=kkform::where('order_id',$id)->get();
        return view('kkform.show',compact('kkform'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kkform=kkform::find($id);
        $order= order::get();
        return view('kkform.edit',compact('kkform','order'));
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
       $kkform = kkform::find($id);
       $kkform ->order_id = $request->get('order_id');
       $kkform ->barcode= $request->get('barcode');
       $kkform ->metre= $request->get('metre');
       $kkform ->brutmetre= $request->get('brutmetre') ;
       $kkform ->kumaseni= $request->get('kumaseni');
       $kkform ->kg= $request->get('kg');
       $kkform ->ebat= $request->get('ebat');
       $kkform ->trh= $request->get('trh');
       $kkform ->machine_id=$request->get('makina');
       $kkform ->aciklama= $request->get('aciklama');
       $kkform ->users_id= Auth::id();
       $kkform -> save();
       return redirect('/kkform/kkform')->with('success','KK Form Güncellendi');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kkform = kkform::find($id);
        $kkform -> delete();
        return redirect('/kkform/kkform')->with('success','KK Form Silindi');
    }
    public function js ()
    {   
        $kkform= kkform::with('order')
        ->orderBy('kkforms.id','DESC')->get();
        return Datatables::of($kkform)
        ->addColumn('action', function ($kkform) {
            return '<table><tr>
            <td><a href="kkform/'.$kkform->order_id.'" title="Detay" style="color:black" target="blank"><i class="fas fa-desktop fa-2x"></i></a></td>
            <td><a href="kkform/'.$kkform->id.'/edit" style="color:black" title="Düzenle" target="blank"><i class="far fa-edit fa-2x"></i></a></td>
            <td><div class="delete-form">
            <form action="kkform/'.$kkform->id.'" method="POST">
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
            </form>
            </div></td></tr></table>';
        })
        ->removeColumn('password')
        ->make(true);

    }
    public function as ()
    {   
        $kkform= sevkham_detail::join('kkforms','kkforms.id','=','sevkham_details.kkform_id')
        ->orderBy('sevkham_details.id','DESC')
        ->get();
        return $kkform;
    }

    public function kkformtop()
    {
        return view('kkform.kkformtop');
    }
    public function kabul($id) //kabul girişi
    {
        $hatapuan=hatapuan::get(); 
        $hatalist=hatalist::orderby('name')->get(); 
        $vardiya=vardiya::get(); 
        $ball=ball::with('order','leventdepo')->where('barcode',$id)->first();
        $kkform=kkform::where('barcode',$id)->first();
        if($kkform)$kkformdetail=kkformdetail::where('kkform_id',$kkform->id)->with('hatalist','hatapuan')->orderbydesc('id')->get();
        return view('kkform.kabul')->with(compact('ball','kkform','hatalist','hatapuan','vardiya','kkformdetail'));
    }
    public function kkformlist(Request $request) // kk hata kayıt
    {
        $kkform=kkform::where('barcode',$request->barcode)->first();
        $request['kkform_id'] = $kkform->id;$request['users_id'] = Auth::id();
        if($request->type <= 1){$request['type']=01; $request['no']=01;}
        kkformdetail::create($request->all());
        return redirect('kkform/kabul/'.$request->barcode)->with('success','Başarılı');
    }
    public function kkformdetaildestroy ($id)
    {
        $kkformdetail=kkformdetail::find($id);
        $kkformdetail->delete();
        return back();
    }
    public function sticker($id)
    {

        $konum = strpos($id, 'M');
        if ($konum !== false) {
                $ordertur_id=2;
            } else {
                $ordertur_id=1;
            }

        $kkform= kkform::where('barcode',$id)->with('order')->first();
            $barcode= $kkform->barcode.'-';
            $ball=ball::where('barcode',$kkform->barcode)->first();
            $no=ball::where('order_id',$ball->order_id)->max('no'); $no++;
        if($kkform->order->dokumaadet>1) 
        {
            // $bar=ball::where('barcode','like','%' . $barcode . '%')->get();
            // if(count($bar) <= 0)
            // {
                for($i=1; $i <= ($kkform->order->dokumaadet); $i++)
                {
                    $i=str_pad($i, 2 , "0",STR_PAD_LEFT);
                    ball::create([
                        'uretimtakip_id'=> $ball->uretimtakip_id,
                        'kkform_id'=> $kkform->id,
                        'barcode'=> $barcode.$i ,
                        'type'=> $i ,
                        'no'=> $no,
                        'order_id'=> $kkform->order_id,
                        'leventdepo_id'=> $ball->leventdepo_id,
                        'levent_barcode'=> $ball->levent_barcode,
                        'machine_id'=> $kkform->machine_id,
                        'metre'=> $kkform->metre,
                        'brutmetre'=> $kkform->brutmetre,
                        'kumaseni'=> $kkform->kumaseni,
                        'kg'=> $kkform->kg,
                        'ebat'=> $kkform->ebat,
                        'hamboy'=> $kkform->hamboy,
                        'durum_id'=> 1,                        
                        'ordertur_id'=> $ordertur_id,
                        'users_id'=> Auth::id(),

                    ]);
                    $no++;
                }
            $ball['durum_id'] =2; $ball ->save();
            // }
        $ball= ball::where('barcode','like','%'.$barcode.'%')->with('order')->orderbydesc('id')->limit($kkform->order->dokumaadet)->get();
            return view('kkform.multisticker',compact('ball','kkform'));
        }
        elseif ($kkform->order->dokumaadet >=0) 
        {
             ball::create([
                        'uretimtakip_id'=> $ball->uretimtakip_id,
                        'kkform_id'=> $kkform->id,
                        'barcode'=> $barcode.'01' ,
                        'type'=> '01' ,
                        'no'=> $no ,
                        'order_id'=> $kkform->order_id,
                        'leventdepo_id'=> $ball->leventdepo_id,
                        'levent_barcode'=> $ball->levent_barcode,
                        'machine_id'=> $kkform->machine_id,
                        'metre'=> $kkform->metre,
                        'brutmetre'=> $kkform->brutmetre,
                        'kumaseni'=> $kkform->kumaseni,
                        'kg'=> $kkform->kg,
                        'ebat'=> $kkform->ebat,
                        'hamboy'=> $kkform->hamboy,
                        'ordertur_id'=> $ordertur_id,
                        'durum_id'=> 1,
                        'users_id'=> Auth::id(),

                    ]);
            $ball['durum_id'] =2; $ball ->save();
            $kkform= ball::where('barcode','like','%'.$barcode.'%')->with('order')->orderbydesc('id')->first();
            return view('kkform.sticker',compact('kkform'));
        }
        else
            return view('kkform.sticker',compact('kkform'));
    }

    public function topbolme(Request $request)
    {
         $konum = strpos($request->barcode, 'M');
        if ($konum !== false) {
                $ordertur_id=2;
            } else {
                $ordertur_id=1;
            }

        $kkform=kkform::with('order')->where('barcode',$request->barcode)->first();
        $type=ball::where('barcode','like','%'.$request->barcode.'%')->max('type');
        $no=ball::where('order_id',$kkform->order_id)->max('no'); $no++;
        if($kkform->order->dokumaadet <=1)
            {
                // $type =kkformdetail::where('kkform_id',$kkform->id)->max('type'); 
                // if($type<=0)
                $type=ball::where('barcode','like','%'.$request->barcode.'%')->max('type');
                if($type<=1) $type=1;
                 $kkformdetail=kkformdetail::where([['kkform_id',$kkform->id],['type',1]])->update(['type'=>$type+1,'no'=>$no]);
                 // $type=kkformdetail::where([['kkform_id',$kkform->id]])->orderbydesc('id')->pluck('type')->first();
                  $type= $type+1;
                   $ball=ball::where('barcode',$kkform->barcode)->first();
                    $type=str_pad($type, 2 , "0",STR_PAD_LEFT);
                       $ball=ball::create([
                           'uretimtakip_id'=> $ball->uretimtakip_id,
                         'kkform_id'=> $kkform->id,
                           'barcode'=> $request->barcode.'-'.$type ,
                           'type'=>$type,
                           'no'=>$no,
                           'order_id'=> $kkform->order_id,
                           'leventdepo_id'=> $ball->leventdepo_id,
                           'levent_barcode'=> $ball->levent_barcode,
                           'machine_id'=> $kkform->machine_id,
                           'metre'=> $request->topbolme,
                           'brutmetre'=> $request->topbolme,
                           'kumaseni'=> $kkform->kumaseni,
                           'kg'=> $kkform->kg,
                           'ebat'=> $kkform->ebat,
                        'ordertur_id'=> $ordertur_id,
                           'hamboy'=> $kkform->hamboy,
                           'durum_id'=> 1,
                        'trh'=>now(),
                           'users_id'=> Auth::id(),
       
                       ]);
        $kkform=ball::where('barcode','like','%'.$request->barcode.'%')->orderbydesc('id')->first();
            return view('kkform.sticker',compact('kkform'));
            }
       else     
       { 
        if ($type <= $kkform->order->dokumaadet) $type=$kkform->order->dokumaadet;
                   $sayac=1;
               for($i=$type+1;  $i <= ($kkform->order->dokumaadet)+$type; $i++)
               {
                   $kkformdetail=kkformdetail::where([['kkform_id',$kkform->id],['type',$sayac]])->update(['type'=>$i,'no'=>$no]);
                   $ball=ball::where('barcode',$kkform->barcode)->first();
                   $i=str_pad($i, 2 , "0",STR_PAD_LEFT);
                       $ball=ball::create([
                           'uretimtakip_id'=> $ball->uretimtakip_id,
                          'kkform_id'=> $kkform->id,
                           'barcode'=> $request->barcode.'-'.$i ,
                           'type'=>$i,
                           'no'=>$no,
                           'order_id'=> $kkform->order_id,
                           'leventdepo_id'=> $ball->leventdepo_id,
                           'levent_barcode'=> $ball->levent_barcode,
                           'machine_id'=> $kkform->machine_id,
                           'metre'=> $request->topbolme,
                           'brutmetre'=> $request->topbolme,
                           'kumaseni'=> $kkform->kumaseni,
                           'kg'=> $kkform->kg,
                        'ordertur_id'=> $ordertur_id,
                           'ebat'=> $kkform->ebat,
                           'hamboy'=> $kkform->hamboy,
                           'durum_id'=> 1,
                           'users_id'=> Auth::id(),
       
                       ]);
                   $sayac++; $no++;
                   // echo $i.'asd '.$sayac .'<br>';
               }
        $ball=ball::where('barcode','like','%'.$request->barcode.'%')->orderbydesc('id')->limit($kkform->order->dokumaadet)->get();
        return view('kkform.multisticker',compact('ball','kkform'));
           }


    }

        public function iskarta(Request $request)
    {
        $request['users_id']=Auth::id();
        iskarta::create($request->all());
    }

       public function ball_list()
    {
        return view('kkform.ball_list');
    }
    public function ball_list_js ()
    {   
        $ball= ball::with('order','durum')->where('durum_id',1)->whereNotNull('metre')->orderBy('balls.id','DESC')->get();
        return Datatables::of($ball)
        ->addColumn('action', function ($ball) {
        $sql= '<table><tr>';
         if(auth()->user()->hasRole('genel mudur|planlama|admin'))$sql .='<td><a href="ballsticker/'.$ball->id.'" style="color:black" title="Etiket Bas"><i class="fas fa-print fa-1x"></i></a></td>';
         if(auth()->user()->hasRole('genel mudur|planlama|admin'))$sql .='<td><a href="ball/'.$ball->id.'" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>';
         if(auth()->user()->hasRole('genel mudur|planlama|admin'))$sql .='<td class="sil"> <div class="delete-form">
                    <form action="delete/'.$ball->id.'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
                    </form>
                 </div>
                 </td>';
       $sql .='</tr></table>';

       return $sql;
     })
        ->removeColumn('password')
        ->make(true);
    }

    public function shipball_list()
    {
        return view('kkform.ball_list');
    }
    public function shipball_js ()
    {   
        $ball= ball::with('order','durum')->where('durum_id',2)->whereNotNull('type')->orderBy('balls.id','DESC')->get();
        return Datatables::of($ball)
        ->addColumn('action', function ($ball) {
        $sql= '<table><tr>';
         if(auth()->user()->hasRole('genel mudur|planlama|admin'))$sql .='<td><a href="ballsticker/'.$ball->id.'" style="color:black" title="Etiket Bas"><i class="fas fa-print fa-1x"></i></a></td>';
         if(auth()->user()->hasRole('genel mudur|planlama|admin'))$sql .='<td><a href="ball/'.$ball->id.'" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>';
         if(auth()->user()->hasRole('genel mudur|planlama|admin'))$sql .='<td class="sil"> <div class="delete-form">
                    <form action="delete/'.$ball->id.'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
                    </form>
                 </div>
                 </td>';
       $sql .='</tr></table>';

       return $sql;
     })
        ->removeColumn('password')
        ->make(true);
    }

    public function ballerror($id)
    {
        $type=ball::where('id',$id)->pluck('type')->first();
        $ball=ball::with(['order','user','kkform.kkformdetail'=>function($q) use ($type){
            $q->where('type',$type);
        }])->where('id',$id)->first();
        return view('kkform.hatalist',compact('ball'));
    }

    public function orderball($id)
    {
        $order=order::with(['ball'=>function($q){
            $q->where('durum_id',1)->where('metre','>', 0);
            } 
            ,'desen','ordertur','unit'])->where('id',$id)->first();
        return view('kkform.orderball',compact('order'));
    }

   public function balledit($id)
    {
      $ball=ball::find($id);
      return view('kkform.balledit',compact('ball'));
    }
    public function ballupdate(Request $request)
    {
      unset($request['_token']);
      $ball=ball::where('id',$request->id)->update($request->all());
      return redirect('kkform/ball_list')->with('success','Başarılı..');
    }

      public function destroy2($id)
    {
        $ball = ball::where('id',$id)->update(['durum_id'=>3]);
        return back()->with('success','Top Silindi');
    }
      public function ballsticker($id)
    {
        $kkform = ball::where('id',$id)->with('order')->first();
        if(isset($kkform->type))
        return view('kkform.sticker',compact('kkform'));
        else
        return view('kkform.firststicker',compact('kkform'));
    }

       public function uretilentop_list()
    {
        return view('kkform.uretilentop_list');
    }
    public function uretilentop_list_js()
    {
        $ball=ball::whereNull('type')->with('order','durum')->get();
         return Datatables::of($ball)
        ->addColumn('action', function ($ball) {
        $sql= '<table><tr>';
         if(auth()->user()->hasRole('genel mudur|planlama|admin'))$sql .='<td><a href="ballsticker/'.$ball->id.'" style="color:black" title="Etiket Bas"><i class="fas fa-print fa-1x"></i></a></td>';
         if(auth()->user()->hasRole('genel mudur|planlama|admin'))$sql .='<td><a href="ball/'.$ball->id.'" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>';
         if(auth()->user()->hasRole('genel mudur|planlama|admin'))$sql .='<td class="sil"> <div class="delete-form">
                    <form action="delete/'.$ball->id.'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
                    </form>
                 </div>
                 </td>';
       $sql .='</tr></table>';

       return $sql;
     })
        ->removeColumn('password')
        ->make(true);
    } 
}
