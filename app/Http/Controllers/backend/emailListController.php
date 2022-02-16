<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\ContactList;
use App\Http\Controllers\Controller;
use App\Http\Requests\addemailListRequest;
use App\Models\EmailList;
use Illuminate\Http\Request;

class emailListController extends Controller
{
    private $list;

    public function __construct(ContactList $contactList)
    {
        $this->list = $contactList;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email_lists = EmailList::latest()->paginate('15');
        return view('layouts.backend.email_list.index',compact('email_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend.email_list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(addemailListRequest $request)
    {
        $this->list->addContactList($request->name);
        return redirect()->route('dashboard.email_list.index')->with('success','Email list added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailList  $email_list
     * @return \Illuminate\Http\Response
     */
    public function show(EmailList $email_list)
    {
        $response = $this->list->updateContactCount($email_list);
        return view('layouts.backend.email_list.view',compact('email_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailList  $email_list
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailList $email_list)
    {
        return view('layouts.backend.email_list.edit',compact('email_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailList  $email_list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailList $email_list)
    {
        $response = $this->list->updateContactList($request->name, $email_list);
        return redirect()->route('dashboard.email_list.index')->with('info','Email list updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailList  $email_list
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailList $email_list)
    {
        $response = $this->list->deleteContactList($email_list);
        return redirect()->route('dashboard.email_list.index')->With('danger', 'Email list deleted');
    }
}
