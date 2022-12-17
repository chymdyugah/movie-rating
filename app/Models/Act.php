<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'dob', 'country'];

    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'act_movie', 'act_id', 'movie_id');
    }
}
