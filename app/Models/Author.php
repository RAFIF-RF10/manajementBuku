<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory;
    //protected berfungsi hanya untuk  class ini//
   protected $table = 'authors';
   protected $guarded = ['id'];



}
