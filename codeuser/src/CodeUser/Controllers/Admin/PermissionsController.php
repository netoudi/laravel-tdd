<?php

namespace CodePress\CodeUser\Controllers\Admin;

use CodePress\CodeUser\Controllers\Controller;
use CodePress\CodeUser\Repository\PermissionRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var PermissionRepositoryInterface
     */
    private $permissionRepository;

    public function __construct(ResponseFactory $responseFactory, PermissionRepositoryInterface $permissionRepository)
    {
        // $this->authorize('access_permissions');
        $this->responseFactory = $responseFactory;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $permissions = $this->permissionRepository->all();

        return $this->responseFactory->view('codeuser::admin.permission.index', compact('permissions'));
    }

    public function view($id)
    {
        $permission = $this->permissionRepository->find($id);

        return $this->responseFactory->view('codeuser::admin.permission.view', compact('permission'));
    }
}
