<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class codetypes extends Model
{
    public function notes() {

    	return $this->hasMany('App\notes');
    }
}

