<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class os extends Model
{
   public function  serveurr(){
        return $this->morphToMany('App\serveurr','sub');
    }
}
