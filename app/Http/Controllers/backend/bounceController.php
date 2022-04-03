<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Bounce;
use App\Actions\SendGrid\Bounces;
use Illuminate\Http\Request;

class bounceController extends Controller
{
    private $bounces;

    public function __construct(Bounces $bounces)
    {
        $this->bounces = $bounces;
    }

    public function updateList()
    {
        $response = $this->bounces->updateList();
//        if ($response == 1)
//        {
            return redirect()->route('dashboard.bounce.index')->with('success','List updated');
//        }else{
//            return redirect()->route('dashboard.bounce.index')->with('danger','Something is happened! with sendgrid configuration');
//        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bounces = Bounce::latest()->paginate('15');
        return view('layouts.backend.bounce.index',compact('bounces'));
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
     * @param  \App\Models\Bounce  $bounce
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Bounce $bounce)
    {
        return view('layouts.backend.bounce.view',compact('bounce'));
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
     * @param  \App\Models\Bounce  $bounce
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Bounce $bounce)
    {
        $response =$this->bounces->deletebounce($bounce);
        if ($response == 1)
        {
            $bounce->delete();
            return redirect()->route('dashboard.bounce.index')->With('danger', 'Email Deleted');
        }else{
            return redirect()->route('dashboard.bounce.index')->with('danger','Something is happened! with sendgrid configuration');
        }

    }
}
