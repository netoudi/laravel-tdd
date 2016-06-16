<?php

namespace CodePress\CodeUser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

class Permission extends Model
{
    protected $table = "codepress_permissions";

    protected $fillable = [
        'name',
        'description',
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
            'name' => 'required',
            'description' => 'required',
        ]);
        $validator->setData($this->attributes);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'codepress_permissions_roles', 'permission_id', 'role_id');
    }
}
