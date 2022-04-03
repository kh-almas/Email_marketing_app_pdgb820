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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $senderVerification = SenderVerification::latest()->paginate('15');
        return view('layouts.backend.senderVerification.index',compact('senderVerification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('layouts.backend.senderVerification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param addSenderVerificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SenderVerification $sender_verification
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(SenderVerification $sender_verification)
    {
        return view('layouts.backend.senderVerification.view',compact('sender_verification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //abort('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //abort('404');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SenderVerification $sender_verification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SenderVerification $sender_verification)
    {
        $this->sender->deleteSenderVerification($sender_verification->sendgrid_id);

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
