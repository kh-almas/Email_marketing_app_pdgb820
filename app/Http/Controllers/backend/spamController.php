<?php

namespace App\Http\Controllers\backend;

use App\Actions\SendGrid\Spam_Reporte;
use App\Http\Controllers\Controller;
use App\Models\Spam;
use Illuminate\Http\Request;

class spamController extends Controller
{

    private $spamReporte;

    public function __construct(Spam_Reporte $spamReporte)
    {
        $this->spamReporte = $spamReporte;
    }

    public function index()
    {
        $spams = Spam::latest()->paginate('15');
        return view('layouts.backend.spam.index',compact('spams'));
    }

    public function updateSpamList()
    {
        $response = $this->spamReporte->updateSpamList();
        return $response;
    }

    public function destroy(Spam $spam)
    {
        $response = $this->spamReporte->deleteSpam($spam->email);
        return $response;
    }
}
