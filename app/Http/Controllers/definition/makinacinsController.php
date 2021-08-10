<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\makinacins;

class makinacinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makinacins=makinacins::paginate(10);
        return view('definition.makinacins.index',compact('makinacins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.makinacins.create');
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
        $makinacins = new makinacins([
            'name'=> $request ->get('name')]);
        $makinacins->save();
        return redirect('/makinacins/makinacins')->with('success','Makina Cinsi Ekleme Başarılı..');
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
        $makinacins=makinacins::find($id);
        return view('definition.makinacins.edit',compact('makinacins'));
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
        $makinacins = makinacins::find($id);
        $makinacins ->name = $request->get('name');
        $makinacins -> save();
        return redirect('/makinacins/makinacins')->with('success','Makina Cinsi Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $makinacins = makinacins::find($id);
        $makinacins -> delete();
        return redirect('/makinacins/makinacins')->with('success','Makina Cinsi Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = makinacins::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.makinacins.index',['makinacins'=> $posts]);
    }
}
