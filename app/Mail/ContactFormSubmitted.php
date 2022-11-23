<?php

namespace App\Mail;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    protected $request;

    /**
     * ContactFormSubmitted constructor.
     *
     * @param  ContactFormRequest  $request
     */
    public function __construct(ContactFormRequest $request)
    {
    }

    /**
     * Build the message.
     *
     * @param  ContactFormRequest  $request
     * @return $this
     */
    public function build(ContactFormRequest $request): self
    {
        if ($request->has('url')) {
            $subject = 'ESCCOR New Content Indexing Request';
        } else {
            $subject = 'ESCCOR New Contact Information';
        }

        return $this
            ->markdown('emails.contact-submitted')
            ->subject($subject)
            ->with(['request' => $request]);
    }
}
