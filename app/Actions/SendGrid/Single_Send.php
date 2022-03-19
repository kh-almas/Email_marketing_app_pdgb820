<?php

namespace App\Actions\SendGrid;

use App\Models\SingleSend;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Single_Send
{
    private $apiKey;
    private $baseURL;

    public function __construct()
    {
        $this->apiKey = config('services.sendgrid.apiKey');
        $this->baseURL = 'https://api.sendgrid.com';
    }

    public function getSender()
    {
        $url = $this->baseURL.'/v3/verified_senders';
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get($url);

        dd($response->body());
    }

    public function addSingleSend($info)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post($url, [
            'name' => $info->name,
            'send_to' => [
                'list_ids' => [
                    $info->list_ids,
                ],
            ],
            'email_config' => [
                'subject' => $info->subject,
                'generate_plain_content' => true,
                'suppression_group_id' => (int)$info->suppression_group_id,
                'sender_id' => (int)$info->sender_id,
                'html_content' => $info->email_template,
            ]
        ]);

        SingleSend::create([
            'sendgrid_id' => $response['id'],
            'name' => $response['name'],
            'status' => $response['status'],
            //'categories' => $response[''],
            'list_ids' => $response['send_to']['list_ids'][0],
            //'segment_ids' => $response[''],
            'send_all' => $response['send_to']['all'],
            'subject' => $response['email_config']['subject'],
            'suppression_group_id' => $response['email_config']['suppression_group_id'],
            'sender_id' => $response['email_config']['sender_id'],
            'html_content' => $response['email_config']['html_content'],
            'plain_content' => $response['email_config']['plain_content'],
            'generate_plain_content' => $response['email_config']['generate_plain_content'],
            'custom_unsubscribe_url' => $response['email_config']['custom_unsubscribe_url'],
            'ip_pool' => $response['email_config']['ip_pool'],
            'editor' => $response['email_config']['editor'],
        ]);
}


    public function scheduleSingleSends($singleSendID)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends/'.$singleSendID.'/schedule';

        $dateTime = now()->addSeconds('300');

        Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->put($url, [
            'send_at' => $dateTime,
        ]);

        $forUpdate = SingleSend::where('sendgrid_id', $singleSendID)->firstOrFail();

        $forUpdate->update([
            'is_send' => 1,
            'send_at' => $dateTime->toDateTimeString(),
        ]);
    }


    public function unscheduledSingleSends($singleSendID)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends/'.$singleSendID.'/schedule';

        Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);

        $dateTime = now()->addSeconds('300');

        $forUpdate = SingleSend::where('sendgrid_id', $singleSendID)->firstOrFail();

        if($forUpdate->send_at < $dateTime)
        {
            $forUpdate->update([
                'is_send' => 0,
            ]);
        }
    }

    public function duplicateSingleSend($singleSendID)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends/'.$singleSendID;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post($url, [
            'name' => '',
        ]);

        dd($response->body());
    }

    public function updateSingleSend($info, $singleSendID)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends/'.$singleSendID->sendgrid_id;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->patch($url, [
            'name' => $info->name,
            'send_to' => [
                'list_ids' => [
                    $info->list_ids,
                ],
            ],
            'email_config' => [
                'subject' => $info->subject,
                'generate_plain_content' => true,
                'suppression_group_id' => (int)$info->suppression_group_id,
                'sender_id' => (int)$info->sender_id,
                'html_content' => $info->email_template,
            ]
        ]);

        $singleSendID->update([
            'sendgrid_id' => $response['id'],
            'name' => $response['name'],
            'status' => $response['status'],
            //'categories' => $response[''],
            'list_ids' => $response['send_to']['list_ids'][0],
            //'segment_ids' => $response[''],
            'send_all' => $response['send_to']['all'],
            'subject' => $response['email_config']['subject'],
            'suppression_group_id' => $response['email_config']['suppression_group_id'],
            'sender_id' => $response['email_config']['sender_id'],
            'html_content' => $response['email_config']['html_content'],
            'plain_content' => $response['email_config']['plain_content'],
            'generate_plain_content' => $response['email_config']['generate_plain_content'],
            'custom_unsubscribe_url' => $response['email_config']['custom_unsubscribe_url'],
            'ip_pool' => $response['email_config']['ip_pool'],
            'editor' => $response['email_config']['editor'],
        ]);
    }

    public function deleteSingleSend($singleSendID)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends/'.$singleSendID;

        Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);
    }


}
