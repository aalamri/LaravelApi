<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //
    protected $fillable=["user_id","book_id"];
    function Books(){
        return $this->belongsTo("App\Book","book_id","id");

    }
}
