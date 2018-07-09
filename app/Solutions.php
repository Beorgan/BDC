<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solutions extends Model
{
    protected $fillable = [
        'MessageSol',
        'AttachementSol',
        'Problems_id'
    ];

    public function Problems() {
        return $this->belongsTo(\App\Problems::class,'Problems_id','id');
    }
}
