<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problems extends Model
{
    protected $table="Problems";
    protected $fillable = [
        'Code_prb',
        'MessagePrb',
        'Serveurs_id',
        'Platformes_id',
        'AttachementProb',
    ];

    public function Serveurs() {
        return $this->belongsTo(\App\Serveurs::class,'Serveurs_id','id');
    }

    public function Platformes() {
        return $this->belongsTo(\App\Platformes::class,'Platformes_id','id');
    }

    public function Solutions() {
        return $this->hasMany(\App\Solutions::class,'id');
    }


}