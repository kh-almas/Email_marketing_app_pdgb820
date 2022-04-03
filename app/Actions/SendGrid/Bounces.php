<?php

namespace App\Actions\SendGrid;

use App\Models\Bounce;
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
        ])->get($url)->collect();

//        $success = $response->successful();
//
//        if ($success == 1)
//        {
            foreach ($response as $data)
            {
                Bounce::firstOrCreate([
                    'created' => $data['created'],
                    'email' => $data['email'],
                    'reason' => $data['reason'],
                    'status' => $data['status'],
                ]);
            }
//        }

//        return $success;
    }

    public function deletebounce($bounce)
    {
        $url = $this->baseURL.'/v3/suppression/bounces/'. $bounce->email;
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url. '?email_address='. $bounce->email);

        return $response->successful();
    }
}
