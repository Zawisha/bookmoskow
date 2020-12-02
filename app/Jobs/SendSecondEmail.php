<?php

namespace App\Jobs;

use App\Mail\SecondMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSecondEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $collection;
    protected $email_token;

    public function __construct($collection, $email_token)
    {
        $this->collection = $collection;
        $this->email_token = $email_token;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SecondMail($this->collection, $this->email_token );
        $sendMail =  $this ->  collection[0] -> sendArr[0] -> user_email;
        Mail::to ($sendMail)
            ->send($email);
    }
}
