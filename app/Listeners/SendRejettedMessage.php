<?php

namespace App\Listeners;

use App\Events\PublicationRejetted;
use App\Mail\NewRejettedNotification;
use App\Models\Publication;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRejettedMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PublicationRejetted $event): void
    {
        $publication = $event->publication;

        Mail::to($publication->user->email)->send(new NewRejettedNotification($publication));
        
    }
}
