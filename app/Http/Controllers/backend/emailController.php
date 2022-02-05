<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\addEmailRequest;
use App\Http\Requests\updateEmailRequest;
use App\Models\Email;
use App\Models\EmailList;
use Illuminate\Http\Request;

class emailController extends Controller
{
    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function destroy(Email $email)
    {
        $response = $this->contact->deleteContact($email->sendgrid_id);
//        return $response;
        $email->delete();
        return redirect()->route('dashboard.email.index')->With('danger', 'Email Deleted');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::latest()->paginate('15');
        return view('layouts.backend.email.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $contactList = EmailList::all();
        return view('layouts.backend.email.create',compact('contactList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(addEmailRequest $request)
    {
        $this->contact->addContact($request);
        return redirect()->route('dashboard.email.index')->with('success','Email Listed');
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
//    public function destroy(Email $email)
//    {
//        //return $email->sendgrid_id;
//        $response = $this->contact->deleteContact($email->sendgrid_id);
//        return $response;
//        $email->delete();
//        return redirect()->route('dashboard.email.index')->With('danger', 'Email Delated');
//    }

    public function getSendgridId(Email $id)
    {
        $this->contact->getSendgridId($id);
        return redirect()->route('dashboard.email.index')->With('success', 'SendGrid ID Collected');
    }
}
