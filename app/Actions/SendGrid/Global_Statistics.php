<?php

namespace App\Actions\SendGrid;


use App\Models\DashbordState;
use App\Models\Stat;
use Illuminate\Support\Facades\Http;

class Global_Statistics
{
    private $apiKey;
    private $baseURL;

    public function __construct()
    {
        $this->apiKey = config('services.sendgrid.apiKey');
        $this->baseURL = 'https://api.sendgrid.com';
    }

    public function getTotalStat($start_date)
    {
        $url = $this->baseURL.'/v3/stats';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get($url.'?start_date='.$start_date)->collect();

        foreach ($response as $data)
        {
            $forStore = [];
            $date = $data['date'];
            $dataStats = $data['stats'];
            foreach ($dataStats as $dataStat)
            {
                $dataMetrics = $dataStat['metrics'];

                $forStore[] = [
                    'date' => $date,
                    'blocks' => $dataMetrics['blocks'],
                    'bounce_drops' => $dataMetrics['bounce_drops'],
                    'bounces' => $dataMetrics['bounces'],
                    'deferred' => $dataMetrics['deferred'],
                    'delivered' => $dataMetrics['delivered'],
                    'invalid_emails' => $dataMetrics['invalid_emails'],
                    'processed' => $dataMetrics['processed'],
                    'requests' => $dataMetrics['requests'],
                    'spam_report_drops' => $dataMetrics['spam_report_drops'],
                    'spam_reports' => $dataMetrics['spam_reports'],
                    'unsubscribe_drops' => $dataMetrics['unsubscribe_drops'],
                    'unsubscribes' => $dataMetrics['unsubscribes'],
                    'clicks' => $dataMetrics['clicks'],
                    'unique_clicks' => $dataMetrics['unique_clicks'],
                    'opens' => $dataMetrics['opens'],
                    'unique_opens' => $dataMetrics['unique_opens']
                ];
            }

            Stat::upsert($forStore, ['date'], ['blocks', 'bounce_drops', 'bounces', 'deferred', 'delivered', 'invalid_emails', 'processed', 'requests', 'spam_report_drops', 'spam_reports', 'unsubscribe_drops', 'unsubscribes', 'clicks', 'unique_clicks', 'opens', 'unique_opens', ]);
        }
        return 'check database!';
    }

    public function updateLastDaysStat($start_date){
        $url = $this->baseURL.'/v3/stats';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get($url.'?start_date='.$start_date)->collect();

        $forStore = [];

        $lastItemIndex = count($response)-1;
        $primary_data = $response[$lastItemIndex]['stats'];

        $check_date = $response[$lastItemIndex]['date'];
        foreach ($primary_data as $p_data)
        {
            $data =  $p_data['metrics'];
            $forStore[] = [
                'date'  => $check_date,
                'blocks' => $data['blocks'],
                'bounce_drops' => $data['bounce_drops'],
                'bounces' => $data['bounces'],
                'deferred' => $data['deferred'],
                'delivered' => $data['delivered'],
                'invalid_emails' => $data['invalid_emails'],
                'processed' => $data['processed'],
                'requests' => $data['requests'],
                'spam_report_drops' => $data['spam_report_drops'],
                'spam_reports' => $data['spam_reports'],
                'unsubscribe_drops' => $data['unsubscribe_drops'],
                'unsubscribes' => $data['unsubscribes'],
                'clicks' => $data['clicks'],
                'unique_clicks' => $data['unique_clicks'],
                'opens' => $data['opens'],
                'unique_opens' => $data['unique_opens'],
                ];

        }

        Stat::upsert($forStore, ['date'], ['blocks', 'bounce_drops', 'bounces', 'deferred', 'delivered', 'invalid_emails', 'processed', 'requests', 'spam_report_drops', 'spam_reports', 'unsubscribe_drops', 'unsubscribes', 'clicks', 'unique_clicks', 'opens', 'unique_opens', ]);

        return 'done';
    }

    public function avgState($avg_days){
        $forStore = [];
        if ($avg_days === 1)
        {
            $range = 'daily';
        }elseif ($avg_days === 7)
        {
            $range = 'weekly';
        }elseif ($avg_days === 30)
        {
            $range = 'monthly';
        }else{
            die();
        }

        $start_date = now()->subDays($avg_days)->format('Y-m-d');
        $data = Stat::where('date', '>=', $start_date)->get()->toArray();

        $count = count($data);

        do {
            array_shift($data);
            $count--;
        } while ($count > $avg_days);

//        return $data['0']['date'];

        $blocks = collect($data)->sum('blocks');
        $bounce_drops = collect($data)->sum('bounce_drops');
        $bounces = collect($data)->sum('bounces');
        $deferred = collect($data)->sum('deferred');
        $delivered = collect($data)->sum('delivered');
        $invalid_emails = collect($data)->sum('invalid_emails');
        $processed = collect($data)->sum('processed');
        $requests = collect($data)->sum('requests');
        $spam_report_drops = collect($data)->sum('spam_report_drops');
        $spam_reports = collect($data)->sum('spam_reports');
        $unsubscribe_drops = collect($data)->sum('unsubscribe_drops');
        $unsubscribes = collect($data)->sum('unsubscribes');
        $clicks = collect($data)->sum('clicks');
        $unique_clicks = collect($data)->sum('unique_clicks');
        $opens = collect($data)->sum('opens');
        $unique_opens = collect($data)->sum('unique_opens');

        $forStore[] = [
            'range'  => $range,
            'blocks' => $blocks,
            'bounce_drops' => $bounce_drops,
            'bounces' => $bounces,
            'deferred' => $deferred,
            'delivered' => $delivered,
            'invalid_emails' => $invalid_emails,
            'processed' => $processed,
            'requests' => $requests,
            'spam_report_drops' => $spam_report_drops,
            'spam_reports' => $spam_reports,
            'unsubscribe_drops' => $unsubscribe_drops,
            'unsubscribes' => $unsubscribes,
            'clicks' => $clicks,
            'unique_clicks' => $unique_clicks,
            'opens' => $opens,
            'unique_opens' => $unique_opens,
        ];

        DashbordState::upsert($forStore, ['range'], ['blocks', 'bounce_drops', 'bounces', 'deferred', 'delivered', 'invalid_emails', 'processed', 'requests', 'spam_report_drops', 'spam_reports', 'unsubscribe_drops', 'unsubscribes', 'clicks', 'unique_clicks', 'opens', 'unique_opens', ]);
    }

}
