<?php

namespace App\Http\Controllers\API;

use App\Order;
use App\Http\Controllers\API\BaseController as BaseController;

use App\OrderBooks;
use Illuminate\Http\Request;

class OrdersController extends BaseController
{
    //
    function store(Request $request)
    {
        $user = $request->user();
        $req = $request->input();
        $books = $req['books'];
        $req['user_id'] = $user->id;
        $order = Order::create($req);
        $order->Books()->createMany($books);
        return $order;
    }

    function index(Request $request)
    {
        $user = $request->user();
        return Order::where("user_id", $user->id)
            ->with(["Books", "Books.book_details"])
            ->orderBy("id", "desc")
            ->get();
    }
    function confirm(Request $request)
    {
        $user = $request->user();
        return Order::where("user_id", $user->id)->where('id', $request->input('order_id'))
            ->update(["status" => Order::CONFIRM]);
    }

    function cancel(Request $request)
    {
        $user = $request->user();
        return Order::where("user_id", $user->id)->where('id', $request->input('order_id'))
            ->update(["status" => Order::CANCELED]);
    }
}
