<?php

namespace CodePress\CodeUser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

class Role extends Model
{
    const ROLE_ADMIN = "Admin";
    const ROLE_EDITOR = "Editor";
    const ROLE_REDACTOR = "Redactor";

    protected $table = "codepress_roles";

    protected $fillable = [
        'name',
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
        ]);
        $validator->setData($this->attributes);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'codepress_users_roles', 'role_id', 'user_id');
    }

    public function premissions()
    {
        return $this->belongsToMany(Permission::class, 'codepress_permissions_roles', 'role_id', 'permission_id');
    }
}
