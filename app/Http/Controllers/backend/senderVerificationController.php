<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\Sender_Verification;
use App\Http\Controllers\Controller;
use App\Http\Requests\addSenderVerificationRequest;
use App\Models\SenderVerification;
use Illuminate\Http\Request;

class senderVerificationController extends Controller
{
    private $sender;

    public function __construct(Sender_Verification $sender)
    {
        $this->sender = $sender;
    }

    public function index()
    {
        $senderVerification = SenderVerification::latest()->paginate('15');
        return view('layouts.backend.senderVerification.index',compact('senderVerification'));
    }

    public function create()
    {
        return view('layouts.backend.senderVerification.create');
    }

    public function store(addSenderVerificationRequest $request)
    {
        $response =$this->sender->createSenderVerification($request);
        if ($response == 1)
        {
            return redirect()->route('dashboard.sender-verification.index')->with('success','Sender verification added');
        }else{
            return redirect()->route('dashboard.sender-verification.index')->with('danger','Something is happened! with sendgrid configuration');
        }

    }

    public function show(SenderVerification $sender_verification)
    {
        return view('layouts.backend.senderVerification.view',compact('sender_verification'));
    }

    public function destroy(SenderVerification $sender_verification)
    {
        $response = $this->sender->deleteSenderVerification($sender_verification->sendgrid_id);

        if ($response == 1)
        {
            $sender_verification->delete();
            return redirect()->route('dashboard.sender-verification.index')->with('danger','Sender verification deleted');
        }else{
            return redirect()->route('dashboard.sender-verification.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }

    public function getAllSingleSend()
    {
        $response = $this->sender->getAllSingleSend();
        if ($response == 1)
        {
            return redirect()->route('dashboard.sender-verification.index')->with('success','Sender list updated');
        }else{
            return redirect()->route('dashboard.bounce.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }
}
