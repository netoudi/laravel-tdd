<?php

namespace CodePress\CodePost\Controllers;

use CodePress\CodePost\Models\Post;
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
    private $postRepository;

    public function __construct(ResponseFactory $responseFactory, PostRepositoryInterface $postRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->all();

        return $this->responseFactory->view('codepost::index', compact('posts'));
    }

    public function create()
    {
        return view('codepost::form');
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

    public function deleted()
    {
        $posts = Post::onlyTrashed()->get();

        return view('codepost::deleted', compact('posts'));
    }
}