<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function plates(){
        return $this->belongsToMany('App\Plate')->withPivot('quantity');;
    }
}
