<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\kalitedetay;

class kalitedetayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $kalitedetay=kalitedetay::paginate(10);
        return view('definition.kalitedetay.index',compact('kalitedetay'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.kalitedetay.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // departman::create($request->all());
        //return back()->with('sucses','Departman Eklema Başarılı..');
      
        $kalitedetay = new kalitedetay([
            'name'=> $request ->get('name'),
            'cozgu_iplik'=> $request ->get('cozgu_iplik'),
            'cozgu_siklik'=> $request ->get('cozgu_siklik'),
            'atki_iplik'=> $request ->get('atki_iplik'),
            'atki_siklik'=> $request ->get('atki_siklik'),
            'gsm'=> $request ->get('gsm')

        ]);
        $kalitedetay->save();
        return redirect('/kalitedetay/kalitedetay')->with('success','Detay Ekleme Başarılı..');
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
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kalitedetay=kalitedetay::find($id);
        return view('definition.kalitedetay.edit',compact('kalitedetay'));
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
       
        $kalitedetay = kalitedetay::find($id);
        $kalitedetay ->name = $request->get('name');
        $kalitedetay ->cozgu_iplik = $request->get('cozgu_iplik');
        $kalitedetay ->cozgu_siklik = $request->get('cozgu_siklik');
        $kalitedetay ->atki_iplik = $request->get('atki_iplik');
        $kalitedetay ->atki_siklik = $request->get('atki_siklik');
        $kalitedetay ->gsm = $request->get('gsm');
        $kalitedetay -> save();
        return redirect('/kalitedetay/kalitedetay')->with('success','Detay Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kalitedetay = kalitedetay::find($id);
        $kalitedetay -> delete();
        return redirect('/kalitedetay/kalitedetay')->with('success','Detay Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = kalitedetay::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.kalitedetay.index',['kalitedetay'=> $posts]);
    }
}
