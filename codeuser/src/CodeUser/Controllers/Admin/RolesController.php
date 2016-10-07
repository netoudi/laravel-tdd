<?php

namespace CodePress\CodeUser\Controllers\Admin;

use CodePress\CodeUser\Controllers\Controller;
use CodePress\CodeUser\Repository\PermissionRepositoryInterface;
use CodePress\CodeUser\Repository\RoleRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;
    /**
     * @var PermissionRepositoryInterface
     */
    private $permissionRepository;

    public function __construct(
        ResponseFactory $responseFactory,
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository
    ) {
        // $this->authorize('access_roles');
        $this->responseFactory = $responseFactory;
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->all();

        return $this->responseFactory->view('codeuser::admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = $this->permissionRepository->lists('name', 'id');

        return view('codeuser::admin.role.form', compact('permissions'));
    }

    public function store(Request $request)
    {
        $role = $this->roleRepository->create($request->all());
        $this->roleRepository->addPermissions($role->id, $request->get('permissions'));

        return redirect()->route('admin.roles.index');
    }

    public function edit($id)
    {
        $role = $this->roleRepository->find($id);
        $permissions = $this->permissionRepository->lists('name', 'id');

        return view('codeuser::admin.role.form', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = $this->roleRepository->update($request->all(), $id);
        $this->roleRepository->addPermissions($role->id, $request->get('permissions'));

        return redirect()->route('admin.roles.index');
    }

    public function destroy($id)
    {
        $this->roleRepository->delete($id);

        return redirect()->route('admin.roles.index');
    }
}
