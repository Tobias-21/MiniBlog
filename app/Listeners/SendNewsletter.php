<?php

namespace App\Listeners;

use App\Events\ArticlePublished;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewArticleNotification;

class SendNewsletter
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
        $users = User::where('status', 'abonné')->get();
        foreach ($users as $subscriber) {
            // Logic to send email to $user about the new article
            Mail::to($subscriber->email)->send(new NewArticleNotification($event->article));
        }

    }
}
