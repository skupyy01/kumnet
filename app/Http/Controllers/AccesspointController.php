<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Accesspoint as Accesspoint;
class AccesspointController extends Controller
{
    public function accesspoint(){
    	$accesspoints = Accesspoint::All();
    	foreach ($accesspoints as $ap) {
    		echo $ap->vpn_ip;
    	}
    }
    
    public function addap($mac, $ip){
    	$exist_mac = \DB::table('accesspoints')->where('mac', $mac)->first();
    	if($exist_mac === null){
    		\DB::table('accesspoints')->insert(
    			['mac' => $mac, 'vpn_ip' => $ip,'update_time' => new \DateTime()]
			);
			echo 'added ap';
    	}else{
    		\DB::table('accesspoints')
            ->where('mac', $mac)
            ->update(['vpn_ip' => $ip]);
            \DB::table('accesspoints')
            ->where('mac', $mac)
            ->update(['update_time' => new \DateTime()]);
            echo 'updated ip';
    	}
    	
    }

    public function countAp($user){
    	$aps = Accesspoint::where('owner','=',$user)->get();
    	foreach ($aps as $ap) {
    		echo $ap->mac;
    	}
    }
}
