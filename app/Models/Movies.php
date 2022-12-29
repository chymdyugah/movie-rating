<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'slug'];

    public function acts()
    {
        return $this->belongsToMany(Act::class, 'act_movie', 'movie_id', 'act_id');
    }

    public function votes(){
        return $this->belongsToMany(User::class, 'votes', 'movie_id', 'user_id');
    }
}
