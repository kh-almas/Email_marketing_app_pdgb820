<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class smsController extends Controller
{
    public function index()
    {
//        $sid = "AC7ed7805ddbc9fd28846cecbf20bb8fd7";
//        $token = "672edbfe70db1b6e9c5dcb44f6cf66dc";
//        $twilio = new Client($sid, $token);
//
//        $message = $twilio->messages
//            ->create("+8801628625196", // to
//                [
//                    "body" => "Open to confirm: daytodays.com",
//                    "from" => "+18049792832",
//                ]
//            );

//        print($message->sid);
        return $message;


//        $sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/console
//        $token = "YYYYYY"; // Your Auth Token from www.twilio.com/console

//        $client = new Client($sid, $token);
//
//        // Read TwiML at this URL when a call connects (hold music)
//        $call = $client->calls->create(
//            '+8801628625196', // Call this number
//            '+18049792832', // From a valid Twilio number
//            [
//                'url' => 'https://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient'
//            ]
//        );
    }
}
