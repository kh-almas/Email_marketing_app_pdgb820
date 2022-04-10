<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PhoneNumber;
use App\Models\PList;
use Illuminate\Http\Request;

class pNumberController extends Controller
{
    public function index()
    {
        $numbers = PhoneNumber::latest()->paginate('20');
        return view('layouts.backend.sms_call.p_number.index', compact('numbers'));
    }

    public function create()
    {
        $number_list = PList::latest()->get();
        return view('layouts.backend.sms_call.p_number.create', compact('number_list'));
    }

    public function store(Request $request)
    {
        $for_relation = PhoneNumber::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
        ]);

        $for_relation->list()->attach($request->list);
        return redirect()->route('dashboard.phone_number.index')->with('success','Contact Stored');
    }

    public function edit(PhoneNumber $info)
    {
        $number_list = PList::latest()->get();
        return view('layouts.backend.sms_call.p_number.edit', compact('info','number_list'));
    }

    public function update(Request $request, PhoneNumber $info)
    {
        $info->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
        ]);
        $info->list()->sync($request->list);

        return redirect()->route('dashboard.phone_number.index')->with('info','Contact Updated');
    }

    public function destroy(PhoneNumber $info)
    {
        $info->list()->detach();
        $info->delete();
        return redirect()->route('dashboard.phone_number.index')->With('danger', 'Contact Deleted');
    }
}
