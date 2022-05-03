<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $fillable = [
        'name', 'ingredients', 'price'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function orders(){
        return $this->belongsToMany('App\Order');
    }
}
