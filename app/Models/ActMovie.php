<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActMovie extends Model
{
    use HasFactory;
    protected $fillable = ['act_id', 'movie_id'];
    protected $table = 'act_movie';
}
