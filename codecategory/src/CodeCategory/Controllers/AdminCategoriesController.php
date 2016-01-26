<?php

namespace CodePress\CodeCategory\Controllers;

use CodePress\CodeCategory\Models\Category;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    private $category;

    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory, Category $category)
    {
        $this->category = $category;
        $this->responseFactory = $responseFactory;
    }

    public function index()
    {
        $categories = $this->category->all();

        return $this->responseFactory->view('codecategory::index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->category->lists('name', 'id');
        $categories->prepend('- None -', '');

        return view('codecategory::form', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['active'] = isset($data['active']) && $data['active'] == 'on' ? true : false;
        $data['parent_id'] = !empty($data['parent_id']) ? $data['parent_id'] : null;

        $this->category->create($data);

        return redirect()->route('admin.categories.index');
    }

    public function edit($id)
    {
        $categories = $this->category->lists('name', 'id');
        $categories->prepend('- None -', '');

        $category = $this->category->find($id);

        return view('codecategory::form', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['active'] = isset($data['active']) && $data['active'] == 'on' ? true : false;
        $data['parent_id'] = !empty($data['parent_id']) ? $data['parent_id'] : null;

        $this->category->find($id)->update($data);

        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $this->category->find($id)->delete();

        return redirect()->route('admin.categories.index');
    }
}