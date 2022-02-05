<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\SingleSend;
use App\Http\Controllers\Controller;
use App\Models\EmailList;
use Illuminate\Http\Request;

class SingleSendController extends Controller
{
    private $singleSend;

    public function __construct(SingleSend $singleSend)
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
//        $response = $this->singleSend->getSender();
//        return $response;
        return view('layouts.backend.singleSend.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contactList = EmailList::all();
        return view('layouts.backend.singleSend.create',compact('contactList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $text='fdssdf';
        $response = $this->singleSend->addSingleSend();
        return $response;
    }


    public function updateSchedule(Request $request)
    {
        $response = $this->singleSend->addSingleSend($request->singleSendID);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
