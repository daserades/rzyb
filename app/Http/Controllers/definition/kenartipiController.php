<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\kenartipi;

class kenartipiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $kenartipi=kenartipi::paginate(10);
        return view('definition.kenartipi.index',compact('kenartipi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.kenartipi.create');
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
        $kenartipi = new kenartipi([
            'name'=> $request ->get('name')]);
        $kenartipi->save();
        return redirect('/kenartipi/kenartipi')->with('success','Kenar Tip Ekleme Başarılı..');
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
        $kenartipi=kenartipi::find($id);
        return view('definition.kenartipi.edit',compact('kenartipi'));
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
        $kenartipi = kenartipi::find($id);
        $kenartipi ->name = $request->get('name');
        $kenartipi -> save();
        return redirect('/kenartipi/kenartipi')->with('success','Kenar Tipi Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kenartipi = kenartipi::find($id);
        $kenartipi -> delete();
        return redirect('/kenartipi/kenartipi')->with('success','Makina Cinsi Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = kenartipi::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.kenartipi.index',['kenartipi'=> $posts]);
    }
}
