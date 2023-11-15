<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputReview = $request->review;
        $rating = $request->rating;
        $user_id = $request->user_id;
        $book_id = $request->book_id;


        // Check if the user has already reviewed the book
        if (Review::where('user_id', $user_id)->where('book_id', $book_id)->exists()) {
            return response()->json(['error' => 'You have already reviewed this book.'], 422);
        }
        $review = new Review();
        $review->review = $inputReview;
        $review->rating = $rating;
        $review->user_id = $user_id;
        $review->book_id = $book_id;
        $review->save();

        $status = 200;
        $message = "Review and rating given successfully";

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $review,
        ];
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
