<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GooglePlacesApiService;
use Illuminate\Support\Facades\Log;

class UpdateShoppingInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopping:update-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定期的にショピングの情報を更新するバッチ処理';

    protected $googlePlacesApiService;

    public function __construct(GooglePlacesApiService $googlePlacesApiService)
    {
        parent::__construct();
        $this->googlePlacesApiService = $googlePlacesApiService;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->googlePlacesApiService->NearbyShopping();
        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
}
