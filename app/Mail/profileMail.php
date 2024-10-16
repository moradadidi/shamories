<?php

namespace App\Mail;

use App\Models\Profile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class profileMail extends Mailable
{
    use Queueable, SerializesModels;

    private Profile $profile;

    /**
     * Create a new message instance.
     */
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Profile confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $date = $this->profile->created_at;
        $id = $this->profile->id;

        // Base64 encode the date and ID for the verification link
        $encodedData = base64_encode($date . '///' . $id);
        $href = url('/verify_email/' . $encodedData);

        return new Content(
            view: 'emails.inscription',
            with: [
                'name' => $this->profile->name,
                'email' => $this->profile->email,
                'href' => $href,
            ]
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
