<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order = [];
    public $user = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $user)
    {


        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        $orders = $this->order;
        $user = $this->user;
        $pdf = \Barryvdh\DomPDF\Facade::loadview('emails.customer.order', compact('orders', 'user'));
       
        return $this->markdown('emails.customer.ordermail')
            ->attachData($pdf->output(), 'yourOrder.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
