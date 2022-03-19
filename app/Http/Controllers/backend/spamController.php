<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\Spam_Reporte;
use App\Http\Controllers\Controller;
use App\Models\Spam;
use Illuminate\Http\Request;

class spamController extends Controller
{

    private $spamReporte;

    public function __construct(Spam_Reporte $spamReporte)
    {
        $this->spamReporte = $spamReporte;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spams = Spam::latest()->paginate('15');
        return view('layouts.backend.spam.index',compact('spams'));
    }


    public function updateSpamList()
    {
        $response = $this->spamReporte->updateSpamList();
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  \App\Models\Spam  $spam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spam $spam)
    {
        $response = $this->spamReporte->deleteSpam($spam->email);
        return $response;
    }
}
