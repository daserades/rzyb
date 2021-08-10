<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\surecislemi;

class surecislemiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $surecislemi=surecislemi::paginate(10);
        return view('definition.surecislemi.index',compact('surecislemi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.surecislemi.create');
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
            'name'=>'required']);
        $surecislemi = new surecislemi([
            'name'=> $request ->get('name')]);
        $surecislemi->save();
        return redirect('/surecislemi/surecislemi')->with('success','Süreç İşlemi Ekleme Başarılı..');
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
        $surecislemi=surecislemi::find($id);
        return view('definition.surecislemi.edit',compact('surecislemi'));
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
            'name' => 'required']);
        $surecislemi = surecislemi::find($id);
        $surecislemi ->name = $request->get('name');
        $surecislemi -> save();
        return redirect('/surecislemi/surecislemi')->with('success','Süreç İşlemi Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $surecislemi = surecislemi::find($id);
        $surecislemi -> delete();
        return redirect('/surecislemi/surecislemi')->with('success','Süreç İşlemi Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = surecislemi::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.surecislemi.index',['surecislemi'=> $posts]);
    }
}
