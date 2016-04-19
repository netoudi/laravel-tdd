<?php

namespace CodePress\CodeUser\Controllers\Admin;

use CodePress\CodeUser\Controllers\Controller;
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

    public function __construct(ResponseFactory $responseFactory, UserRepositoryInterface $userRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();

        return $this->responseFactory->view('codeuser::index', compact('users'));
    }

    public function create()
    {
        return view('codeuser::form');
    }

    public function store(Request $request)
    {
        $this->userRepository->create($request->all());

        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        return view('codeuser::form', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->userRepository->update($request->all(), $id);

        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);

        return redirect()->route('admin.users.index');
    }
}