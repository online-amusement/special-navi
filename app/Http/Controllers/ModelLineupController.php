<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ModelLineupService;

class ModelLineupController extends Controller
{
    protected $modelLineupService;

    public function __construct(ModelLineupService $modelLineupService)
    {
        $this->modelLineupService = $modelLineupService;
    }

    public function index(Request $request)
    {
        $name = $request->input("name");
        $amount = $request->input("amount");
        $startedAt = $request->input("startedAt");
        $endedAt = $request->input("endedAt");
        $sort = $request->input("sort");

        $modelLineups = $this->modelLineupService->searchModelLineup($name, $amount, $startedAt, $endedAt, $sort);

        $modelLineups = $modelLineups->withQueryString();

        return view("model-lineup", compact("modelLineups"));
    }

    public function create(Request $request)
    {
        $modelLineup = null;

        return view("model-lineup-edit", compact("modelLineup"));
    }

    public function edit(Request $request, $id)
    {
        $token = $request->bearerToken();

        $modelLineup = $this->modelLineupService->findBy("id", "=", $id)->first();

        $modelLineup = json_encode($modelLineup);

        return view("model-lineup-edit", compact("modelLineup"));
    }

    public function save(Request $request)
    {
        $id = $request->input("id");
        $name = $request->input("name");
        $detail = $request->input("detail");
        $amount = $request->input("amount");
        $previewFile = $request->file("previewFile");
        $downloadFile = $request->file("downloadFile");

        $modelLineup = $this->modelLineupService->modelLineupCreateOrUpdate($id, $name, $detail, $amount, $previewFile, $downloadFile);

        return redirect()->to("model-lineup");
    }

    public function delete(Request $request, $id)
    {
        $modelLineup = $this->modelLineupService->findBy("id", "=", $id)->first();

        $modelLineup->delete();

        return redirect()->to("model-lineup");
    }
}
