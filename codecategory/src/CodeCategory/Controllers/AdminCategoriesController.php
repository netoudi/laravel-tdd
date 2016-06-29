<?php

namespace CodePress\CodeCategory\Controllers;

use CodePress\CodeCategory\Repository\CategoryRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(ResponseFactory $responseFactory, CategoryRepositoryInterface $categoryRepository)
    {
        $this->authorize('access_categories');
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
        $categories = $this->categoryRepository->lists('name', 'id');
        $categories->prepend('- None -', '');

        return view('codecategory::form', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['active'] = isset($data['active']) && $data['active'] == 'on' ? true : false;
        $data['parent_id'] = !empty($data['parent_id']) ? $data['parent_id'] : null;

        $this->categoryRepository->create($data);

        return redirect()->route('admin.categories.index');
    }

    public function edit($id)
    {
        $categories = $this->categoryRepository->lists('name', 'id');
        $categories->prepend('- None -', '');

        $category = $this->categoryRepository->find($id);

        return view('codecategory::form', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['active'] = isset($data['active']) && $data['active'] == 'on' ? true : false;
        $data['parent_id'] = !empty($data['parent_id']) ? $data['parent_id'] : null;

        $this->categoryRepository->update($data, $id);

        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);

        return redirect()->route('admin.categories.index');
    }
}