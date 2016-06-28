<?php

namespace CodePress\CodeUser\Controllers\Admin;

use CodePress\CodeUser\Controllers\Controller;
use CodePress\CodeUser\Repository\RoleRepositoryInterface;
use CodePress\CodeUser\Repository\UserRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;

    public function __construct(
        ResponseFactory $responseFactory,
        UserRepositoryInterface $userRepository,
        RoleRepositoryInterface $roleRepository
    ) {
        $this->responseFactory = $responseFactory;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();

        return $this->responseFactory->view('codeuser::admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roleRepository->lists('name', 'id');

        return view('codeuser::admin.user.form', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = $this->userRepository->create($request->all());
        $this->userRepository->addRoles($user->id, $request->get('roles'));

        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $roles = $this->roleRepository->lists('name', 'id');

        return view('codeuser::admin.user.form', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepository->update($request->all(), $id);
        $this->userRepository->addRoles($user->id, $request->get('roles'));

        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);

        return redirect()->route('admin.users.index');
    }
}