<?php

namespace App\Actions\SendGrid;

use App\Models\Clist;
use App\Models\SingleSend;
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

        return $response->successful();
    }

    public function addSingleSend($info)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post($url, [
            'name' => $info->name,
            'send_to' => [
                'list_ids' => $info->lists,
            ],
            'email_config' => [
                'subject' => $info->subject,
                'generate_plain_content' => true,
                'suppression_group_id' => (int)$info->suppression_group_id,
                'sender_id' => (int)$info->sender_id,
                'html_content' => $info->email_template,
            ]
        ]);

        $success = $response->successful();

        if ($success == 1)
        {
            $Id = [];
            $contactLists = Clist::whereIn('sendgrid_id',$response['send_to']['list_ids'])->get();
            foreach($contactLists as $contactList)
            {
                $Id[] = $contactList->id;
            }

            $forList =  SingleSend::create([
                'sendgrid_id' => $response['id'],
                'name' => $response['name'],
                'status' => $response['status'],
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
            $forList->lists()->syncWithoutDetaching($Id);
        }

        return $success;
    }


    public function scheduleSingleSends($singleSendID)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends/'.$singleSendID.'/schedule';

        $dateTime = now()->addSeconds('30');

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->put($url, [
            'send_at' => $dateTime,
        ]);

        $success = $response->successful();

        if ($success == 1)
        {
            $forUpdate = SingleSend::where('sendgrid_id', $singleSendID)->firstOrFail();

            $forUpdate->update([
                'is_send' => 1,
                'send_at' => $dateTime->toDateTimeString(),
            ]);
        }
        return $success;
    }


    public function unscheduledSingleSends($singleSendID)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends/'.$singleSendID.'/schedule';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);

        $success = $response->successful();

        if ($success == 1)
        {
            $dateTime = now()->addSeconds('300');

            $forUpdate = SingleSend::where('sendgrid_id', $singleSendID)->firstOrFail();

            if($forUpdate->send_at < $dateTime)
            {
                $forUpdate->update([
                    'is_send' => 0,
                ]);
            }
        }
        return $success;
    }

    public function duplicateSingleSend($singleSendID)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends/'.$singleSendID;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post($url, [
            'name' => '',
        ]);

        $success = $response->successful();

        if ($success == 1)
        {
            $Id = [];
            $contactLists = Clist::whereIn('sendgrid_id',$response['send_to']['list_ids'])->get();
            foreach($contactLists as $contactList)
            {
                $Id[] = $contactList->id;
            }

            $forList =  SingleSend::create([
                'sendgrid_id' => $response['id'],
                'name' => $response['name'],
                'status' => $response['status'],
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

            $forList->lists()->sync($Id);
        }

        //need save duplicateSingleSend in database
    }

    public function updateSingleSend($info, $singleSend)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends/'.$singleSend->sendgrid_id;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->patch($url, [
            'name' => $info->name,
            'send_to' => [
                'list_ids' => $info->lists,
            ],
            'email_config' => [
                'subject' => $info->subject,
                'generate_plain_content' => true,
                'suppression_group_id' => (int)$info->suppression_group_id,
                'sender_id' => (int)$info->sender_id,
                'html_content' => $info->email_template,
            ]
        ]);

        $success = $response->successful();

        if ($success == 1)
        {
            $Id = [];
            $contactLists = Clist::whereIn('sendgrid_id',$response['send_to']['list_ids'])->get();
            foreach($contactLists as $contactList)
            {
                $Id[] = $contactList->id;
            }
            $singleSend->update([
                'sendgrid_id' => $response['id'],
                'name' => $response['name'],
                'status' => $response['status'],
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

            $singleSend->lists()->sync($Id);
        }

        return $success;
    }

    public function deleteSingleSend($singleSendID)
    {
        $url = $this->baseURL.'/v3/marketing/singlesends/'.$singleSendID;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);

        return $response->successful();
    }
}
