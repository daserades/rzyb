<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\firma;
use App\models\firmatipi;
use App\models\durum;
use App\models\country;
use App\models\city;
use App\models\yesno;
use App\User;
use Auth;

class firmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $firma=firma::orderbydesc('id')->paginate(10);
        //$firma=firma::where('durums_tb_id','1')->paginate(10);
        return view('definition.firma.index',compact('firma'));
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
        $country= country::get();
        $city= city::get();
        $yesno= yesno::get();
        return view('definition.firma.create',['firmatipi'=>$firmatipi,'durum'=>$durum,'country'=>$country,'city'=>$city,'yesno'=>$yesno]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $firma = new firma([
            'zarano'=> $request ->get('zarano'),
            'name'=> $request ->get('name'),
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
            'countries_id'=>$request ->get('countries_id'),
            'cities_id'=>$request ->get('cities_id'),
            'banka'=>$request ->get('banka'),
            'sube'=>$request ->get('sube'),
            'hesapno'=>$request ->get('hesapno'),
            'iban'=>$request ->get('iban'),
            'website'=>$request ->get('website'),
            'durums_id'=>$request ->get('durums_id'),
            'yesno_id'=>$request ->get('yesno_id'),
            'aciklama'=>$request ->get('aciklama'),
            'users_id'=>Auth::id()
        ]);
        $firma->save();
        return redirect('/firma/firma')->with('success','Firma Ekleme Başarılı..');

    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $firma=firma::find($id);
        return view('definition.firma.show',compact('firma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $firma=firma::find($id);
        $firmatipi= firmatipi::get();
        $durum= durum::get();
        $country= country::get();
        $city= city::get();
        $yesno= yesno::get();
        return view('definition.firma.edit',compact('firma','firmatipi','durum','country','city','yesno'));
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
        $firma = firma::find($id);
        $firma ->zarano = $request->get('zarano');
        $firma ->name = $request->get('name');
        $firma ->firmatipi_id= $request->get('firmatipi_id');
        $firma ->unvan= $request->get('unvan');
        $firma ->vergidairesi= $request->get('vergidairesi');
        $firma ->verginumarasi= $request->get('verginumarasi');
        $firma ->tel1= $request->get('tel1');
        $firma ->tel2= $request->get('tel2');
        $firma ->fax1= $request->get('fax1');
        $firma ->fax2= $request->get('fax2');
        $firma ->email1 = $request->get('email1');
        $firma ->email2= $request->get('email2');
        $firma ->adres1= $request->get('adres1');
        $firma ->adres2= $request->get('adres2');
        $firma ->countries_id= $request->get('countries_id');
        $firma ->cities_id= $request->get('cities_id');
        $firma ->banka= $request->get('banka');
        $firma ->sube= $request->get('sube');
        $firma ->hesapno= $request->get('hesapno');
        $firma ->iban= $request->get('iban');
        $firma ->website= $request->get('website');
        $firma ->durums_id= $request->get('durums_id');
        $firma ->yesno_id= $request->get('yesno_id');
        $firma ->aciklama= $request->get('aciklama');
        $firma ->users_id= Auth::id();
        $firma -> save();
        return redirect('/firma/firma')->with('success','Firma Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $firma = firma::find($id);
        $firma -> delete();
        return redirect('/firma/firma')->with('success','Firma Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = firma::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.firma.index',['firma'=> $posts]);
    }
}
