<?php

namespace App\Actions\SendGrid;

use Illuminate\Support\Facades\Http;


class Spam_Reporte
{
    private $apiKey;
    private $baseURL;

    public function __construct()
    {
        $this->apiKey = config('services.sendgrid.apiKey');
        $this->baseURL = 'https://api.sendgrid.com';
    }

    public function updateSpamList()
    {
        $url = $this->baseURL . '/v3/suppression/spam_reports';
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get($url);

        dd($response->body());

//        UnsubscribeGroup::create([
//            'sendgrid_id' => $response['id'],
//            'name' => $response['name'],
//            'description' => $response['description'],
//            'is_default' => $response['is_default'],
//        ]);
    }

    public function deleteSpam($email)
    {
        $url = $this->baseURL.'/v3/suppression/spam_reports/'.$email;
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);

//        dd($response->successful());
        return $response->successful();
    }
}
