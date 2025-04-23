<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\GooglePlacesApiService;

class GooglePlaceApiController extends Controller
{
    protected $googlePlacesApiService;

    public function __construct(GooglePlacesApiService $googlePlacesApiService)
    {
        $this->googlePlacesApiService = $googlePlacesApiService;
    }

    public function mealInfo(Request $request)
    {
        $allMealInfoData = $this->googlePlacesApiService->responseMealInfo();

        return response()->json([
            "result" => true,
            "status" => 200,
            "message" => "食事処の情報を取得しました。",
            "data" => $allMealInfoData,
        ]);
    }

    public function shoppingInfo(Request $request)
    {
        $allShoppingInfoData = $this->googlePlacesApiService->responseShoppingInfo();

        return response()->json([
            "result" => true,
            "status" => 200,
            "message" => "ショッピングの情報を取得しました。",
            "data" => $allShoppingInfoData,
        ]);
    }

    
}
