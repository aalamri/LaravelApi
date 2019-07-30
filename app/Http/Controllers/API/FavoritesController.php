<?php

namespace App\Http\Controllers\API;

use App\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoritesController extends Controller
{
    //
    function index(Request $request)
    {
        $user = $request->user();
        return Favorite::where("user_id", $user->id)
            ->with(["Books"])
            ->orderBy("created_at", "desc")
            ->get();
    }

    function destroy($book_id, Request $request)
    {
        $user = $request->user();
        return Favorite::where("user_id", $user->id)->where("book_id", $book_id)
            ->delete();
    }

    function store(Request $request)
    {
        $user = $request->user();
        $book_id = $request->input("book_id");
        $favorite = Favorite::updateOrCreate(['user_id' => $user->id, "book_id" => $book_id]);
        return $favorite;
    }
}
