<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\Contact;
use App\Actions\SendGrid\ContactList;
use App\Http\Controllers\Controller;
use App\Http\Requests\addemailListRequest;
use App\Models\Clist;
use App\Models\Email;
use Illuminate\Http\Request;

class emailListController extends Controller
{
    private $list;

    public function __construct(ContactList $contactList,)
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
        $email_lists = Clist::latest()->paginate('15');
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(addemailListRequest $request)
    {
        $response = $this->list->addContactList($request->name);
        if ($response == 1)
        {
            return redirect()->route('dashboard.email_list.index')->with('success','Email list added');
        }else{
            return redirect()->route('dashboard.email_list.index')->with('danger','Something is happened! with sendgrid configuration');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clist  $email_list
     * @return \Illuminate\Http\Response
     */
    public function show(Clist $email_list)
    {
        $this->list->updateContactCount($email_list);
        return view('layouts.backend.email_list.view',compact('email_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clist  $email_list
     * @return \Illuminate\Http\Response
     */
    public function edit(Clist $email_list)
    {
        return view('layouts.backend.email_list.edit',compact('email_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clist  $email_list
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Clist $email_list)
    {
        $response = $this->list->updateContactList($request->name, $email_list);
        if ($response == 1)
        {
            return redirect()->route('dashboard.email_list.index')->with('info','Email list updated');
        }else{
            return redirect()->route('dashboard.email_list.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clist  $email_list
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Clist $email_list)
    {
        $response = $this->list->deleteContactList($email_list);
        if ($response == 1)
        {
            $email_list->email()->detach();
            $email_list->singleSend()->detach();
            $email_list->delete();
            return redirect()->route('dashboard.email_list.index')->With('danger', 'Email list deleted');
        }else{
            return redirect()->route('dashboard.email_list.index')->with('danger','Something is happened! with sendgrid configuration');
        }

    }





    public function removeContactFromList($list_sendgrid_id, Email $email)
    {


        $response = $this->list->removeContactFromList($list_sendgrid_id , $email);
        return $response;
//        if($response == 1)
//        {
////            $email = Email::where('sendgrid_id', $email_id)->first();
////            $list = Clist::where('sendgrid_id', $list_id)->first();
////            $list->email()->detach($email->id);
//            return redirect()->route('dashboard.email.index')->With('danger', 'Email removed from list');
//        }else{
//            return redirect()->route('dashboard.email.index')->with('danger','Something is happened! with sendgrid configuration');
//        }
    }



    public function jobStatus()
    {
        $response = $this->list->importContactStatus();
        return $response;

    }








    public function deleteContactFromList($list_id, $email_id)
    {
        $response = $this->list->deleteContactFromList($list_id, $email_id);
        return $response;
        if($response == 1)
        {
            $email = Email::where('sendgrid_id', $email_id)->first();
            $list = Clist::where('sendgrid_id', $list_id)->first();
            $list->email()->detach($email->id);
            return redirect()->route('dashboard.email.index')->With('danger', 'Email removed from list');
        }else{
            return redirect()->route('dashboard.email.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }

    public function addContactToList($email_id, $list_id)
    {
        $response = $this->list->addContactToList($email_id, $list_id);
        if ($response == 1)
        {
            return redirect()->route('dashboard.email.index')->with('success','Email added to the list');
        }else{
            return redirect()->route('dashboard.email.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }
}
