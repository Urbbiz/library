<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //FILTRAVIMAS
        $authors = Author::all();

        if($request->author_id) {
            $books = Book::where('author_id',$request->author_id) ->get();
            $filterBy = $request->author_id;
        }
        else {
            $books = Book::all();
        }

        // Rusiavimas SORT
        if($request->sort && 'asc' == $request->sort) {
            $books = $books ->sortBy('title');
            $sortBy = 'asc';
        }
        elseif($request->sort && 'desc' == $request->sort) {
            $books = $books ->sortByDesc('title');
            $sortBy = 'desc';
        }

    return view('book.index', [
        'books' => $books, 
        'authors' => $authors,
        'filterBy'=>$filterBy ?? 0,
        'sortBy' => $sortBy ?? ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('book.create', ['authors' => $authors]);
 
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
             [
           'book_title' => ['required', 'min:3', 'max:64'],
           'book_isbn' => ['required', 'max:64'],
           'book_pages' => ['required','max:64'],
           'book_about' => ['required', 'min:3', 'max:200'],
           'author_id' => ['required'],
            ],
            [
            'book_title.required' => 'Book title cannot be empty!',
            'author_surname.required' => 'ISBN title cannot be empty!',
            'author_id.required' => 'Author ID is required!',
            ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }


        $book = new Book;
       $book->title = $request->book_title;
       $book->isbn = $request->book_isbn;
       $book->pages = $request->book_pages;
       $book->about = $request->book_about;
       $book->author_id = $request->author_id;
       $book->save();
       return redirect()->route('book.index')->with('success_message', 'Book created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        
        $authors = Author::all();
        return view('book.edit', ['book' => $book, 'authors' => $authors]);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

        $validator = Validator::make(
            $request->all(),
             [
           'book_title' => ['required', 'min:3', 'max:64'],
           'book_isbn' => ['required', 'max:64'],
           'book_pages' => ['required','max:64'],
           'book_about' => ['required', 'min:3', 'max:200'],
           'author_id' => ['required'],
            ],
            [
            'book_title.required' => 'Book title cannot be empty!',
            'author_surname.required' => 'ISBN title cannot be empty!',
            'author_id.required' => 'Author ID is required!',
            ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->save();
        return redirect()->route('book.index')->with('success_message', 'Book updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
       return redirect()->route('book.index')->with('success_message', 'Book deleted!');

    }
}
