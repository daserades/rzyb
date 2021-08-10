<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\uretimtakip;
use App\models\machine;
use App\models\order;
use App\models\leventdepo;
use App\models\ball;
use Auth;
use QrCode;
use COM;

class uretimtakipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $leventdepo=leventdepo::leftjoin('uretimtakips','uretimtakips.leventdepo_id','=','leventdepos.id')
                                ->select('leventdepos.*')
                                ->wherenull('uretimtakips.leventdepo_id')
                                ->orwhere('end','!=',null)
                                ->get();
        */
        $machine=machine::get();
        $uretimtakip=uretimtakip::where('end',null)->get();
        return view('uretimtakip.index',compact('uretimtakip','machine'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // top kesim ekranı
    {
        return view('uretimtakip.topkes');
    }

    public function create1($id) //makina ekranı
    {
        $uretimtakip=uretimtakip::with('machine')->where('machine_id',$id)->where('end',null)->first();
        return view('uretimtakip.create',compact('uretimtakip','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // makinaya levent giriş
    {
        /*$request['order_id']=leventdepo::where('barcode',$request->barcode)->pluck('order_id')->first();
        $request['leventdepo_id']=leventdepo::where('barcode',$request->barcode)->pluck('id')->first();
        $request['start']=now(); $request['users_id']=auth::id();
        uretimtakip::create($request->all());
        */
        $order=order::where('id',$request->order_id)->whereNull('onay1')->first();
        if ($order)
        {
            $levent=leventdepo::with('leventhareket')->where('barcode',$request->barcode)->where('durum_id',1)->first();
            if($levent)
            {
              if ($levent->stok == 0 && $levent->order_id == $order->id)
                  {
                    $request['start']=now(); 
                    $request['users_id']=auth::id();
                    $request['leventdepo_id']=$levent->id;
                    uretimtakip::create($request->all());
                    leventdepo::find($request->leventdepo_id)->update(['durum_id'=>2]);
                    return redirect('uretimtakip/uretimtakip');
                  }  
               elseif ($levent->stok == 1 || $levent->stok ==null) 
                  {
                    $request['start']=now(); 
                    $request['users_id']=auth::id();
                    $request['leventdepo_id']=$levent->id;
                    uretimtakip::create($request->all());
                    leventdepo::find($request->leventdepo_id)->update(['durum_id'=>2]);
                    return redirect('uretimtakip/uretimtakip');
                  }
                // elseif($levent->stok == null) return back()->with('error','Levent Siparişle Eşleşmemiş!!!');   
                else   return back()->with('error','Hatalı Levent veya Hatalı Sipariş!!!');
            }
            else return back()->with('error','Hatalı Levent !!!');
        }
        else return back()->with('error','Hatalı Form !!!');
    }   


    public function stop (Request $request) // levent değiştir
    {
        uretimtakip::where([['barcode',$request->barcode],['machine_id',$request->machine_id],['end',null]])->update(['end'=>now()]);
        leventdepo::where('barcode',$request->barcode)->update(['durum_id'=>1]);
       return redirect('uretimtakip/uretimtakip');
        //uretimtakip::create($request->all());
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //levent sonu bitir
    {
        uretimtakip::where('id',$id)->update(['end'=>now()]);
        $uretimtakip=uretimtakip::find($id);
        leventdepo::where('barcode',$uretimtakip->barcode)->update(['durum_id'=>3]);
        return redirect('uretimtakip/uretimtakip');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$uretimtakip=uretimtakip::with('order')->find($id);
        if($uretimtakip)
        {
            $ball=ball::where('order_id',$uretimtakip->order_id)->latest('id')->first();
            if($ball)
            {
                $no=explode('-',$ball->barcode); $no=$no[1]+1;
                if($no< 10) $no=str_pad($no, 2 , "0",STR_PAD_LEFT);
                $ball=ball::create([
                'uretimtakip_id'=>$uretimtakip->id,
                'barcode'=>$uretimtakip->order->order_no.'-'.$no,
                'order_id'=>$uretimtakip->order_id,
                'leventdepo_id'=>$uretimtakip->leventdepo_id,
                'levent_barcode'=>$uretimtakip->barcode,
                'machine_id'=>$uretimtakip->machine_id,
                'users_id'=>Auth::id()
                ]);        
            }
            else
            {   
                $no= $uretimtakip->order->order_no.'-01';
                 $ball=ball::create([
                'uretimtakip_id'=>$uretimtakip->id,
                'barcode'=>$no,
                'order_id'=>$uretimtakip->order_id,
                'leventdepo_id'=>$uretimtakip->leventdepo_id,
                'levent_barcode'=>$uretimtakip->barcode,
                'machine_id'=>$uretimtakip->machine_id,
                'users_id'=>Auth::id()
                ]);
            }
            return view('uretimtakip.barcode',compact('ball'));
        }*/
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // KKFORMDETAİLS DAN DOLAYI YANLIŞ
    }

    public function machinebarcode ()
    {
        $machine=machine::get();
        return view('uretimtakip.machine',compact('machine'));
    }

    public function topkes(Request $request)
    {
        $uretimtakip = uretimtakip::where('machine_id',$request->machine_id)->orderbydesc('id')->first();
         if($uretimtakip)
        {
            $ball=ball::where('order_id',$uretimtakip->order_id)->whereRaw('LENGTH(barcode) <= 14')->latest('id')->first();

            if($ball)
            {
                $no=explode('-',$ball->barcode); $no=$no[1]+1;
                if($no< 10) $no=str_pad($no, 2 , "0",STR_PAD_LEFT);
                $ball_no=$uretimtakip->order->order_no.'-'.$no;
                $ball=ball::create([
                'uretimtakip_id'=>$uretimtakip->id,
                'barcode'=>$ball_no,
                'order_id'=>$uretimtakip->order_id,
                'leventdepo_id'=>$uretimtakip->leventdepo_id,
                'levent_barcode'=>$uretimtakip->barcode,
                'machine_id'=>$uretimtakip->machine_id,
                'durum_id'=>1,
                'users_id'=>Auth::id()
                ]);        
            }
            else
            {   
                $ball_no= $uretimtakip->order->order_no.'-01';
                 $ball=ball::create([
                'uretimtakip_id'=>$uretimtakip->id,
                'barcode'=>$ball_no,
                'order_id'=>$uretimtakip->order_id,
                'leventdepo_id'=>$uretimtakip->leventdepo_id,
                'levent_barcode'=>$uretimtakip->barcode,
                'machine_id'=>$uretimtakip->machine_id,
                'durum_id'=>1,
                'users_id'=>Auth::id()
                ]);
            }

        $asd=QrCode::format('png')->size(130)->generate($ball->barcode);
        $top=50;

              $PrintJob = new COM("GoDEXATL.Function");
              $PrintJob->OpenNet("192.168.1.201","9100");
              $PrintJob->setup(100, 4, 3, 1, 3,0); //(height, dark, speed , mode, gap, top)
              $PrintJob->sendcommand("^L\r\n");
              $PrintJob->ecTextOut(170, $top, 50, "Arial", 'BAYZARA TEKSTiL');
              // $PrintJob->putimage(125, $top+40, $asd, 0); Wx,y,mode,type,ec,mask,mul,len,roatae<CR> data
               $PrintJob->sendcommand("W550,150,2,1,M,8,5,10,0
                ".$ball_no);
              // $PrintJob->sendcommand("W10,10,2,1,L,8,10,36,0 0123456789ABCDEFGHIJKLMNOPQRSTUV WXYZ\r");
              // $PrintJob->Bar_QRcode(100, 100, 3, 1, M, 3, 3, 5, 0, $asd); 

              $PrintJob->ecTextOut(50, $top+200, 40, "Arial", 'Top No = '.$ball_no );
              $PrintJob->ecTextOut(50, $top+300, 40, "Arial",'Siparis No = '.$ball->order->order_no );
              $PrintJob->ecTextOut(50, $top+400, 40, "Cambria",'Desen No = '.$ball->order->desen->no);
              $PrintJob->ecTextOut(50, $top+500, 40, "Arial",'Levet No = '.$ball->levent_barcode);
              $PrintJob->ecTextOut(50, $top+600, 40, "Arial",'Makina No = '.$ball->machine->name);

              //$PrintJob->ecTextOutR(10, 50, 34, "Arial", "ecTextOutR for test", 0, 0, 180);
              //$PrintJob->ecTextOutFine(10, 100, 34, "Arial", "ecTextOutFine for test", 0, 700, 0, 1, 0, 0, 1);
              $PrintJob->sendcommand("E\r\n");
              $PrintJob->closeport();


            //return view('uretimtakip.barcode',compact('ball'));
            return back()->with('success','Top Etiketi Yazdırıldı...');
        }   
    }
}
