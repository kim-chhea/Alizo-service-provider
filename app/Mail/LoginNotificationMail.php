<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class LoginNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $loginTime;
    public $ipAddress;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $ipAddress = null)
    {
        $this->user = $user;
        $this->loginTime = now()->format('F j, Y \a\t g:i A');
        $this->ipAddress = $ipAddress ?? request()->ip();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Login to Your Alizo Account',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.login-notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
