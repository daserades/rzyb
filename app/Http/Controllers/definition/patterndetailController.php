<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\patterndetail;
use App\models\desen;
use App\patternwarp;
use App\models\iplikseridi;
use App\models\iplikcins;
use App\models\boyacins;
use Auth;

class patterndetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $desen = desen::where('id','=',$id)->select('name','id')->get(); 
        $patterndetail =patterndetail::where('desen_id','=',$id)->where('iplikseridi_id',2)->get();
        $patterndetailweft =patterndetail::where('desen_id','=',$id)->where('iplikseridi_id',1)->get();
        $iplikseridi = iplikseridi::get();
        $iplikcins = iplikcins::get();
        $boyacins = boyacins::get();
        return view('definition.patterndetail.create',compact('desen','patterndetail','patterndetailweft','iplikseridi','iplikcins','boyacins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $q=patterndetail::where('desen_id',$request->get('desen_id'))->where('iplikseridi_id',$request ->get('iplikseridi_id'))->orderbydesc('id')->first();
        if($q){
        $harf=$q['harf'];
        $harf= ord($harf);
        $harf +=1;
        $harf = chr($harf);
        }else
        $harf = 'A';  
        $patterndetail = new patterndetail([
            'desen_id'=> $request ->get('desen_id'),
            'iplikseridi_id'=> $request ->get('iplikseridi_id'),
            'iplik_no' => $request ->get('iplik_no'),
            'iplik_kalin' => $request ->get('iplik_kalin'),
            'iplikcins_id'=>$request ->get('iplikcins_id'),
            'boyacins_id'=>$request ->get('boyacins_id'),
            'renk_no'=>$request ->get('renk_no'),
            'renk'=>$request ->get('renk'),
            'renk_sayisi'=>$request ->get('renk_sayisi'),
            'harf'=>$harf,
            'atki_sikligi'=>$request ->get('atki_sikligi'),
            'cozgu_sikligi'=>$request ->get('cozgu_sikligi'),
            'tekrar'=>$request ->get('tekrar'),
            'bos_atki_sayisi'=>$request ->get('bos_atki_sayisi'),
            'ayni_agiza_atilan_atki_sayisi'=>$request ->get('ayni_agiza_atilan_atki_sayisi'),
            'aciklama'=>$request ->get('aciklama'), 
            'users_id'=>Auth::id()
        ]);
        $patterndetail->save();
        return redirect('desen/'.$request->get('desen_id'))->withInput()->with('success','patterndetail Ekleme Başarılı..');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patterndetail = patterndetail::find($id);
        $desen_id = $patterndetail->desen_id;
        $iplikseridi = iplikseridi::get();
        $iplikcins = iplikcins::get();
        $boyacins = boyacins::get();
        $desen = desen::where('id','=',$desen_id)->select('name','id')->get();
        return view('definition.patterndetail.edit',compact('patterndetail','iplikseridi','desen','iplikcins','boyacins'));
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
        $patterndetail = patterndetail::find($id);
        if ($patterndetail['iplikseridi_id'] != $request->get('iplikseridi_id'))
            {
                $q=patterndetail::where('desen_id',$request->get('desen_id'))->where('iplikseridi_id',$request ->get('iplikseridi_id'))->orderbydesc('id')->first();
                if($q){
                $harf=$q['harf'];
                $harf= ord($harf);
                $harf +=1;
                $harf = chr($harf);
                }else
                $harf = 'A';
            $patterndetail ->harf= $harf;
            }
        $patterndetail ->desen_id = $request->get('desen_id');
        $patterndetail ->iplikseridi_id= $request->get('iplikseridi_id');
        $patterndetail ->iplik_no= $request->get('iplik_no');
        $patterndetail ->iplik_kalin= $request->get('iplik_kalin');
        $patterndetail ->iplikcins_id= $request->get('iplikcins_id');
        $patterndetail ->boyacins_id= $request->get('boyacins_id');
        $patterndetail ->renk_no= $request->get('renk_no');
        $patterndetail ->renk= $request->get('renk');
        $patterndetail ->renk_sayisi= $request->get('renk_sayisi');
        $patterndetail ->atki_sikligi= $request->get('atki_sikligi');
        $patterndetail ->cozgu_sikligi= $request->get('cozgu_sikligi');
        $patterndetail ->tekrar= $request->get('tekrar');
        $patterndetail ->bos_atki_sayisi= $request->get('bos_atki_sayisi');
        $patterndetail ->ayni_agiza_atilan_atki_sayisi= $request->get('ayni_agiza_atilan_atki_sayisi');
        $patterndetail ->aciklama= $request->get('aciklama');
        $patterndetail ->users_id= Auth::id();
        $patterndetail -> save();

        patternwarp::where('patterndetail_id',$patterndetail['id'])->update([
        'iplikno'=> $request->get('iplik_no'),
        'iplikkalin'=> $request->get('iplik_kalin'),
        'iplikcins_id'=> $request->get('iplikcins_id'),
        'boyacins_id'=> $request->get('boyacins_id'),
        'renk_no'=> $request->get('renk_no'),
        'renk'=> $request->get('renk'),
        'atki_sikligi'=> $request->get('atki_sikligi'),
        'cozgu_sikligi'=> $request->get('cozgu_sikligi'),
        'tekrar'=> $request->get('tekrar'),
        'bos_atki_sayisi'=> $request->get('bos_atki_sayisi'),
        'ayni_agiza_atilan_atki_sayisi'=> $request->get('ayni_agiza_atilan_atki_sayisi'),
        'users_id'=> Auth::id(),
        ]);
        
        $desenid= $request ->get('desen_id');
         return redirect('/desen/'.$desenid)->with('success','patterndetail Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patterndetail = patterndetail::find($id);
        $patterndetail -> delete();
        return back()->with('success','patterndetail Silindi');
    }

    public function copy($id)
    {
        $patterndetail= patterndetail::with('iplikseridi','boyacins','iplikcins')->where('id',$id)->get();
        return $patterndetail;
    }

    public function patternwarpCreate ($id) 
    {    $desen = desen::with(['patterndetail'=>function($q){
            $q->where('patterndetail.iplikseridi_id',1);
        },
        'patternwarp'=>function($q){
            $q->where('patternwarp.iplikseridi_id',1)->orderby('type');
        }
        ])->where('id',$id)->first();
        $desenwarp = desen::with(['patterndetail'=>function($q){
            $q->where('patterndetail.iplikseridi_id',2);
        },
        'patternwarp'=>function($q){
            $q->where('patternwarp.iplikseridi_id',2)->orderby('type');
        }])->where('id',$id)->first();
        $iplikseridi= iplikseridi::orderbydesc('id')->get();
        return view('definition.patterndetail.patternwarpCreate',compact('desen','desenwarp','iplikseridi'));
    }
    public function patternwarpJs ($id,$iplik)
    {
        $patterndetail=patterndetail::where('desen_id',$id)->where('iplikseridi_id',$iplik)->get();
        return $patterndetail;
    }
    public function patternwarpStore (Request $request)
    {
        $patterndetail = patterndetail::where('id',$request->get('harf'))->first();
        $patternwarp = new patternwarp ([
            'desen_id'=> $request->get('desen_id'),
            'iplikseridi_id'=> $patterndetail['iplikseridi_id'],
            'patterndetail_id'=> $patterndetail['id'],
            'iplikno' => $patterndetail['iplik_no'],
            'iplikkalin' => $patterndetail['iplik_kalin'],
            'iplikcins_id'=>$patterndetail['iplikcins_id'],
            'boyacins_id'=>$patterndetail['boyacins_id'],
            'renk_no'=>$patterndetail['renk_no'],
            'renk'=>$patterndetail['renk'],
            'renk_sayisi'=>$patterndetail['renk_sayisi'],
            'harf'=>$patterndetail['harf'],
            'sayi'=>$request->get('sayi'),
            'atki_sikligi'=>$patterndetail['atki_sikligi'],
            'cozgu_sikligi'=>$patterndetail['cozgu_sikligi'],
            'tekrar'=>$patterndetail['tekrar'],
            'bos_atki_sayisi'=>$patterndetail['bos_atki_sayisi'],
            'ayni_agiza_atilan_atki_sayisi'=>$patterndetail['ayni_agiza_atilan_atki_sayisi'],
            'users_id'=>Auth::id()
        ]);
        $patternwarp->save();
        return back()->with('success','Tel Sayısı Eklendi')->withInput();
    }
     public function patternwarpUpdate (Request $request)
    {
        $patterndetail= patterndetail::where('desen_id',$request->get('id'))->where('harf',$request->get('harf'))->where('iplikseridi_id',$request->get('iplikseridi'))->first();
        $patternwarp=patternwarp::find($request->get('patternwarp_id'));
            $patternwarp->iplikseridi_id= $patterndetail['iplikseridi_id'];
            $patternwarp->patterndetail_id= $patterndetail['id'];
            $patternwarp->iplikno= $patterndetail['iplik_no'];
            $patternwarp->iplikkalin= $patterndetail['iplik_kalin'];
            $patternwarp->iplikcins_id=$patterndetail['iplikcins_id'];
            $patternwarp->boyacins_id=$patterndetail['boyacins_id'];
            $patternwarp->renk_no=$patterndetail['renk_no'];
            $patternwarp->renk=$patterndetail['renk'];
            $patternwarp->harf=$patterndetail['harf'];
            $patternwarp->sayi=$request->get('sayi');
            $patternwarp->atki_sikligi=$patterndetail['atki_sikligi'];
            $patternwarp->cozgu_sikligi=$patterndetail['cozgu_sikligi'];
            $patternwarp->tekrar=$patterndetail['tekrar'];
            $patternwarp->bos_atki_sayisi=$patterndetail['bos_atki_sayisi'];
            $patternwarp->ayni_agiza_atilan_atki_sayisi=$patterndetail['ayni_agiza_atilan_atki_sayisi'];
            $patternwarp->users_id=Auth::id();
            $patternwarp -> save();
           return $patternwarp;
            //abort(403,'Yapım Aşamasındadır...');
    }
    public function destroy2($id)
    {
        $patternwarp = patternwarp::find($id);
        $patternwarp -> delete();
        return back()->with('success','Renk İplik Silindi');
    }


    public function sortable() {
//        print_r($_POST['item']);
        foreach ($_POST['item'] as $key => $value) {

            $patternwarp = patternwarp::find(intval($value));
            $patternwarp->type = intval($key);
            $patternwarp->save();
        }
        echo true;
}


}
