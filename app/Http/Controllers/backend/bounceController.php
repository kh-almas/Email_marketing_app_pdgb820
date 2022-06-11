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
        $this->bounces->updateList();
        return redirect()->route('dashboard.bounce.index')->with('success','List updated');
    }

    public function index()
    {
        $bounces = Bounce::latest()->paginate('20s');
        return view('layouts.backend.bounce.index',compact('bounces'));
    }

    public function show(Bounce $bounce)
    {
        return view('layouts.backend.bounce.view',compact('bounce'));
    }

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
