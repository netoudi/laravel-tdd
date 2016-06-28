<?php

namespace CodePress\CodeUser\Controllers\Admin;

use CodePress\CodeUser\Controllers\Controller;
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

    public function __construct(ResponseFactory $responseFactory, RoleRepositoryInterface $roleRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->all();

        return $this->responseFactory->view('codeuser::admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('codeuser::admin.role.form');
    }

    public function store(Request $request)
    {
        $this->roleRepository->create($request->all());

        return redirect()->route('admin.roles.index');
    }

    public function edit($id)
    {
        $role = $this->roleRepository->find($id);

        return view('codeuser::admin.role.form', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $this->roleRepository->update($request->all(), $id);

        return redirect()->route('admin.roles.index');
    }

    public function destroy($id)
    {
        $this->roleRepository->delete($id);

        return redirect()->route('admin.roles.index');
    }
}
