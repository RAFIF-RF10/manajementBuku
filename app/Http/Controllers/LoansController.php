<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    // Metode untuk meminjam buku
    public function loan(Request $request)
    {
        $user = Auth::user();
        if(!$user) {
            return response()->json(['message' => 'unauthenticated']);
        }
        // Validasi sederhana
        $request->validate(['book_id' => 'required|exists:books,id']);

        // Cek apakah buku sudah dipinjam dan belum dikembalikan
        if (Loans::where('user_id', $user->id)->where('book_id', $request->book_id)->whereNull('returned_at')->exists()) {
            return response()->json(['error' => 'You already borrowed this book'], 400);
        }

        // Buat peminjaman
        Loans::create([
            'user_id' => $user->id,
            'book_id' => $request->book_id,
            'borrowed_at' => now(),
        ]);

        return response()->json(['message' => 'Book borrowed successfully']);
    }

    // Metode untuk mengembalikan buku
    public function returnBook(Request $request)
    {
        $user = Auth::user();

        // Validasi sederhana
        $request->validate(['book_id' => 'required|exists:books,id']);

        // Cari peminjaman yang belum dikembalikan
        $loan = Loans::where('user_id', $user->id)
                     ->where('book_id', $request->book_id)
                     ->whereNull('returned_at')
                     ->first();

        if (!$loan) {
            return response()->json(['error' => 'No active loan for this book'], 400);
        }

        // Update pengembalian
        $loan->update(['returned_at' => now()]);

        return response()->json(['message' => 'Book returned successfully']);
    }
}
