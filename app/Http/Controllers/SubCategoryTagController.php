<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SubCategoryTagRepositoryService;
use App\Services\CategoryTagService;
use Psy\Readline\Hoa\Console;

class SubCategoryTagController extends Controller
{
    protected $subCategoryTagRepositoryService;
    protected $categoryTagService;

    public function __construct(SubCategoryTagRepositoryService $subCategoryTagRepositoryService, CategoryTagService $categoryTagService)
    {
        $this->subCategoryTagRepositoryService = $subCategoryTagRepositoryService;
        $this->categoryTagService = $categoryTagService;
    }

    public function index(Request $request)
    {
        $categoryTagId = $request->input('categoryTagId');
        $name = $request->input('name');
        $status = $request->input('status');
        $sort = $request->input('sort');

        $subCayegoryTag = $this->subCategoryTagRepositoryService->searchSubCategoryTag($categoryTagId, $name, $status, $sort);

        $subCayegoryTag = $subCayegoryTag->withQueryString();

        return view('sub-category-tag', compact('subCayegoryTag'));
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

        $subCayegoryTags = $this->subCategoryTagRepositoryService->relationWithFindBy("id", "=", $id)->first();

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

        $subCategoryTag = $this->subCategoryTagRepositoryService->subCategoryTagEdit($id, $categoryTagId, $name, $status);

        return redirect()->to("/sub-category-tag");
        
    }

    public function delete(Request $request, $id)
    {
        $subCategoryTag = $this->subCategoryTagRepositoryService->findBy("id", "=", $id)->first();

        $subCategoryTag->delete();

        return redirect()->to("/sub-category-tag");
    }
}
