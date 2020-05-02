<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillabel = ['id', 'author', 'body', 'parent_id'];
    protected $guarded = [];
}
