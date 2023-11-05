<?php

namespace App\Listeners\User;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification as Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;
}
