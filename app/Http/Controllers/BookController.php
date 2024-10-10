<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json(['data' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'error brooo', 'error' => $validator->errors()]);
        }
        $waktu_sekarang = Carbon::now();

        $books = Book::create([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'published_date' => $waktu_sekarang,
            'description' => $request->description
        ]);
        return response()->json(['message' => 'joss gandoss bisa', 'data' => $books]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) return response()->json('buku tidak ditemukan', 404);
        $book->update($request->all());
        return response()->json('Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $book = Book::find($id);
        if (!$book) return response()->json('buku tidak ditemukan', 404);
        $book->delete();
        return response()->json('Berhasil Delete data');
    }
}
