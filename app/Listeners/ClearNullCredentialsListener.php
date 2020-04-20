<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;
use App\Events\ClearNullCredentials;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearNullCredentialsListener
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
    public function handle(ClearNullCredentials $event)
    {
        $id = $event->getCredential();
        $query = DB::table('credentials')
            ->select('username', 'password')
            ->where('credentialable_id', $id)
            ->first();

        dd($query);

        if ($query->username == null && $query->password == null) {
            DB::table('credentials')
                ->where('id', $query->id)
                ->delete();
        }

    }
}
