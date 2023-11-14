<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\User;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'review','rating','user_id','book_id'
    ];

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
