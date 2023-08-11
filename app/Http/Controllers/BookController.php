<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; 

class BookController extends Controller
{

    public function index()
    {
        $books = Book::all(['id','book_name','author_name','book_image','published_date','description']);
        return response()->json($books);
    }

    public function show($id)
    {
        try {
            $book = Book::findOrFail($id);
            return response()->json($book);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }


    public function edit($id)
    {
        try {
            $book = Book::findOrFail($id);
            return response()->json($book);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_name' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'book_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_date' => 'required|date',
            'description' => 'required|string',
        ]);


        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        // Handle image upload if provided
        if ($request->hasFile('book_image')) {
            $imagePath = $request->file('book_image')->store('books', 'public');
            $validatedData['book_image'] = $imagePath;
        }

        $book = Book::create($validatedData);

        return response()->json(['message' => 'Book created successfully', 'book' => $book], 201);
    }


    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->update($request->all());
            return response()->json(['message' => 'Book updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update book'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return response()->json(['message' => 'Book deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete book'], 500);
        }
    }

    

}
