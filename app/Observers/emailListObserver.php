<?php

namespace App\Observers;

use App\Models\EmailList;
use Illuminate\Support\Facades\Session;

class emailListObserver
{
    /**
     * Handle the EmailList "created" event.
     *
     * @param  \App\Models\EmailList  $emailList
     * @return void
     */
    public function created(EmailList $emailList)
    {
        Session::put('abc', 'this ');
    }

    /**
     * Handle the EmailList "updated" event.
     *
     * @param  \App\Models\EmailList  $emailList
     * @return void
     */
    public function updated(EmailList $emailList)
    {
        //
    }

    /**
     * Handle the EmailList "deleted" event.
     *
     * @param  \App\Models\EmailList  $emailList
     * @return void
     */
    public function deleted(EmailList $emailList)
    {
        //
    }

    /**
     * Handle the EmailList "restored" event.
     *
     * @param  \App\Models\EmailList  $emailList
     * @return void
     */
    public function restored(EmailList $emailList)
    {
        //
    }

    /**
     * Handle the EmailList "force deleted" event.
     *
     * @param  \App\Models\EmailList  $emailList
     * @return void
     */
    public function forceDeleted(EmailList $emailList)
    {
        //
    }
}
