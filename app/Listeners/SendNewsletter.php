<?php

namespace App\Listeners;

use App\Events\ArticlePublished;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewArticleNotification;
use App\Mail\NewValidatedNotification;

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
        $owner = User::find($event->article->user_id);
        if ($owner) {
            Mail::to($owner->email)->send(new NewValidatedNotification($event->article));
        }

        $users = User::where('status', 'abonné')->where('id', '!=', $owner->id)->where('role', '!=', 'admin')->get();
        foreach ($users as $subscriber) {
           
                // Logic to send email to $user about the new article
                Mail::to($subscriber->email)->send(new NewArticleNotification($event->article));
        }

    }
}
