<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serveurs extends Model
{
    protected $fillable = [
        'Designation',
        'Platformes_id'
    ];


    public function Problems() {
        return $this->hasMany(\App\Problems::class,'id');
    }

    public function Types() {
        return $this->hasMany(\App\Type::class,'id','type_id');
    }


}
