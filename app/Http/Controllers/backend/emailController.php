<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\updateEmailRequest;
use App\Models\Clist;
use App\Models\Email;
use Illuminate\Http\Request;

class emailController extends Controller
{
    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Clist::latest()->get();
        $emails = Email::latest()->paginate('15');
        return view('layouts.backend.email.index',compact('emails','lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $contactList = Clist::all();
        return view('layouts.backend.email.create',compact('contactList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $info
     * @return \\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->contact->addContact($request);
        if ($response == 1)
        {
            return redirect()->route('dashboard.email.index')->with('success','Email Listed');
        }else{
            return redirect()->route('dashboard.email.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        return view('layouts.backend.email.view',compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        $contactList = Clist::all();
        return view('layouts.backend.email.edit',compact('email','contactList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Email $email)//updateEmailRequest
    {
        $response = $this->contact->updateContact($request, $email);

        if ($response == 1)
        {
            return redirect()->route('dashboard.email.index')->with('info','Email Updated');
        }else{
            return redirect()->route('dashboard.email.index')->with('danger','Something is happened! with sendgrid configuration');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Email $email)
    {
        $response = $this->contact->deleteContact($email->sendgrid_id);

        if ($response == 1)
        {
            $email->lists()->detach();
            $email->delete();
            return redirect()->route('dashboard.email.index')->With('danger', 'Email Deleted');
        }else{
            $this->contact->getSendgridId($email);
            return redirect()->route('dashboard.email.index')->with('danger','Something is happened! with sendgrid configuration! try again.');
        }
    }

    public function getSendgridId(Email $id)
    {
        $response = $this->contact->getSendgridId($id);

        if ($response == 1)
        {
            return back()->With('success', 'SendGrid ID Collected');
        }else{
            return back()->with('danger','Something is happened! with sendgrid configuration');
        }
    }
}
