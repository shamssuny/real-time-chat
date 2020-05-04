<?php

namespace App\Listeners;

use App\Events\ChatSend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChatListener
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
     * @param  ChatSend  $event
     * @return void
     */
    public function handle(ChatSend $event)
    {
        //
    }
}
