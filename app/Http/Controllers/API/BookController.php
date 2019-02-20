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
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'title' => 'required',
            // 'image' => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return $this->sendError('error validation', $validator->errors());
        }

        $book = new Book;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = str_slug($request->title).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/articles');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $book->image = $name;
          }
    
    
        $book->name = $request->name;
        $book->title = $request->title;
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
