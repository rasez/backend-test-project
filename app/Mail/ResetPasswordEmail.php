<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    public $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($token, $request)
    {
        $this->token = $token;
        $this->request = $request;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@ucarft.com')
            ->subject('Reset Password Notification')
            ->view('emails.verify');
    }
}
