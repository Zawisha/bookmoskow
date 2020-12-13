<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

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
            ->subject('Test pis')
            ->view('emails.welcome');
//        Mail::to('antonmartsinkevich@gmail.com')
//            ->queue(new WelcomeMail($this->newSendArr, $this->email_token))
//            ->subject('TEST')
//            ->view('emails.welcome');
//        return $this
//            ->from('unidev@okmos.ru', 'Books Moscow')
//            ->subject('Вы кое-что забыли')
//            -to('antonmartsinkevich@gmail.com')
//            ->view('emails.welcome');
    }
}
