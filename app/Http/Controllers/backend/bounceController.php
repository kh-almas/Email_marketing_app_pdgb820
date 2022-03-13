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
        $dfhfxhg = $this->bounces->updateList();
        return $dfhfxhg;
        return redirect()->route('dashboard.bounce.index')->with('success','List updated');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return 'ok';
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
