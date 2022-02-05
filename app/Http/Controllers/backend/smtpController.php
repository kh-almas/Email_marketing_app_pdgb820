<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Jobs\smtpJob;
use App\Mail\OrderShipped;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class smtpController extends Controller
{
    public function index()
    {
        $info = 'Almas';
        $user = Email::get();

        smtpJob::dispatch($user, $info);
        //Mail::to($user)->send(new OrderShipped($info));
//ProcessPodcast::dispatch($podcast);
//        if ($mail)
//        {
//            return 'check inbox';
//        }
        return 'check inbox job mail now';
    }
}
