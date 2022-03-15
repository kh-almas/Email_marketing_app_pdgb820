<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\Unsubscribe_Group;
use App\Http\Controllers\Controller;
use App\Models\UnsubscribeGroup;
use App\Models\UnsubscribeGroupsEmail;
use Illuminate\Http\Request;

class unsubscribeGroupsController extends Controller
{
    private $UnsubscribeGroup;

    public function __construct(Unsubscribe_Group $UnsubscribeGroup)
    {
        $this->UnsubscribeGroup = $UnsubscribeGroup;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppressionGroup = UnsubscribeGroup::latest()->paginate('15');
        return view('layouts.backend.unsubscribeGroups.index',compact('suppressionGroup'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend.unsubscribeGroups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->UnsubscribeGroup->createUnsubscribeGroup($request);
        return redirect()->route('dashboard.unsubscribe-group.index')->with('success','Suppression Group added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnsubscribeGroup  $unsubscribe_group
     * @return \Illuminate\Http\Response
     */
    public function show(UnsubscribeGroup $unsubscribe_group)
    {
        return view('layouts.backend.unsubscribeGroups.view',compact('unsubscribe_group'));
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
     * @param  \App\Models\UnsubscribeGroup  $suppression_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnsubscribeGroup $unsubscribe_group)
    {
        $this->UnsubscribeGroup->deleteUnsubscribeGroup($unsubscribe_group->sendgrid_id);
        $unsubscribe_group->delete();
        return redirect()->route('dashboard.unsubscribe-group.index')->With('danger', 'suppression Group Deleted');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnsubscribeGroup  $groupId
     * @return \Illuminate\Http\Response
     */
    public function updateGroup(UnsubscribeGroup $groupId)
    {
        $this->UnsubscribeGroup->retrieveAllSuppression($groupId);
        return back()->with('info','List Updated');
    }

    public function addEmailToSuppression()
    {
        $groupId = 17030;
        $fxbxcf = $this->UnsubscribeGroup->addEmailToSuppression($groupId);
        return $fxbxcf;
    }

    public function deleteEmailFromUnsubscribeGroup(UnsubscribeGroupsEmail $emailInfo, $group_id)
    {
        $response = $this->UnsubscribeGroup->deleteEmailFromUnsubscribeGroup($emailInfo, $group_id);
        if ($response === true)
        {
            $emailInfo->delete();
            return back()->With('danger', 'Email delete form this list');
        }else{
            return back()->With('danger', 'Something wrong with sendgrid configuration');
        }

    }
}
