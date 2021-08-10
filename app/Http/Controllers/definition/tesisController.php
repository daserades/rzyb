<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\tesis;
use App\models\firma;
use App\models\firmatipi;
use App\models\durum;
use App\User;
use Auth;

class tesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $tesis=tesis::paginate(10);
        //$tesis=tesis::where('durums_tb_id','1')->paginate(10);
        return view('definition.tesis.index',compact('tesis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $durum= durum::get();
        $firmatipi= firmatipi::get();
        $firma = firma::where('yesno_id','=','1')->get();
        return view('definition.tesis.create',['firma'=>$firma, 'firmatipi'=>$firmatipi,'durum'=>$durum]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $request->validate([
            'name'=>'required',
            'firmas_id'=>'required',
            'firmatipi_id'=>'required',
            'unvan'=>'nullable',
            'vergidairesi'=>'nullable',
            'verginumarasi'=>'nullable',
            'tel1' => 'nullable|min:10|numeric',
            'tel2' => 'nullable|min:10|numeric',
            'fax1' => 'nullable|numeric',
            'fax2' => 'nullable|numeric',
            'email1'=>'nullable',
            'email2'=>'nullable',
            'adres1'=>'nullable',
            'adres2'=>'nullable',
            'banka'=>'nullable',
            'sube'=>'nullable',
            'hesapno'=>'nullable',
            'iban'=>'nullable',
            'website'=>'nullable',
            'durums_id'=>'required',
            'aciklama'=>'nullable',
            'users_id'=>'nullable'
        ]);
        $tesis = new tesis([
            'name'=> $request ->get('name'),
            'firmas_id'=>$request ->get('firmas_id'),
            'firmatipi_id'=>$request ->get('firmatipi_id'),
            'unvan'=>$request ->get('unvan'),
            'vergidairesi'=>$request ->get('vergidairesi'),
            'verginumarasi'=>$request ->get('verginumarasi'),
            'tel1' => $request ->get('tel1'),
            'tel2' => $request ->get('tel2'),
            'fax1' => $request ->get('fax1'),
            'fax2' => $request ->get('fax2'),
            'email1'=>$request ->get('email1'),
            'email2'=>$request ->get('email2'),
            'adres1'=>$request ->get('adres1'),
            'adres2'=>$request ->get('adres2'),
            'banka'=>$request ->get('banka'),
            'sube'=>$request ->get('sube'),
            'hesapno'=>$request ->get('hesapno'),
            'iban'=>$request ->get('iban'),
            'website'=>$request ->get('website'),
            'durums_id'=>$request ->get('durums_id'),
            'aciklama'=>$request ->get('aciklama'),
            'users_id'=>Auth::id()
        ]);
        $tesis->save();
        return redirect('/tesis/tesis')->with('success','Tesis Ekleme Başarılı..');

    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $tesis=tesis::find($id);
        return view('definition.tesis.show',compact('tesis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tesis=tesis::find($id);
        $firmatipi= firmatipi::get();
        $durum= durum::get();
        $firma = firma::where('yesno_id','=','1')->get();
        return view('definition.tesis.edit',compact('tesis','firmatipi','durum','firma'));
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
        
         $request->validate([
           'name'=>'required',
            'firmas_id'=>'required',
            'firmatipi_id'=>'required',
            'unvan'=>'nullable',
            'vergidairesi'=>'nullable',
            'verginumarasi'=>'nullable',
            'tel1' => 'nullable|min:10|numeric',
            'tel2' => 'nullable|min:10|numeric',
            'fax1' => 'nullable|numeric',
            'fax2' => 'nullable|numeric',
            'email1'=>'nullable',
            'email2'=>'nullable',
            'adres1'=>'nullable',
            'adres2'=>'nullable',
            'banka'=>'nullable',
            'sube'=>'nullable',
            'hesapno'=>'nullable',
            'iban'=>'nullable',
            'website'=>'nullable',
            'durums_id'=>'required',
            'aciklama'=>'nullable',
            'users_id'=>'nullable'
        ]);
        $tesis = tesis::find($id);
        $tesis ->name = $request->get('name');
        $tesis ->firmas_id= $request->get('firmas_id');
        $tesis ->firmatipi_id= $request->get('firmatipi_id');
        $tesis ->unvan= $request->get('unvan');
        $tesis ->vergidairesi= $request->get('vergidairesi');
        $tesis ->verginumarasi= $request->get('verginumarasi');
        $tesis ->tel1= $request->get('tel1');
        $tesis ->tel2= $request->get('tel2');
        $tesis ->fax1= $request->get('fax1');
        $tesis ->fax2= $request->get('fax2');
        $tesis ->email1 = $request->get('email1');
        $tesis ->email2= $request->get('email2');
        $tesis ->adres1= $request->get('adres1');
        $tesis ->adres2= $request->get('adres2');
        $tesis ->banka= $request->get('banka');
        $tesis ->sube= $request->get('sube');
        $tesis ->hesapno= $request->get('hesapno');
        $tesis ->iban= $request->get('iban');
        $tesis ->website= $request->get('website');
        $tesis ->durums_id= $request->get('durums_id');
        $tesis ->aciklama= $request->get('aciklama');
        $tesis ->users_id= Auth::id();
        $tesis -> save();
        return redirect('/tesis/tesis')->with('success','Tesis Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tesis = tesis::find($id);
        $tesis -> delete();
        return redirect('/tesis/tesis')->with('success','Tesis Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = tesis::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.tesis.index',['tesis'=> $posts]);
    }
}
