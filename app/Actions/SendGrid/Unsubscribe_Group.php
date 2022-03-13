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

        //dd($response->body());

        UnsubscribeGroup::create([
            'sendgrid_id' => $response['id'],
            'name' => $response['name'],
            'description' => $response['description'],
            'is_default' => $response['is_default'],
        ]);
    }

    public function deleteUnsubscribeGroup($group_id)
    {
        $url = $this->baseURL.'/v3/asm/groups/'.$group_id;
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);
    }

    public function retrieveAllSuppression($group_id)
    {
        $url = $this->baseURL.'/v3/asm/groups/'.$group_id.'/suppressions';
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get($url);

        dd($response->body());
    }
}
