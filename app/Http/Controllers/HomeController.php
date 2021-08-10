<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\ DB;
use App\models\order;
use App\models\desen;
use App\models\onay;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        //$order=onay::join('orders','orders.id','=','onays.table_id')->where('onays.table','order')->orderBy('orders.id','DESC')->paginate(5);
        //$desen=onay::join('desens','desens.id','=','onays.table_id')->where('onays.table','desen')->orderBy('desens.id','DESC')->paginate(5);
        return view('home');
    }
    public function onay($id)
    {
        return $id;
    }
}