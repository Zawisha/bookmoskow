<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $collection;
    protected $email_token;
    protected $queueVar;

    public function __construct($collection, $email_token, $queueVar)
    {
        $this->collection = $collection;
        $this->email_token = $email_token;
        $this->queueVar = $queueVar;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new WelcomeMail($this->collection, $this->email_token, $this->queueVar );
        $sendMail =  $this ->  collection[0] -> sendArr[0] -> user_email;
//        $sendMail =  $this ->  queueVar;

        Mail::to ($sendMail)
            ->send($email);
        Mail::to ('unidev1@okmos.ru')
            ->send($email);
//        Mail::to('antonmartsinkevich@gmail.com')
//            -> send(new WelcomeMail($this->collection));

    }
}
