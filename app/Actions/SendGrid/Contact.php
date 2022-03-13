<?php

namespace App\Actions\SendGrid;

use App\Models\Email;
use Illuminate\Support\Facades\Http;

class Contact
{
    private $apiKey;
    private $baseURL;
    public function __construct()
    {
        $this->apiKey = config('services.sendgrid.apiKey');
        $this->baseURL = 'https://api.sendgrid.com';
    }
    public function deleteContact($email)
    {
        $url = $this->baseURL.'/v3/marketing/contacts';
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->delete($url . '?ids=' . $email);
//        dd($response->body());
    }






    public function addContact($info)
    {
        $url = $this->baseURL.'/v3/marketing/contacts';

        $data = [
            'list_ids' => [
                $info->list_ids,
            ],
            'contacts' => [
                [
                    'email' => $info->email,
                ]
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->put($url, $data);

        //dd($response->body());


        $email = Email::create([
            'first_name' => $info->first_name,
            'last_name' => $info->last_name,
            'email' => $info->email,
            'address_line_one' => $info->address_line_one,
            'address_line_two' => $info->address_line_two,
            'city' => $info->city,
            'state' => $info->state,
            'postal_code' => $info->postal_code,
            'country' => $info->country,
            'phone_number' => $info->phone_number,
            'whatsapp' => $info->whatsapp,
            'facebook' => $info->facebook,
            'line' => $info->line,
            'alternate_emails' => $info->alternate_emails,
            'list_ids' => $info->list_ids,
            'unique_name' => $info->unique_name,
        ]);

        $email->lists()->syncWithoutDetaching($info->clist);
    }

    public function getSendgridId($contact)
    {
        $url = $this->baseURL.'/v3/marketing/contacts/search';
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post($url, [
            "query"=> "email LIKE '{$contact->email}%'",
        ]);

//        echo '<pre>';
//        print_r($response['result']);
//        echo '</pre>';

        $contact->update([
            'sendgrid_id' => $response['result'][0]['id'],
            'sendgrid_metadata' =>$response['result'][0]['_metadata']['self'],
        ]);
    }


}









//public function deleteContact($email)
//{
//    //return $email;
////        $url = $this->baseURL.'/v3/marketing/lists/'.$email->list_ids.'/contacts';
////        $response = Http::withHeaders([
////            'Authorization' => "Bearer {$this->apiKey}",
////        ])->delete($url, [
////            "contact_ids" => $email->sendgrid_id,
////        ]);
//
//
//
//    $url = $this->baseURL.'/v3/marketing/contacts';
//    $response = Http::withHeaders([
//        'Authorization' => "Bearer {$this->apiKey}",
//    ])->delete($url, [
//        "ids" => $email->sendgrid_id,
//    ]);
//
////        //$apiKey = getenv('SENDGRID_API_KEY');
////        $sg = new \SendGrid($this->apiKey);
////
////            $response = $sg->client->marketing()->contacts()->delete(['ids' => $email->sendgrid_id]);
//
//    dd($response->body());
//}

