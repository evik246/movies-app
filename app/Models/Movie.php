<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'is_published', 
        'poster'
    ];
    
    protected $touches = ['genres'];

    protected $hidden = ['pivot'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }
}
