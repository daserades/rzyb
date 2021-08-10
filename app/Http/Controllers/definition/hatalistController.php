<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\hatalist;

class hatalistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hatalist=hatalist::paginate(10);
        return view('definition.hatalist.index',compact('hatalist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.hatalist.create');
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
        $hatalist = new hatalist([
            'name'=> $request ->get('name')]);
        $hatalist->save();
        return redirect('/hatalist/hatalist')->with('success','Hata Ekleme Başarılı..');
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
        $hatalist=hatalist::find($id);
        return view('definition.hatalist.edit',compact('hatalist'));
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
        $hatalist = hatalist::find($id);
        $hatalist ->name = $request->get('name');
        $hatalist -> save();
        return redirect('/hatalist/hatalist')->with('success','Hata Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hatalist = hatalist::find($id);
        $hatalist -> delete();
        return redirect('/hatalist/hatalist')->with('success','Hata Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = hatalist::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.hatalist.index',['hatalist'=> $posts]);
    }
}
