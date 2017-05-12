<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    //
    public function notes() {

    	return $this->hasMany('App\notes');
    }
}
