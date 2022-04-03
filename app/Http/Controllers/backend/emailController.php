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
        return view('layouts.backend.email.edit',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(updateEmailRequest $request, Email $email)
    {
        $email->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address_line_one' => $request->address_line_one,
            'address_line_two' => $request->address_line_two,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'phone_number' => $request->phone_number,
            'whatsapp' => $request->whatsapp,
            'facebook' => $request->facebook,
            'line' => $request->line,
            'alternate_emails' => $request->alternate_emails,
            'list_ids' => $request->list_ids,
            'unique_name' => $request->unique_name,
            'sendgrid_id' => $request->sendgrid_id,
            'sendgrid_metadata' => $request->sendgrid_metadata,
        ]);
        return redirect()->route('dashboard.email.index')->with('info','Email Updated');
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
        $email->lists()->detach();
        $email->delete();
        if ($response == 1)
        {
            return redirect()->route('dashboard.email.index')->With('danger', 'Email Deleted');
        }else{
            return redirect()->route('dashboard.email.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }

    public function getSendgridId(Email $id)
    {
        $response = $this->contact->getSendgridId($id);

        if ($response == 1)
        {
            return redirect()->route('dashboard.email.index')->With('success', 'SendGrid ID Collected');
        }else{
            return redirect()->route('dashboard.email.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }
}
