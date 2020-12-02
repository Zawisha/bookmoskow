<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $newSendArr;
    public $email_token;


    /**
     * Create a new message instance.
     *
     * @param $newSendArr
     * @param $email_token
     */

    public function __construct($newSendArr, $email_token)
    {
        $this->newSendArr = $newSendArr;
        $this->email_token = $email_token;
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
            ->subject('Вы кое-что забыли')
            ->view('emails.welcome');
    }
}
