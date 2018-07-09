<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platformes extends Model
{
    protected $fillable = [
        'NomPlatforme'
    ];

    public function Problems() {
        return $this->hasMany(\App\Problems::class,'id');
    }
}
