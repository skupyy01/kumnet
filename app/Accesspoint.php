<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesspoint extends Model
{
    public function getAllAP(){
    	$ap = \App\Accesspoint::All();
    	return $ap;
    }
}
