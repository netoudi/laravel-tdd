<?php

use CodePress\CodeUser\Models\Role;
use CodePress\CodeUser\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorizationTest extends \TestCase
{
    use DatabaseTransactions;

    protected function getUser()
    {
        return factory(User::class)->create();
    }

    public function test_can_access_routes()
    {
        $user = $this->getUser();
        $user->roles()->save(Role::find(1)); //ROLE_ADMIN

        $this->actingAs($user)
            ->get('/admin/categories')
            ->seeStatusCode(200);

        $this->actingAs($user)
            ->get('/admin/tags')
            ->seeStatusCode(200);

        $this->actingAs($user)
            ->get('/admin/posts')
            ->seeStatusCode(200);

        $this->actingAs($user)
            ->get('/admin/users')
            ->seeStatusCode(200);

        $this->actingAs($user)
            ->get('/admin/roles')
            ->seeStatusCode(200);

        $this->actingAs($user)
            ->get('/admin/permissions')
            ->seeStatusCode(200);
    }

    public function test_cannot_access_routes()
    {
        $user = $this->getUser();

        $this->actingAs($user)
            ->get('/admin/categories')
            ->seeStatusCode(403);

        $this->actingAs($user)
            ->get('/admin/tags')
            ->seeStatusCode(403);

        $this->actingAs($user)
            ->get('/admin/posts')
            ->seeStatusCode(403);

        $this->actingAs($user)
            ->get('/admin/users')
            ->seeStatusCode(403);

        $this->actingAs($user)
            ->get('/admin/roles')
            ->seeStatusCode(403);

        $this->actingAs($user)
            ->get('/admin/permissions')
            ->seeStatusCode(403);
    }
}
