<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PList;
use Illuminate\Http\Request;

class pListController extends Controller
{
    public function index()
    {
        $number_list = PList::latest()->paginate('20');
        return view('layouts.backend.sms_call.p_list.index', compact('number_list'));
    }

    public function create()
    {
        return view('layouts.backend.sms_call.p_list.create');
    }

    public function store(Request $request)
    {
        PList::create([
            'name' => $request->name,
        ]);
        return redirect()->route('dashboard.group.index')->with('success','New list created');
    }

    public function edit(PList $group)
    {
        return view('layouts.backend.sms_call.p_list.edit', compact('group'));
    }

    public function update(Request $request, PList $group)
    {
        $group->update([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.group.index')->with('info','Group Updated');
    }

    public function destroy(PList $group)
    {
        $group->number()->detach();
        $group->delete();
        return redirect()->route('dashboard.group.index')->With('danger', 'Group Deleted');
    }
}



//public function index()
//{
//    $sid = "AC7ed7805ddbc9fd28846cecbf20bb8fd7";
//    $token = "672edbfe70db1b6e9c5dcb44f6cf66dc";
//    $twilio = new Client($sid, $token);
//
//    $message = $twilio->messages
//        ->create("+8801628625196", // to
//            [
//                "body" => "Open to confirm: daytodays.com",
//                "from" => "+18049792832",
//            ]
//        );
//
////        print($message->sid);
//    return $message;
//
//
////        $sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/console
////        $token = "YYYYYY"; // Your Auth Token from www.twilio.com/console
//
////        $client = new Client($sid, $token);
////
////        // Read TwiML at this URL when a call connects (hold music)
////        $call = $client->calls->create(
////            '+8801628625196', // Call this number
////            '+18049792832', // From a valid Twilio number
////            [
////                'url' => 'https://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient'
////            ]
////        );
//}
