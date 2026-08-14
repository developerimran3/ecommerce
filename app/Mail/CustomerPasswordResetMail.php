<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        $resetUrl = route('customer.reset.password', [
            'token' => $this->token,
            'email' => $this->user->email,
        ]);

        return $this
            ->subject('Reset Your Password - ' . config('app.name'))
            ->view('mail.customer.password-reset')
            ->with([
                'user' => $this->user,
                'resetUrl' => $resetUrl,
            ]);
    }
}
