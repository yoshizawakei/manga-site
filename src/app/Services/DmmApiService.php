<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class DmmApiService
{
    // protected string $apiId;
    // protected string $affiliateId;
    // protected string $baseUrl = 'https://api.dmm.com/affiliate/v3/ItemList';

    // public function __construct()
    // {
    //     $this->apiId = config('dmm.api_id');
    //     $this->affiliateId = config('dmm.affiliate_id');
    // }

    // public function searchManga(string $keyword, int $hits = 20): array
    // {
    //     if (empty($keyword)) {
    //         return [];
    //     }

    //     try {
    //         $response = Http::get($this->baseUrl, [
    //             'api_id' => $this->apiId,
    //             'affiliate_id' => $this->affiliateId,
    //             'site' => 'DMM.com',
    //             'service' => 'comic',
    //             'floor' => 'book',
    //             'keyword' => $keyword,
    //             'hits' => $hits,
    //             'sort' => 'rank',
    //             'output' => 'json'
    //         ]);

    //         if ($response->successful()) {
    //             $data = $response->json();
    //             if (isset($data['result']['items'])) {
    //                 return $data['result']['items'];
    //             }
    //         }

    //         Log::error('DMM API request failed.', [
    //             'status' => $response->status(),
    //             'body' => $response->body()
    //         ]);

    //     } catch (\Exception $e) {
    //         Log::error('DMM API request failed due to an exception.', [
    //             'exception' => $e->getMessage()
    //         ]);
    //     }

    //     return [];
    // }
}
