<?php

namespace App\Listeners;

use App\Events\ArticlePublished;
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
    public function handle(ArticlePublished $event): void
    {
        $user = Article::where('id', $event->article->id)->first()->user;
        
        $article = Article:: where('id',$event->article->id);
        if(!$article){
            Mail::to($user->email)->send(new NewRejettedNotification($event->article));
        }
    }
}
