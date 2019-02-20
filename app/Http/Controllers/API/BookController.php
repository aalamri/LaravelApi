<?php

namespace App\Http\Controllers\API;

use App\Book;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use App\file;
class BookController extends BaseController
{

    public function index()
    {
        # code...
        $books = Book::all();
     
        return $this->sendResponse($books->toArray(), 'Books read succesfully');
    }

    public function store(Request $request)
    {
        # code...
        // $input = $request->all();
        // $validator = Validator::make($input, [
        //     'name' => 'required',
        //     'title' => 'required',
        //     // 'image' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     # code...
        //     return $this->sendError('error validation', $validator->errors());
        // }

        $book = new file;
        $book->title = Input::get('name');
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $file->move(public_path(). '/', $file->getClientOriginalName());
            $book->name = $file->getClientOriginalName();
          }
    
     //   $book->name = $request->name;
        // $book->detials = $request->details;
        $book->save();
    
        return $this->sendResponse($book->toArray(), 'Book  created succesfully');

    }

    public function show($id)
    {
        $book = Book::find($id);
        if (is_null($book)) {
            # code...
            return $this->sendError('book not found ! ');
        }
        return $this->sendResponse($book->toArray(), 'Book read succesfully');

    }

// update book
    public function update(Request $request, Book $book)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return $this->sendError('error validation', $validator->errors());
        }
        $book->name = $input['name'];
        $book->title = $input['title'];
        $book->save();
        return $this->sendResponse($book->toArray(), 'Book  updated succesfully');

    }

// delete book
    public function destroy(Book $book)
    {

        $book->delete();

        return $this->sendResponse($book->toArray(), 'Book  deleted succesfully');

    }

}
