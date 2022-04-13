<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PList;
use App\Models\Sms;
use Illuminate\Http\Request;

class smsController extends Controller
{
    public function index()
    {
        $sms = Sms::latest()->paginate('15');
        return view('layouts.backend.sms_call.sms.index', compact('sms'));

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
//        return $message;


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

    public function create()
    {
        return view('layouts.backend.sms_call.sms.create');
    }

    public function store(Request $request)
    {
        Sms::create([
            'name' => $request->name,
            'sms' => $request->sms,
        ]);
        return redirect()->route('dashboard.sms.index')->with('success','Message Created');
    }

    public function show(Sms $sms)
    {
        return view('layouts.backend.sms_call.sms.view', compact('sms'));
    }

    public function edit(Sms $sms)
    {
        return view('layouts.backend.sms_call.sms.edit', compact('sms'));
    }

    public function update(Request $request, Sms $sms)
    {
        $sms->update([
            'name' => $request->name,
            'sms' => $request->sms,
        ]);
        return redirect()->route('dashboard.sms.index')->with('info','Message Updated');
    }

    public function destroy(Sms $sms)
    {
        $sms->delete();
        return redirect()->route('dashboard.sms.index')->With('danger', 'Message Deleted');
    }

    public function sendTo(Sms $sms)
    {
        $lists = PList::latest()->get();
        return view('layouts.backend.sms_call.sms.sendToView', compact('sms','lists'));
    }

    public function storeSendTo(Request $request, Sms $sms)
    {
        $sms->list()->sync($request->lists);
        return redirect()->back();
    }
}
