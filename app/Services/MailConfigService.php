<?php

namespace App\Services;

use App\Models\SmtpSetting;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class MailConfigService
{
    /**
     * Get SMTP settings
     */
    public function getSettings(): ?SmtpSetting
    {
        return SmtpSetting::first();
    }

    /**
     * Configure Laravel Mail from database
     */
    public function configure(): bool
    {
        $smtp = $this->getSettings();

        if (!$smtp) {
            return false;
        }

        Config::set('mail.default', 'smtp');

        Config::set(
            'mail.mailers.smtp.host',
            $smtp->host
        );

        Config::set(
            'mail.mailers.smtp.port',
            $smtp->port
        );

        Config::set(
            'mail.mailers.smtp.username',
            $smtp->username
        );

        Config::set(
            'mail.mailers.smtp.password',
            $smtp->password
        );

        Config::set(
            'mail.mailers.smtp.encryption',
            $smtp->encryption
        );

        Config::set(
            'mail.from.address',
            $smtp->from_email
        );

        Config::set(
            'mail.from.name',
            $smtp->from_name
        );

        return true;
    }

    /**
     * Send mail using database SMTP
     */
    public function send(
        string $email,
        Mailable $mailable
    ): void {

        if (!$this->configure()) {
            throw new \Exception(
                'SMTP settings are not configured.'
            );
        }

        Mail::to($email)->send($mailable);
    }
}
