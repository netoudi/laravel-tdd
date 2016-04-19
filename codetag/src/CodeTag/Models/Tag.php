<?php

namespace CodePress\CodeTag\Models;


use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Validator;

class Tag extends Model
{
    use SoftDeletes;

    protected $table = "codepress_tags";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
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
        $validator->setRules(['name' => 'required|max:255']);
        $validator->setData($this->attributes);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    public function posts()
    {
        return $this->morphedByMany('\CodePress\CodePost\Models\Post', 'taggable', 'codepress_taggables');
    }

}