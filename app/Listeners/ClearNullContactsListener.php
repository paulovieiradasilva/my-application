<?php

namespace App\Listeners;

use App\Events\ClearNullContacts;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearNullContactsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ClearNullContacts $event)
    {
        $id = $event->getContacts();
        $query = DB::table('contacts')->select('id', 'email', 'phone', 'cellphone', 'site')->where('contactable_id', $id)->first();

        if ($query->email == null && $query->phone == null && $query->cellphone == null && $query->site == null) {
            DB::table('contacts')->where('id', $query->id)->delete();
        }

    }
}
