<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryTagService;

class CategoryTagController extends Controller
{
    protected $categoryTagService;

    public function __construct(CategoryTagService $categoryTagService)
    {
        $this->categoryTagService = $categoryTagService;
    }

    public function index(Request $request)
    {
        $name = $request->input('name');
        $status = $request->input('status');
        $sort = $request->input('sort');

        $categoryTags = $this->categoryTagService->searchCategoryTag($name, $status, $sort);

        $categoryTags = $categoryTags->withQueryString();

        return view('category-tag', compact('categoryTags'));
    }

    public function create(Request $request)
    {
        $categoryTags = null;

        return view('category-tag-edit', compact('categoryTags'));
    }

    public function edit(Request $request, $id)
    {
        $token = $request->bearerToken();

        $categoryTags = $this->categoryTagService->findBy("id", "=", $id)->first();

        $categoryTags = json_encode($categoryTags);

        return view('category-tag-edit', compact('categoryTags'));
    }

    public function save(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $status = $request->input('status');

        $categoryTags = $this->categoryTagService->categoryTagEdit($id, $name, $status);

        $categoryTags = json_encode($categoryTags);

        return redirect()->to('/category-tag');
    }

    public function delete(Request $request, $id)
    {
        $categoryTag = $this->categoryTagService->findBy("id", "=", $id)->first();

        $categoryTag->delete();

        return redirect()->to('/category-tag');
    }
}
