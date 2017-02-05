<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Accesspoint as Accesspoint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function viewap()
    {
        if(Accesspoint::where('owner','=',Auth::user()->email)->exists() > 0){
            $aps = Accesspoint::where('owner','=',Auth::user()->email)->get();
        }else{
            $aps = null;
        }
        
        
        return view('viewap')->withAccessPoint($aps);
    }

    public function register_ap(){
        return view('register_ap');
    }

    public function register_ap_post(){
        if(Accesspoint::where('owner','=',Auth::user()->email)->exists() > 0){
            $access_points = Accesspoint::where('owner','=',Auth::user()->email)->get();
        }else{
            $access_points = null;
        }
        $mac = Input::get('mac');
        if(is_null($mac)){
            return view('register_ap')->withAccessPoints($access_points);
        }else{
        
        if(Accesspoint::where('mac','=',$mac)->exists() > 0){
            if(Accesspoint::where('mac','=',$mac)->whereNull('owner')->exists() > 0){
                $msg = 'free';
                $ap = Accesspoint::where('mac','=',$mac);
                $data = array('owner' => Auth::user()->email, 'alias' => Auth::user()->name.' - AP');
                $ap->update($data);
                return view('register_ap')->withMessage($msg)->withAccessPoint($ap->get())->withAccessPoints($access_points);
            }else{
                $msg = 'not free';
                return view('register_ap')->withMessage($msg)->withAccessPoints($access_points);
            }
        }else{
            $msg = 'no';
            return view('register_ap')->withMessage($msg)->withAccessPoints($access_points);
        }
        }
        
        
    }
}
