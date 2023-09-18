<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Book::query()->orderBy('id', 'desc')->paginate(10);

        return Inertia::render('books', [
            'data' => $data
        ]);
    }

    public function store(StoreBookRequest $request)
    {
        Validator::make($request->all(),[
            'title' => 'required',
            'author' => 'required'
        ])->validate();

        Book::create($request->all());

        return redirect()->back()->with('message', 'Book Created!');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        Validator::make($request->all(),[
            'title' => 'required',
            'author' => 'required'
        ])->validate();

        $book->update($request->all());

        return redirect()->back()->with('message', 'Book Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->back()->with('message', 'Book Deleted!');
    }
}
