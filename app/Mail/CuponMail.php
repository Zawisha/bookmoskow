<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CuponMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email_token;
    public $user_email;

    /**
     * Create a new message instance.
     *
     * @param $variable
     */
    public function __construct($email_token, $user_email)
    {
        $this->email_token = $email_token;
        $this->user_email = $user_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('unidev@okmos.ru', 'Books Moscow')
            ->subject('Ваш купон')
            ->view('emails.cupon');
    }
}
