<?php

namespace App\Actions\SendGrid;

use Illuminate\Support\Facades\Http;
use App\Models\SuppressionGroup as SuppressionGroupmodel;


class SuppressionGroup
{
    private $apiKey;
    private $baseURL;

    public function __construct()
    {
        $this->apiKey = config('services.sendgrid.apiKey');
        $this->baseURL = 'https://api.sendgrid.com';
    }

    public function createSuppressionGroup($info)
    {
        $url = $this->baseURL.'/v3/asm/groups';
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post($url, [
            'name' => $info->name,
            'description' => $info->description,
        ]);

        SuppressionGroupmodel::create([
            'sendgrid_id' => $response['id'],
            'name' => $response['name'],
            'description' => $response['description'],
            'is_default' => $response['is_default'],
        ]);
    }

    public function deleteSuppressionGroup($group_id)
    {
        $url = $this->baseURL.'/v3/asm/groups/'.$group_id;
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);
    }
}
