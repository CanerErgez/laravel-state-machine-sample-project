<?php

namespace App\Models;

use Caner\StateMachine\Traits\HasState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use HasState;

    protected $fillable = ['title', 'content', 'status'];
}
