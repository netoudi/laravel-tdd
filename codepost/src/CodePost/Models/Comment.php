<?php

namespace CodePress\CodePost\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

class Comment extends Model
{
    protected $table = "codepress_comments";

    protected $fillable = [
        'content'
    ];

    private $validator;

    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function isValid()
    {
        $validator = $this->validator;
        $validator->setRules([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);
        $validator->setData($this->attributes);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}