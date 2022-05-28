<?php

namespace App\Actions\Vonage;


use App\Models\FailedMessageCallback;
use App\Models\ForSend;
use App\Models\MessageCallback;
use App\Models\SendSms;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;

class Send_Sms
{
    private $apiKey;
    private $apiSecret;
    private $basic;
    private $client;

    public function __construct()
    {
        $this->apiKey = config('services.vonage.apiKey');
        $this->apiSecret = config('services.vonage.apiSecret');
        $this->basic  = new Basic($this->apiKey, $this->apiSecret);
        $this->client = new Client($this->basic);
    }

    public function for_send($sms)
    {
        foreach ($sms->list as $list)
        {
            foreach ($list->number as $number)
            {
                ForSend::create([
                    'to' => $number->phone_number,
                    'from' => $sms->identity,
                    'message' => $sms->sms,
                    'is_queue' => 0,
                ]);
            }
        }

    }

    public function failed_retry()
    {
        $failed_list = FailedMessageCallback::all();
        foreach ($failed_list as $list)
        {
            ForSend::create([
                'to' => $list->to,
                'from' => $list->from,
                'message' => $list->message_body,
                'is_queue' => 0,
            ]);
            $list->delete();
        }

    }

    public function send()
    {
        $all_sms = ForSend::all();

        foreach ($all_sms as $sms)
        {
            $response = $this->client->sms()->send(
                new \Vonage\SMS\Message\SMS(
                    "$sms->to",
                    "$sms->from",
                    "$sms->message")
            );
            $sms->delete();
        }


        $message = $response->current();


        if ($message->getStatus() == 0) {
            SendSms::create([
                'accountRef' => Carbon::now(),//$message->getAccountRef()
                'clientRef' => $message->getClientRef(),
                'messageId' => $message->getMessageId(),
                'messagePrice' => $message->getMessagePrice(),
                'network' => $message->getNetwork(),
                'remainingBalance' => $message->getRemainingBalance(),
                'status' => $message->getStatus(),
                'to' => $message->getTo(),
                'from' => 'from',
                'message' => 'message',
            ]);
            return "The message was sent successfully\n";

        } else {
            return "The message failed with status: " . $message->getStatus() . "\n";
        }
    }


    public function status(){
        $all_sms = SendSms::all();

        $url = 'https://api.nexmo.com/v2/reports/records';

        $str = "{$this->apiKey}:{$this->apiSecret}";
        $key = base64_encode($str);


        foreach ($all_sms as $sms) {
            $response = Http::withHeaders([
                'Authorization' => "Basic {$key}",
            ])->get($url . '?account_id=' . "{$this->apiKey}" . '&product=' . 'SMS' . '&direction=' . 'outbound' . '&id=' . "{$sms->messageId}" . '&include_message=' . 'true' . '&show_concatenated=' . 'true');

            $datas = $response['records'];
            foreach ($datas as $data) {
                if($data['status'] === "delivered" || $data['error_code'] === 0)
                {
                    MessageCallback::create([
                        'include_subaccounts' => $response['include_subaccounts'],
                        'account_id' => $data['account_id'],
                        'message_id' => $data['message_id'],
                        'account_ref' => $data['account_ref'],
                        'client_ref' => $data['client_ref'],
                        'direction' => $data['direction'],
                        'from' => $data['from'],
                        'to' => $data['to'],
                        'forced_from' => $data['forced_from'],
                        'message_body' => $data['message_body'],
                        'concatenated' => $data['concatenated'],
                        'network' => $data['network'],
                        'network_name' => $data['network_name'],
                        'country' => $data['country'],
                        'country_name' => $data['country_name'],
                        'date_received' => $data['date_received'],
                        'date_finalized' => $data['date_finalized'],
                        'latency' => $data['latency'],
                        'status' => $data['status'],
                        'error_code' => $data['error_code'],
                        'error_code_description' => $data['error_code_description'],
                        'currency' => $data['currency'],
                        'total_price' => $data['total_price'],
                        'm_id' => $data['id'],
                        'dcs' => $data['dcs'],
                        'validity_period' => $data['validity_period'],
                        'ip_address' => $data['ip_address'],
                    ]);
                }else{
                    FailedMessageCallback::create([
                        'include_subaccounts' => $response['include_subaccounts'],
                        'account_id' => $data['account_id'],
                        'message_id' => $data['message_id'],
                        'account_ref' => $data['account_ref'],
                        'client_ref' => $data['client_ref'],
                        'direction' => $data['direction'],
                        'from' => $data['from'],
                        'to' => $data['to'],
                        'forced_from' => $data['forced_from'],
                        'message_body' => $data['message_body'],
                        'concatenated' => $data['concatenated'],
                        'network' => $data['network'],
                        'network_name' => $data['network_name'],
                        'country' => $data['country'],
                        'country_name' => $data['country_name'],
                        'date_received' => $data['date_received'],
                        'date_finalized' => $data['date_finalized'],
                        'latency' => $data['latency'],
                        'status' => $data['status'],
                        'error_code' => $data['error_code'],
                        'error_code_description' => $data['error_code_description'],
                        'currency' => $data['currency'],
                        'total_price' => $data['total_price'],
                        'm_id' => $data['id'],
                        'dcs' => $data['dcs'],
                        'validity_period' => $data['validity_period'],
                        'ip_address' => $data['ip_address'],
                    ]);
                }

                $sms->delete();
            }
        }
    }
}
