<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\Single_Send;
use App\Http\Controllers\Controller;
use App\Models\Clist;
use App\Models\SenderVerification;
use App\Models\SingleSend;
use App\Models\UnsubscribeGroup;
use Illuminate\Http\Request;

class SingleSendController extends Controller
{
    private $singleSend;

    public function __construct(Single_Send $singleSend)
    {
        $this->singleSend = $singleSend;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index()
    {
        $singleSends = SingleSend::latest()->paginate('15');
        return view('layouts.backend.singleSend.index',compact('singleSends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $contactList = Clist::latest()->get();
        $suppression_group_id = UnsubscribeGroup::latest()->get();
        $sender = SenderVerification::latest()->get();
        return view('layouts.backend.singleSend.create',compact('contactList','suppression_group_id','sender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $response = $this->singleSend->addSingleSend($request);
        return $response;
        if ($response == 1)
        {
            return redirect()->route('dashboard.single-sends.index')->with('success','Single send Listed');
        }else{
            return redirect()->route('dashboard.single-sends.index')->with('danger','Something is happened! with sendgrid configuration');
        }

    }


    public function updateSchedule(Request $request)
    {
        $response = $this->singleSend->scheduleSingleSends($request->singleSendID);
        if ($response == 1)
        {
            return redirect()->route('dashboard.single-sends.index')->with('success','Single send scheduled for sent after 5 minutes');
        }else{
            return redirect()->route('dashboard.single-sends.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }


    public function cancelSchedule(Request $request)
    {
        $response = $this->singleSend->unscheduledSingleSends($request->singleSendID);
        if ($response == 1)
        {
            return redirect()->route('dashboard.single-sends.index')->with('danger','Single send schedule is cancel');
        }else{
            return redirect()->route('dashboard.single-sends.index')->with('danger','Something is happened! with sendgrid configuration');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SingleSend  $single_send
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(SingleSend $single_send)
    {
        $suppression = UnsubscribeGroup::where('sendgrid_id', $single_send->suppression_group_id)->firstOrFail();
        $sender = SenderVerification::where('sendgrid_id', $single_send->sender_id)->firstOrFail();
        return view('layouts.backend.singleSend.view',compact('single_send','suppression','sender'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SingleSend  $mailId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewMail(SingleSend $mailId)
    {
        return view('layouts.backend.singleSend.show_mail',compact('mailId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SingleSend  $single_send
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(SingleSend $single_send)
    {
        $contactList = Clist::latest()->get();
        $suppression_group_id = UnsubscribeGroup::latest()->get();
        $sender = SenderVerification::latest()->get();
        return view('layouts.backend.singleSend.edit',compact('single_send','contactList','suppression_group_id','sender'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SingleSend  $single_send
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,SingleSend $single_send)
    {
        $this->singleSend->updateSingleSend($request , $single_send);
        if ($response == 1)
        {
            return redirect()->route('dashboard.single-sends.index')->with('success','Single Send Updated');
        }else{
            return redirect()->route('dashboard.single-sends.index')->with('danger','Something is happened! with sendgrid configuration');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SingleSend  $single_send
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SingleSend $single_send)
    {
        $response = $this->singleSend->deleteSingleSend($single_send->sendgrid_id);
        if ($response == 1)
        {
            $single_send->lists()->detach();
            $single_send->delete();
            return redirect()->route('dashboard.single-sends.index')->with('danger','Single send Deleted');
        }else{
            return redirect()->route('dashboard.single-sends.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }
}
