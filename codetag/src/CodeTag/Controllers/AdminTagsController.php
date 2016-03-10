<?php

namespace CodePress\CodeTag\Controllers;

use CodePress\CodeTag\Repository\TagRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminTagsController extends Controller
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;
    /**
     * @var TagRepositoryInterface
     */
    private $tagRepository;

    public function __construct(ResponseFactory $responseFactory, TagRepositoryInterface $tagRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->all();

        return $this->responseFactory->view('codetag::index', compact('tags'));
    }

    public function create()
    {
        return view('codetag::form');
    }

    public function store(Request $request)
    {
        $this->tagRepository->create($request->all());

        return redirect()->route('admin.tags.index');
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->find($id);

        return view('codetag::form', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $this->tagRepository->update($request->all(), $id);

        return redirect()->route('admin.tags.index');
    }

    public function destroy($id)
    {
        $this->tagRepository->delete($id);

        return redirect()->route('admin.tags.index');
    }
}