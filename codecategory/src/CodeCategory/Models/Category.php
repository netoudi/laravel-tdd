<?php

namespace CodePress\CodeCategory\Models;


use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements SluggableInterface
{

    use SluggableTrait;

    protected $table = "codepress_categories";

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
        'unique' => true
    ];

    protected $fillable = [
        'name',
        'active',
        'parent_id'
    ];

    public function categorizable()
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

}