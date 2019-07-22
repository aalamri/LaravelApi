<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderBooks extends Model
{
    //
    protected $table="orders_books";
    protected $fillable=["book_id","order_id"];
    public $timestamps=false;
    function book_details(){
        return $this->belongsTo("App\Book","book_id","id");
    }
}
