<?php

namespace App\Actions\SendGrid;

use App\Models\Email;
use Illuminate\Support\Facades\Http;

class Bounces
{
    private $apiKey;
    private $baseURL;

    public function __construct()
    {
        $this->apiKey = config('services.sendgrid.apiKey');
        $this->baseURL = 'https://api.sendgrid.com';
    }

    public function updateList()
    {
        $url = $this->baseURL.'/v3/suppression/bounces';
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Accept' => "application/json",
        ])->get($url);



        foreach ($response as $respo)
        {
            return $respo['created'];
        }
        //return $response['0']['created'];
        //dd($response->body());
    }
}
