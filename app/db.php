<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class db extends Model
{
    public function  serveurr(){
        return $this->morphToMany('App\serveurr','sub');
    }
}
