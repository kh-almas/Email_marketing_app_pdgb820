<?php

namespace App\Http\Controllers\backend;

use App\Actions\Helpers\IdGenerator;
use App\Actions\Vonage\Send_Sms;
use App\Http\Controllers\Controller;
use App\Models\FailedMessageCallback;
use App\Models\ForSend;
use App\Models\MessageCallback;
use App\Models\PList;
use App\Models\Sms;
use Illuminate\Http\Request;

class smsController extends Controller
{
    private $idGenerator;
    private $sendSms;

    public function __construct(IdGenerator $idGenerator, Send_Sms $sendSms)
    {
        $this->idGenerator = $idGenerator;
        $this->sendSms = $sendSms;
    }

    public function index()
    {
        $sms = Sms::latest()->paginate('15');
        return view('layouts.backend.sms_call.sms.index', compact('sms'));
    }

    public function create()
    {
        return view('layouts.backend.sms_call.sms.create');
    }

    public function store(Request $request)
    {
        $unique_id = $this->idGenerator->RandomNumber(new Sms, 'unique_id', 10, 4, 'sms');
        Sms::create([
            'identity' => $request->identity,
            'unique_id' => $unique_id,
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
            'identity' => $request->identity,
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
        return redirect()->route('dashboard.sms.index')->with('info','Group update');
    }

    public function send(Sms $sms)
    {
//        $sdfgsdf = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s',];
//
//        foreach ($sdfgsdf as $xcfvb)
//        {
//            echo($xcfvb).'</br>';
//            sleep(1);
//        }
//        //$data = ForSend::take(10)->get();
//        ///sleep(10);//wait (sleep)for 10 seconds
//        //return $data;
        $this->sendSms->for_send($sms);
        return back()->with('success','Message is ready for send. Sending will start in one minute');
    }

    public function successFeedback()
    {
        $all_data = MessageCallback::latest()->paginate('20');
        return view('layouts.backend.sms_call.sms.successMessageFeedback', compact('all_data'));
    }

    public function deleteSuccessFeedback(MessageCallback $send)
    {
        $send->delete();
        return redirect()->back()->with('success' , 'Item deleted');
    }

    public function failedFeedback()
    {
        $all_data = FailedMessageCallback::latest()->paginate('20');
        return view('layouts.backend.sms_call.sms.failedMessageFeedback', compact('all_data'));
    }

    public function deleteFailedFeedback(FailedMessageCallback $send)
    {
        $send->delete();
        return redirect()->back()->with('success' , 'Item deleted');
    }

    public function queueMessage()
    {
        $all_data = ForSend::latest()->paginate('20');
        return view('layouts.backend.sms_call.sms.queueMessage', compact('all_data'));
    }

    public function deleteQueueMessage(ForSend $send)
    {
        $send->delete();
        return redirect()->back()->with('success' , 'Item deleted');
    }

    public function failedFeedbackRetry()
    {
        $this->sendSms->failed_retry();
        return redirect()->route('dashboard.sms.index')->with('success','Message is ready for send. Sending will start in one minute');
    }
}
