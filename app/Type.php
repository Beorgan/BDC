<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'Designation',

    ];
    public function Serveurs() {
        return $this->belongsTo(\App\Serveurs::class,'Serveurs_id','id');
    }


}
