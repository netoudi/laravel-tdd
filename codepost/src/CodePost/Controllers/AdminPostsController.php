<?php

namespace CodePress\CodePost\Controllers;

use CodePress\CodePost\Repository\PostRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;
    /**
     * @var PostRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(ResponseFactory $responseFactory, PostRepositoryInterface $categoryRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();

        return $this->responseFactory->view('codecategory::index', compact('categories'));
    }

    public function create()
    {
        return view('codepost::form', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->postRepository->create($request->all());

        return redirect()->route('admin.posts.index');
    }

    public function edit($id)
    {
        $post = $this->postRepository->find($id);

        return view('codepost::form', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $this->postRepository->update($request->all(), $id);

        return redirect()->route('admin.posts.index');
    }

    public function destroy($id)
    {
        $this->postRepository->delete($id);

        return redirect()->route('admin.posts.index');
    }
}