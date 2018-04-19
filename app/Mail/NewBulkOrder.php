<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewBulkOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $phone;
    public $message;
    public $event;
    public $eventDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $phone, $message,  $event, $eventDate)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->message = $message;
        $this->event = $event;
        $this->eventDate = $eventDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.bulk.new');
    }
}
