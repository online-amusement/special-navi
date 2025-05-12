<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SubCategoryTagService;
use App\Services\CategoryTagService;
use Psy\Readline\Hoa\Console;

class SubCategoryTagController extends Controller
{
    protected $subCategoryTagService;
    protected $categoryTagService;

    public function __construct(SubCategoryTagService $subCategoryTagService, CategoryTagService $categoryTagService)
    {
        $this->subCategoryTagService = $subCategoryTagService;
        $this->categoryTagService = $categoryTagService;
    }

    public function index(Request $request)
    {
        $categoryTagId = $request->input('searchCategoryTagId');
        $name = $request->input('searchName');
        $status = $request->input('searchStatus');
        $sort = $request->input('searchSort');

        $subCategoryTag = $this->subCategoryTagService->searchSubCategoryTag($categoryTagId, $name, $status, $sort);

        $subCategoryTag = json_encode($subCategoryTag);

        return view('sub-category-tag', compact('subCategoryTag'));
    }

    public function create(Request $request)
    {
        $subCayegoryTags = null;

        $categoryTag = $this->categoryTagService->getAll();

        $categoryTag = json_encode($categoryTag);

        return view('sub-category-tag-edit', compact('subCayegoryTags', 'categoryTag'));
    }

    public function edit(Request $request, $id)
    {
        $token = $request->bearerToken();

        $subCayegoryTags = $this->subCategoryTagService->relationWithFindBy("id", "=", $id)->first();

        $subCayegoryTags = json_encode($subCayegoryTags);

        $categoryTag = $this->categoryTagService->getAll();

        $categoryTag = json_encode($categoryTag);

        return view('sub-category-tag-edit', compact('subCayegoryTags', 'categoryTag'));
    }

    public function save(Request $request)
    {
        $id = $request->input('id');
        $categoryTagId = $request->input('categoryTagId');
        $name = $request->input('name');
        $status = $request->input('status');

        $subCategoryTag = $this->subCategoryTagService->subCategoryTagEdit($id, $categoryTagId, $name, $status);

        return redirect()->to("/sub-category-tag");
        
    }

    public function delete(Request $request, $id)
    {
        $subCategoryTag = $this->subCategoryTagService->findBy("id", "=", $id)->first();

        $subCategoryTag->delete();

        return redirect()->to("/sub-category-tag");
    }
}
