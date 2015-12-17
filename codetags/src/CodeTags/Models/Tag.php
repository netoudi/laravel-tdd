<?php

namespace CodePress\CodeTags\Models;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = "codepress_tags";

    protected $fillable = [
        'name'
    ];

    public function taggable()
    {
        return $this->morphTo();
    }

}