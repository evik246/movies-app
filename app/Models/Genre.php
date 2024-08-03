<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    
    protected $touches = ['movies'];

    protected $hidden = ['pivot'];

    public function movies() 
    {
        return $this->belongsToMany(Movie::class)->withTimestamps();
    }
}
