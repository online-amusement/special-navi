<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use App\Models\GooglePlaceApi;
use Illuminate\Support\Facades\DB;


class GooglePlacesApiRepository
{
    protected $googlePlaceApi;

    public function __construct(GooglePlaceApi $googlePlaceApi)
    {
        $this->googlePlaceApi = $googlePlaceApi;
    }

    public function NearbyMeal()
    {
        //経度、緯度の指定
        $location = '34.7024, 135.4959';
        //経度、緯度からの半径
        $radius = 50000;
        //食事処
        $type = 'restaurant';
        //apiキー
        $key = env('GOOGLE_PLACES_API_KEY');
        //Googleのurl
        $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';

        $params = [
            'location' => $location,
            'radius' => $radius,
            'type' => $type,
            'language' => 'ja', // 日本語での結果を指定
            'key' => $key,
        ];
        
        $response = Http::get($url,$params);
        $nextPage = $response["next_page_token"] ?? null;

        $allResults = [];
        $data = $response->json();
        $allResults = array_merge($allResults, $data["results"]);
        
        while($nextPage && count($allResults) < 60) {
            sleep(2);

            $params = [
                'pagetoken' =>$nextPage,
                'key'       => $key,
                'language' => 'ja', // 日本語での結果を指定
            ];
            $response = Http::get($url, $params);

            if(!$response) {
                break;
            }

            $data = $response->json();
            $allResults = array_merge($allResults, $data["results"]);
            $nextPage = $data["next_page_token"] ?? null;
            
        }
        $results = array_slice($allResults, 0, 60);
        
        $this->googlePlaceApi->newQuery()->delete();
        DB::statement("ALTER TABLE google_place_apis AUTO_INCREMENT = 1");
        
        foreach($results as $result) {
            //施設名
            $name = $result["name"] ?? null;
            //経度
            $lat = $result["geometry"]["location"]["lat"] ?? null;
            //緯度
            $lng = $result["geometry"]["location"]["lng"] ?? null;
            //店のアイコン
            $icon = $result["icon"];
            //施設が営業してるか
            $openNow = $result["opening_hours"]["open_now"] ?? null;
            //お店の写真
            $photo =  $result["photos"]["html_attributions"][0] ?? null;
            //各施設に固有の識別子
            $placeId = $result["place_id"] ?? null;
            //住所情報が不十分な場所を示す補助コード compound_code global_code
            $plusCode = $result["plus_code"]["compound_code"] ?? null;
            //価格帯を示す数値
            $priceLevel = $result["price_level"] ?? null;
            //施設に対するユーザーの平均評価
            $rating = $result["rating"] ?? null;
            //その施設に対する総レビュー数
            $userRatingsTotal = $result["user_ratings_total"] ?? null;
            //施設の位置情報の簡易な住所表記
            $vicinity = $result["vicinity"] ?? null;
            //restaurant、cafe、bar、storeなどのカテゴリー
            $types = $result["types"][0] ?? null;
            
            $this->googlePlaceApi
                ->newQuery()
                ->create(
                    [
                        "lat" => $lat,
                        "lng" => $lng,
                        "icon" => $icon,
                        "name" => $name,
                        "open_now" => $openNow,
                        "photos" => $photo,
                        "place_id" => $placeId,
                        "plus_code" => $plusCode,
                        "price_level" => $priceLevel,
                        "rating" => $rating,
                        "user_ratings_total" => $userRatingsTotal,
                        "vicinity" => $vicinity,
                        "types" => $types
                    ]
                );
        }  
    }

    public function responseMealInfo()
    {
        return $this->googlePlaceApi
            ->newQuery()
            ->get();
    }
}