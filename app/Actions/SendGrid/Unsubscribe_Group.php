<?php

namespace App\Actions\SendGrid;

use App\Models\UnsubscribeGroup;
use Illuminate\Support\Facades\Http;


class Unsubscribe_Group
{
    private $apiKey;
    private $baseURL;

    public function __construct()
    {
        $this->apiKey = config('services.sendgrid.apiKey');
        $this->baseURL = 'https://api.sendgrid.com';
    }

    public function createUnsubscribeGroup($info)
    {
        $url = $this->baseURL.'/v3/asm/groups';
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post($url, [
            'name' => $info->name,
            'description' => $info->description,
        ]);

        $success = $response->successful();

        if ($success == 1)
        {
            UnsubscribeGroup::create([
                'sendgrid_id' => $response['id'],
                'name' => $response['name'],
                'description' => $response['description'],
                'is_default' => $response['is_default'],
            ]);
        }
        return $success;
    }

    public function deleteUnsubscribeGroup($group_id)
    {
        $url = $this->baseURL.'/v3/asm/groups/'.$group_id;
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);

        return $response->successful();
    }

    public function retrieveAllSuppression($group_id)
    {
        $url = $this->baseURL.'/v3/asm/groups/'.$group_id->sendgrid_id.'/suppressions';
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get($url)->collect();

        $success = $response->successful();

        if ($success == 1)
        {
            foreach ($response as $data)
            {
                $group_id->email()->firstOrCreate([
                    'email' => $data,
                ]);
            }
        }

        return $success;
    }

    public function deleteEmailFromUnsubscribeGroup($emailInfo, $group_id)
    {
        $url = $this->baseURL.'/v3/asm/groups/'.$group_id.'/suppressions/'.$emailInfo->email;
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);

        return $response->successful();
    }

    public function addEmailToSuppression($group_id)
    {
//        $url = $this->baseURL.'/v3/asm/groups/17030/suppressions';
//        $response = Http::withHeaders([
//            'Authorization' => "Bearer {$this->apiKey}",
//        ])->post($url, [
//            'recipient_emails' => [
//                'almas@gmail.com',
//                'prtg@gmail.com',
//            ],
//        ]);
//
//        dd($response->body());
    }
}
