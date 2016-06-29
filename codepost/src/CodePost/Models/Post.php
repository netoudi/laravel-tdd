<?php

namespace CodePress\CodePost\Models;


use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Validator;

class Post extends Model implements SluggableInterface
{
    use SluggableTrait, SoftDeletes;

    const STATE_PUBLISHED = 1;

    const STATE_DRAFT = 2;

    protected $table = "codepress_posts";

    protected $dates = ['deleted_at'];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
        'unique' => true
    ];

    protected $fillable = [
        'title',
        'slug',
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

    public function categories()
    {
        return $this->morphToMany('\CodePress\CodeCategory\Models\Category', 'categorizable', 'codepress_categorizables');
    }

    public function tags()
    {
        return $this->morphToMany('\CodePress\CodeTag\Models\Tag', 'taggable', 'codepress_taggables');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}