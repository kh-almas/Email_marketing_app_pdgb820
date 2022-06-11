<?php

namespace App\Actions\SendGrid;

use App\Models\Spam;
use App\Models\UnsubscribeGroup;
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
        return $response;

//        $success = $response->successful();
//        if ($success == 1)
//        {
//            $forStore[] = [
//                'created'  => $response['id'],
//                'email' => $data['blocks'],
//                'ip' => $data['bounce_drops'],
//            ];
//
//            Spam::upsert($forStore, ['email'], ['created', 'email', 'ip', ]);
//        }
//        return $success;
    }

    public function deleteSpam($email)
    {
        $url = $this->baseURL.'/v3/suppression/spam_reports/'.$email;
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);

        return $response->successful();
    }
}
