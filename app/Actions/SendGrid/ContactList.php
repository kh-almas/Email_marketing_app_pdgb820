<?php

namespace App\Actions\SendGrid;

use App\Models\EmailList;
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

        //return $response;

        EmailList::create([
            'name' => $response['name'],
            'sendgrid_id' => $response['id'],
            'sendgrid_contact_count' =>$response['contact_count'],
        ]);
    }

    public function updateContactList($list, $email_list)
    {
        $url = $this->baseURL.'/v3/marketing/lists/'.$email_list->sendgrid_id;

        //return $url;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->patch($url, [
            'name' => $list,
        ]);

        $email_list->update([
            'name' => $response['name'],
        ]);
    }

    public function deleteContactList($email_list)
    {
        $url = $this->baseURL.'/v3/marketing/lists/'.$email_list->sendgrid_id;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url);

        $email_list->delete();
    }

    public function updateContactCount($email_list)
    {
        $url = $this->baseURL.'/v3/marketing/lists/'.$email_list->sendgrid_id.'/contacts/count';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get($url);

        $email_list->update([
            'sendgrid_contact_count' => $response['contact_count'],
        ]);
    }
}
