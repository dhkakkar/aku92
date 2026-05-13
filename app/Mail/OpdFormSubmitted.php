<?php

namespace App\Mail;

use App\Models\OpdForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OpdFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public OpdForm $opdForm)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New OPD Booking — ' . $this->opdForm->patient_name,
            replyTo: [],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.opd-form',
            with: ['opd' => $this->opdForm],
        );
    }
}
