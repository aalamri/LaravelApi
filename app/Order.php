<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable=["user_id","total"];
    function Books(){
        return $this->hasMany("App\OrderBooks");
    }
}
