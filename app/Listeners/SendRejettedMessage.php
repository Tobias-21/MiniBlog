<?php

namespace App\Listeners;

use App\Events\ArticleRejetted;
use App\Mail\NewRejettedNotification;
use App\Models\Article;
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
    public function handle(ArticleRejetted $event): void
    {
        $article = $event->article;

        Mail::to($article->user->email)->send(new NewRejettedNotification($article));
        
    }
}
