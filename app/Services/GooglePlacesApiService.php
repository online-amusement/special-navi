<?php

namespace App\Services;

use App\Repositories\GooglePlacesApiRepository;

class GooglePlacesApiService
{
    protected $googlePlacesApiRepository;

    public function __construct(GooglePlacesApiRepository $googlePlacesApiRepository)
    {
        $this->googlePlacesApiRepository = $googlePlacesApiRepository;
    }

    public function NearbyMeal()
    {
        return $this->googlePlacesApiRepository->NearbyMeal();
    }
    //食事処情報
    public function responseMealInfo()
    {
        return $this->googlePlacesApiRepository->responseMealInfo();
    }
    public function NearbyShopping()
    {
        return $this->googlePlacesApiRepository->NearbyShopping();
    }
    //ショッピング情報
    public function responseShoppingInfo()
    {
        return $this->googlePlacesApiRepository->responseShoppingInfo();
    }
}