<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewMail extends Mailable
{
    use Queueable, SerializesModels;
    protected  $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order  =  $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('mail.sendMail',compact('order'));

        return  $this->from('noreply@deliveboo.com')

            ->view('mail.sendMail') // this is your email template in "view" directory

            ->with([

            'data1'  =>  $this->order,

            ]);
    }
}
