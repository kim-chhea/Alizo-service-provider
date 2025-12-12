<?php

namespace App\Services\Mail;

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Mail\LoginNotificationMail;

class Gmail
{
    /**
     * Send welcome email after user registration
     * 
     * @param \App\Models\User $user
     * @return void
     */
    public function sendWelcomeEmail($user)
    {
        Mail::to($user->email)->send(new WelcomeMail($user));
    }

    /**
     * Send login notification email
     * 
     * @param \App\Models\User $user
     * @return void
     */
    public function sendLoginNotification($user)
    {
        Mail::to($user->email)->send(new LoginNotificationMail($user));
    }
}
