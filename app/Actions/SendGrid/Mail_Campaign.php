<?php

namespace App\Actions\SendGrid;

use App\Models\Campaign;
use Illuminate\Support\Facades\Http;

class Mail_Campaign
{
    private $apiKey;
    private $baseURL;

    public function __construct()
    {
        $this->apiKey = config('services.sendgrid.apiKey');
        $this->baseURL = 'https://api.sendgrid.com';
    }

    public function addCampaign()
    {
        $url = $this->baseURL.'/v3/contactdb/recipients';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post($url,[
            'email' => 'example@example.com',
            'first_name' => 'example',
            'last_name' => 'User',
            'age' => 25,
        ]);
        dd($response->body());

//        $success = $response->successful();
//
//        if($success == 1)
//        {
//            Campaign::create([
//                'name' => $response['name'],
//                'sendgrid_id' => $response['id'],
//                'sendgrid_contact_count' =>$response['contact_count'],
//            ]);
//        }


//        "email": "example@example.com",
//    "first_name": "",
//    "last_name": "User",
//    "age": 25
//
//        return $success;
    }
}
