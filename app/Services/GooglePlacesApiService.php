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

    public function responseMealInfo()
    {
        return $this->googlePlacesApiRepository->responseMealInfo();
    }
}