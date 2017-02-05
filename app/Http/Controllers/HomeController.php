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
    public function manage($mac){
      $listap = Accesspoint::where('mac','=',$mac)->where('owner','=',Auth::user()->email);
      if($listap->exists() > 0){
        $ssh = new \phpseclib\Net\SSH2($listap->first()->vpn_ip);
          if (!$ssh->login('root', '123456')) {
               exit('Login Failed');
          }

           $model = $ssh->exec('dmesg | grep board=');
           $machine = $ssh->exec('cat /proc/cpuinfo | grep machine');
           $machine = substr($machine, strpos($machine, ':')+1,strpos($machine, ' ')-2);
           $model = substr($model, strpos($model, '=')+1,15);
           $public_ip = $ssh->exec('wget -qO- http://ipecho.net/plain ; echo');
           $private_ip = $ssh->exec("ifconfig br-lan | grep 'inet addr:'| grep -v '127.0.0.1' | cut -d: -f2 | awk '{ print $1}'");
           $subnet_mask = $ssh->exec("ifconfig br-lan | grep 'Mask:'| cut -d: -f4 | awk '{ print $1}'");
           $gate_way = $ssh->exec("route -n | grep 'br-lan' | cut -d: -f4 | awk '{ print $2}' | grep -v 0.0.0.0");
           return view('manage')->withAccessPoint($listap->first())->withModel($model)->withMachine($machine)->withPublicIp($public_ip)->withPrivateIp($private_ip)
           ->withSubnetMask($subnet_mask)->withGateway($gate_way);
      }else{
        return redirect('/home');
      }
    }

    public function set_root_pass(){
      return redirect('/home');
    }
}
