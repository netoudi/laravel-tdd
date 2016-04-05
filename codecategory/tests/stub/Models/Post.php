<?php

namespace CodePress\CodeCategory\Models;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "codepress_posts";

    protected $fillable = [
        'title'
    ];

    public function categories()
    {
        return $this->morphToMany('\CodePress\CodeCategory\Models\Category', 'categorizable', 'codepress_categorizables');
    }

}