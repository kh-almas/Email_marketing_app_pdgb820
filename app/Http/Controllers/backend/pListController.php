<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PList;
use Illuminate\Http\Request;

class pListController extends Controller
{
    public function index()
    {
        $number_list = PList::latest()->paginate('20');
        return view('layouts.backend.sms_call.p_list.index', compact('number_list'));
    }

    public function create()
    {
        return view('layouts.backend.sms_call.p_list.create');
    }

    public function store(Request $request)
    {
        PList::create([
            'name' => $request->name,
        ]);
        return redirect()->route('dashboard.group.index')->with('success','New list created');
    }

    public function edit(PList $group)
    {
        return view('layouts.backend.sms_call.p_list.edit', compact('group'));
    }

    public function update(Request $request, PList $group)
    {
        $group->update([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.group.index')->with('info','Group Updated');
    }

    public function destroy(PList $group)
    {
        $group->number()->detach();
        $group->delete();
        return redirect()->route('dashboard.group.index')->With('danger', 'Group Deleted');
    }
}
