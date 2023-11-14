<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $name = $request->name;
        $description = $request->description;

        $book = new Book();
        $book->name = $name;
        $book->description = $description;
        $book->save();

        $status = 200;
        $message = 'Book created successfully';

        $response = [
            'success' => true,
            'message'=> $message,
            'data' => $book,
        ];

        return response()->json($response);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $bookid = $book->id;
        $book = Book::find($bookid);
        $bookreview = Book::with('reviews')->findOrFail($bookid);
        $averageRating = $bookreview->reviews->avg('rating');
        $bookreviews = $bookreview->reviews;
        $review= [];
        foreach($bookreviews as $bookreview) {
            $review[] = [
                'review' => $bookreview->review,
            ];
        }

         if (is_null($book)) {
            $status = 404;
            $message = 'Book not found';

            $response = [
                'status' => $status,
                'success' => false,
                'message' => $message,
            ];

            return response()->json($response);
        } else {
            $status = 200;
            $message = 'Book retrieved successfully';

            $response = [
                'status' => $status,
                'success' => true,
                'message' => $message,
                'data' => $book,
                'review'=> $review,
                'avg_rating'=> $averageRating,

            ];

            return response()->json($response);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $bookid = $book->id;
        $book = Book::find($bookid);
        $name = $request->name;
        $description = $request->description;

        $book->name = $name;
        $book->description = $description;
        $book->save();

        $status = 200;
        $message = 'Book update successfully';

        $response = [
            'status' => $status,
            'success' => true,
            'message' => $message,
            'data' => $book,
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $bookid = $book->id;
        $book = Book::find($bookid);

        $book->delete();

        $status = 200;
        $message = 'Book deleted successfully';


            $response = [
                'success' => true,
                'status' => $status,
                'message' => $message,
            ];

            return response()->json($response);
    }
}
