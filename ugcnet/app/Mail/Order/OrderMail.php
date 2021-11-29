<?php

namespace App\Mail\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        //
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('order-email-template');
        return $this->from('sender@example.com')
                    ->view('mail.order-email-template');
                    //->text('mails.demo_plain')
                    // ->with(
                    //   [
                    //         'testVarOne' => '1',
                    //         'testVarTwo' => '2',
                    //   ]);
    }
}
