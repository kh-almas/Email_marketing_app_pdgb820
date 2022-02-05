<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\SuppressionGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuppressionGroup as SuppressionGroupModel;

class suppressionGroupController extends Controller
{
    private $suppressionGroup;

    public function __construct(SuppressionGroup $suppressionGroup)
    {
        $this->suppressionGroup = $suppressionGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppressionGroup = SuppressionGroupModel::latest()->paginate('15');
        return view('layouts.backend.suppressionGroup.index',compact('suppressionGroup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend.suppressionGroup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->suppressionGroup->createSuppressionGroup($request);
        return redirect()->route('dashboard.suppression-group.index')->with('success','Suppression Group added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuppressionGroup  $suppression_group
     * @return \Illuminate\Http\Response
     */
    public function show(SuppressionGroupModel $suppression_group)
    {
        return view('layouts.backend.suppressionGroup.view',compact('suppression_group'));
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
     * @param  \App\Models\SuppressionGroup  $suppression_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuppressionGroupModel $suppression_group)
    {
        $this->suppressionGroup->deleteSuppressionGroup($suppression_group->sendgrid_id);
        $suppression_group->delete();
        return redirect()->route('dashboard.suppression-group.index')->With('danger', 'suppression Group Deleted');
    }
}
