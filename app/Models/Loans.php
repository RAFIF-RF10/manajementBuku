<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    /** @use HasFactory<\Database\Factories\LoansFactory> */
    use HasFactory;
    protected $table = 'loans';
    protected $guarded = ['id'];
    protected $with = ['book','user'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
