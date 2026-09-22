<?php

namespace App\Services;

use App\Models\SmtpSetting;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class MailConfigService
{
    /**
     * Get active SMTP settings.
     */
    public function getSettings(): ?SmtpSetting
    {
        return SmtpSetting::where('status', true)->first();
    }

    /**
     * Configure Laravel Mail from database.
     */
    public function configure(): bool
    {
        $smtp = $this->getSettings();

        if (!$smtp) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Normalize Encryption
        |--------------------------------------------------------------------------
        */

        $encryption = $smtp->encryption;

        if ($encryption) {
            $encryption = strtolower(trim($encryption));

            if ($encryption === 'ssl/tls') {
                $encryption = 'tls';
            }

            if ($encryption === 'none') {
                $encryption = null;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Configure SMTP
        |--------------------------------------------------------------------------
        */

        Config::set('mail.default', 'smtp');

        Config::set(
            'mail.mailers.smtp.transport',
            'smtp'
        );

        Config::set(
            'mail.mailers.smtp.host',
            trim($smtp->host)
        );

        Config::set(
            'mail.mailers.smtp.port',
            (int) $smtp->port
        );

        Config::set(
            'mail.mailers.smtp.username',
            trim($smtp->username)
        );

        Config::set(
            'mail.mailers.smtp.password',
            $smtp->password
        );

        Config::set(
            'mail.mailers.smtp.encryption',
            $encryption
        );

        Config::set(
            'mail.from.address',
            trim($smtp->from_email)
        );

        Config::set(
            'mail.from.name',
            $smtp->from_name
        );

        /*
        |--------------------------------------------------------------------------
        | Purge Existing SMTP Mailer
        |--------------------------------------------------------------------------
        */

        app('mail.manager')->purge('smtp');

        return true;
    }

    /**
     * Send mail using database SMTP.
     */
    public function send(
        string $email,
        Mailable $mailable
    ): void {

        if (!$this->configure()) {
            throw new \Exception(
                'Active SMTP settings are not configured.'
            );
        }

        Mail::to($email)->send($mailable);
    }
}
