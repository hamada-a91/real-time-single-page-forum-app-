<?php

namespace App\Listeners;

use App\Events\DisagreeEbent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DisagreeEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DisagreeEbent  $event
     * @return void
     */
    public function handle(DisagreeEbent $event)
    {
        //
    }
}
