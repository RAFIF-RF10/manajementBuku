<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json(['data' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'bio' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'gagal broo', 'error' => $validator->errors()]);
        }
        $author = Author::create([
            'name' => $request->name,
            'bio' => $request->bio
        ]);
        return response()->json(['message' => 'joss gandoss bisa', 'data' => $author]);
    }


    /**
     * Display the specified resource.
     */
    public function show(author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(author $author)
    {
        //
    }
}
