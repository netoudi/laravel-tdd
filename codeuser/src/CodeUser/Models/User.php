<?php

namespace CodePress\CodeUser\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\Validator;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = "codepress_users";

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required'
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
        return $this->belongsToMany(Role::class, 'codepress_users_roles', 'user_id', 'role_id');
    }

    public function hasRole($role)
    {
        return is_string($role) ? $this->roles->contains('name', $role) : $this->intersect($this->roles)->count();
    }

    public function isAdmin()
    {
        return $this->hasRole(Role::ROLE_ADMIN);
    }
}
