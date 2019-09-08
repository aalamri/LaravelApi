<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    const CONFIRM=2;
    const ORDERED=1;
    const CANCELED=0;
    protected $fillable=["user_id","total"];
    function Books(){
        return $this->hasMany("App\OrderBooks");
    }
}
