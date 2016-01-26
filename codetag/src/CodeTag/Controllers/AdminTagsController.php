<?php

namespace CodePress\CodeTag\Controllers;

use CodePress\CodeTag\Models\Tag;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminTagsController extends Controller
{
    private $tag;

    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory, Tag $tag)
    {
        $this->tag = $tag;
        $this->responseFactory = $responseFactory;
    }

    public function index()
    {
        $tags = $this->tag->all();

        return $this->responseFactory->view('codetag::index', compact('tags'));
    }

    public function create()
    {
        return view('codetag::form');
    }

    public function store(Request $request)
    {
        $this->tag->create($request->all());

        return redirect()->route('admin.tags.index');
    }

    public function edit($id)
    {
        $tag = $this->tag->find($id);

        return view('codetag::form', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $this->tag->find($id)->update($request->all());

        return redirect()->route('admin.tags.index');
    }

    public function destroy($id)
    {
        $this->tag->find($id)->delete();

        return redirect()->route('admin.tags.index');
    }
}