<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\boyacins;

class boyacinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boyacins=boyacins::paginate(10);
        return view('definition.boyacins.index',compact('boyacins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.boyacins.create');
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
        $request->validate([
            'name'=>'required']);
        $boyacins = new boyacins([
            'name'=> $request ->get('name')]);
        $boyacins->save();
        return redirect('/boyacins/boyacins')->with('success','Boya Cinsi Ekleme Başarılı..');
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
        $boyacins=boyacins::find($id);
        return view('definition.boyacins.edit',compact('boyacins'));
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
        $boyacins = boyacins::find($id);
        $boyacins ->name = $request->get('name');
        $boyacins -> save();
        return redirect('/boyacins/boyacins')->with('success','Boya Cinsi Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boyacins = boyacins::find($id);
        $boyacins -> delete();
        return redirect('/boyacins/boyacins')->with('success','Boya Cinsi Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = boyacins::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.boyacins.index',['boyacins'=> $posts]);
    }
}
