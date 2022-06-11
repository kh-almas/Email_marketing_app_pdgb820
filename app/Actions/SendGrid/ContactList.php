<?php

namespace App\Actions\SendGrid;

use App\Models\Clist;
use App\Models\Email;
use Illuminate\Support\Facades\Http;

class ContactList
{
    private $apiKey;
    private $baseURL;

    public function __construct()
    {
        $this->apiKey = config('services.sendgrid.apiKey');
        $this->baseURL = 'https://api.sendgrid.com';
    }

    public function addContactList($list)
    {
        $url = $this->baseURL.'/v3/marketing/lists';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post($url,[
            'name' => $list,
        ]);

        $success = $response->successful();

        if($success == 1)
        {
            Clist::create([
                'name' => $response['name'],
                'sendgrid_id' => $response['id'],
                'sendgrid_contact_count' =>$response['contact_count'],
            ]);
        }

        return $success;
    }

    public function updateContactList($list, $email_list)
    {
        $url = $this->baseURL.'/v3/marketing/lists/'.$email_list->sendgrid_id;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->patch($url, [
            'name' => $list,
        ]);

        $success = $response->successful();

        if($success == 1)
        {
            $email_list->update([
                'name' => $response['name'],
            ]);
        }

        return $success;
    }

    public function deleteContactList($email_list)
    {
        $url = $this->baseURL.'/v3/marketing/lists/'.$email_list->sendgrid_id;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url . '?delete_contacts=' . 1);

        $success = $response->successful();

        return $success;
    }

    public function updateContactCount($email_list)
    {
        $url = $this->baseURL.'/v3/marketing/lists/'.$email_list->sendgrid_id.'/contacts/count';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get($url);

        $success = $response->successful();

        if ($success == 1)
        {
            $email_list->update([
                'sendgrid_contact_count' => $response['contact_count'],
            ]);
        }

    }

    public function addContactToList($email_id, $list_id)
    {
        $sendgrid_list = [];
        $email = Email::where('id', $email_id)->first();
        $list = Clist::where('id', $list_id)->first();

        foreach ($email->lists as $lists){
            $sendgrid_list[] = $lists->sendgrid_id;
        }
        $sendgrid_list[] = $list->sendgrid_id;

        $url = $this->baseURL.'/v3/marketing/contacts';

        $data = [
            'list_ids' => $sendgrid_list,
            'contacts' => [
                [
                    'email' => $email->email,
                ]
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->put($url, $data);

        $success = $response->successful();
        if($success == 1)
        {
            $list->email()->syncWithoutDetaching($email_id);
        }
        return $success;
    }

    public function removeContactFromList($list_sendgrid_id, $email)
    {


        $url = $this->baseURL.'/v3/marketing/lists/'.$list_sendgrid_id.'/contacts';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url . '?contact_ids=' . $email->sendgrid_id);

//        $email->detach();

        return $response;

    }

    public function deleteContactFromList($list_id, $email_id)
    {
        $url = $this->baseURL.'/v3/contactdb/lists/'.$list_id.'/recipients/'.$email_id;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url . '?list_id=' . $list_id . '?recipient_id=' . $email_id);

        return $response;
    }

    public function importContactStatus()//$job_id
    {
        $url = $this->baseURL.'/v3/marketing/contacts/imports/ac9ffc24-ce0b-4b9f-86e9-e63116c1446e';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get($url);

        return $response;
    }
}
