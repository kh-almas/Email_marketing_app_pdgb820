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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $suppressionGroup = UnsubscribeGroup::latest()->paginate('15');
        return view('layouts.backend.unsubscribeGroups.index',compact('suppressionGroup'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('layouts.backend.unsubscribeGroups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $response = $this->UnsubscribeGroup->createUnsubscribeGroup($request);
        if ($response == 1)
        {
            return redirect()->route('dashboard.unsubscribe-group.index')->with('success','Suppression Group added');
        }else{
            return redirect()->route('dashboard.bounce.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnsubscribeGroup  $unsubscribe_group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(UnsubscribeGroup $unsubscribe_group)
    {
        return view('layouts.backend.unsubscribeGroups.view',compact('unsubscribe_group'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnsubscribeGroup  $suppression_group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UnsubscribeGroup $unsubscribe_group)
    {
        $response = $this->UnsubscribeGroup->deleteUnsubscribeGroup($unsubscribe_group->sendgrid_id);
        if ($response == 1)
        {
            $unsubscribe_group->delete();
            return redirect()->route('dashboard.unsubscribe-group.index')->With('danger', 'suppression Group Deleted');
        }else{
            return redirect()->route('dashboard.bounce.index')->with('danger','Something is happened! with sendgrid configuration');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnsubscribeGroup  $groupId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateGroup(UnsubscribeGroup $groupId)
    {
        $this->UnsubscribeGroup->retrieveAllEmail($groupId);
        return back()->with('info','List Updated');

    }

    public function addEmailToSuppression()
    {
        $fxbxcf = $this->UnsubscribeGroup->addEmailToSuppression($groupId);
        return $fxbxcf;
    }

    public function deleteEmailFromUnsubscribeGroup(UnsubscribeGroupsEmail $emailInfo, $group_id)
    {
        $response = $this->UnsubscribeGroup->deleteEmailFromUnsubscribeGroup($emailInfo, $group_id);
        if ($response == 1)
        {
            $emailInfo->delete();
            return back()->With('danger', 'Email delete form this list');
        }else{
            return back()->With('danger', 'Something wrong with sendgrid configuration');
        }
    }
}
