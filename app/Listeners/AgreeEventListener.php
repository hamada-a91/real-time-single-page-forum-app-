<?php

namespace App\Listeners;

use App\Events\AgreeEbent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AgreeEventListener
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
     * @param  AgreeEbent  $event
     * @return void
     */
    public function handle(AgreeEbent $event)
    {
        //
    }
}
