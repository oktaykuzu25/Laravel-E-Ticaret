<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookStoreRequest;

class BookController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $books = $user->books()->notDeleted()->get();
        return view('books.index', compact('books'));
    }
    public function create()
    {
        return view('books.create');
    }
    public function store(BookStoreRequest $request)
    {
        $user = auth()->user();
        $books = new Book();
        $books->name = $request->name;
        $books->price = $request->price;
        $books->user_id = $user->id;
        $books->save();

        return redirect()->route('books.index');
    }
    public function edit($id)
    {
        $user = auth()->user();
        $book = $user->books()->notDeleted()->find($id);
        return view('books.edit', compact('book'));
    }
    public function update(BookStoreRequest $request, $id)
    {
        $user = auth()->user();
        $book = $user->books()->notDeleted()->find($id);
        $book->name = $request->name;
        $book->price = $request->price;
        $book->save();

        return redirect()->route('books.index');
    }
    public function destroy($id)
    {
        $user = auth()->user();
        $book = $user->books()->notDeleted()->find($id);
        $book->update(['is_deleted' => 1]);

        return redirect()->route('books.index');
    }
}
