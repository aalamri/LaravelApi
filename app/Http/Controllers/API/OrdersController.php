<?php

namespace App\Http\Controllers\API;

use App\Order;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;

class OrdersController extends BaseController
{
    //
    function store(Request $request)
    {
        //todo auth user
        $req = $request->input();
        $books = $req['books'];
        unset($req['books']);
        $order = Order::create($req);
        $order->Books()->createMany($books);
        return $order;
    }

    function index(Request $request)
    {
        //todo auth user
        return Order::where("user_id", $request->input("user_id"))
            ->with(["Books","Books.book_details"])
            ->orderBy("id","desc")
            ->get();
    }

    function cancel(Request $request)
    {

    }
}
