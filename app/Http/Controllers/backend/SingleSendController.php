<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\Single_Send;
use App\Http\Controllers\Controller;
use App\Models\EmailList;
use App\Models\SenderVerification;
use App\Models\SingleSend;
use App\Models\SuppressionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleSendController extends Controller
{
    private $singleSend;

    public function __construct(Single_Send $singleSend)
    {
        $this->singleSend = $singleSend;
    }

    public function datetime(Request $request)
    {
        return $request;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index()
    {
//        $response = $this->singleSend->getSender();
//        return $response;
        $singleSends = SingleSend::latest()->paginate('15');
        return view('layouts.backend.singleSend.index',compact('singleSends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contactList = EmailList::latest()->get();
        $suppression_group_id = SuppressionGroup::latest()->get();
        $sender = SenderVerification::latest()->get();
        return view('layouts.backend.singleSend.create',compact('contactList','suppression_group_id','sender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->singleSend->addSingleSend($request);
        return redirect()->route('dashboard.single-sends.index')->with('success','Single send Listed');
    }


    public function updateSchedule(Request $request)
    {
        $response = $this->singleSend->addSingleSend($request->singleSendID);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SingleSend  $single_send
     * @return \Illuminate\Http\Response
     */
    public function show(SingleSend $single_send)
    {
        //$list = DB::Table('single_sends')->where('sendgrid_id', $single_send->list_ids)->select('name')->get();
        $list = EmailList::where('sendgrid_id', $single_send->list_ids)->firstOrFail();
        $suppression = SuppressionGroup::where('sendgrid_id', $single_send->suppression_group_id)->firstOrFail();
        $sender = SenderVerification::where('sendgrid_id', $single_send->sender_id)->firstOrFail();
        return view('layouts.backend.singleSend.view',compact('single_send','list','suppression','sender'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SingleSend  $mailId
     * @return \Illuminate\Http\Response
     */
    public function viewMail(SingleSend $mailId)
    {
        return view('layouts.backend.singleSend.show_mail',compact('mailId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SingleSend  $single_send
     * @return \Illuminate\Http\Response
     */
    public function edit(SingleSend $single_send)
    {
//        return $single_send;
//        return view('layouts.backend.singleSend.edit',compact('single_send'));

        $contactList = EmailList::latest()->get();
        $suppression_group_id = SuppressionGroup::latest()->get();
        $sender = SenderVerification::latest()->get();
        return view('layouts.backend.singleSend.edit',compact('single_send','contactList','suppression_group_id','sender'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SingleSend  $single_send
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,SingleSend $single_send)
    {
        //return $single_send;
        $this->singleSend->updateSingleSend($request , $single_send);
        return redirect()->route('dashboard.single-sends.index')->with('success','Single Send Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
