<?php

namespace App\Listeners\User;

use App\Events\User\UserRegisteredEvent;
use App\Mail\User\VerifyEmailMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerifyEmailListener implements ShouldQueue
{
    use InteractsWithQueue;

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
    public function handle(UserRegisteredEvent $event): void
    {
        $mail = new VerifyEmailMail($event->user);
        Mail::to($event->user->email)->send($mail);
    }
}
