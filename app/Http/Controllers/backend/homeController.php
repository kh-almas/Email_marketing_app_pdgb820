<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\DashbordState;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function dashboard()
    {
        $data = DashbordState::where('range', 'monthly')->first();
        return view('dashboard',compact('data'));
    }
}
