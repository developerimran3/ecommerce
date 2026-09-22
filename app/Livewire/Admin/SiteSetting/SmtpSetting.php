<?php

namespace App\Livewire\Admin\SiteSetting;

use App\Models\SmtpSetting as SmtpSettingModel;
use Livewire\Component;

class SmtpSetting extends Component
{
    public $name = 'smtp';

    public $host = 'mail.developerimran.com';

    public $port = 465;

    public $username = 'info@developerimran.com';

    public $password = '';

    public $encryption = 'ssl';

    public $from_email = 'info@developerimran.com';

    public $from_name = 'Rongini Shop';

    /**
     * Load SMTP settings.
     */
    public function mount()
    {
        $smtp = SmtpSettingModel::first();

        if ($smtp) {
            $this->name = $smtp->name;

            $this->host = $smtp->host;

            $this->port = $smtp->port;

            $this->username = $smtp->username;

            /*
            |--------------------------------------------------------------------------
            | Do NOT load decrypted password into Livewire
            |--------------------------------------------------------------------------
            */

            $this->password = '';

            $this->encryption = $smtp->encryption;

            $this->from_email = $smtp->from_email;

            $this->from_name = $smtp->from_name;
        }
    }

    /**
     * Validation rules.
     */
    protected function rules()
    {
        $smtp = SmtpSettingModel::first();

        return [
            'name' => 'required|string|max:100',

            'host' => 'required|string|max:255',

            'port' => 'required|integer|min:1|max:65535',

            'username' => 'required|email|max:255',

            /*
            |--------------------------------------------------------------------------
            | Password
            |--------------------------------------------------------------------------
            */

            'password' => $smtp
                ? 'nullable|string|max:500'
                : 'required|string|max:500',

            'encryption' => 'nullable|in:tls,ssl',

            'from_email' => 'required|email|max:255',

            'from_name' => 'required|string|max:255',
        ];
    }

    /**
     * Save SMTP settings.
     */
    public function save()
    {
        abort_unless(
            auth()->user()->hasPermission('smtp.create'),
            403
        );

        $this->validate();

        $smtp = SmtpSettingModel::first();

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        if ($smtp) {

            $data = [
                'name' => $this->name,

                'host' => trim($this->host),

                'port' => (int) $this->port,

                'username' => trim($this->username),

                'encryption' => $this->encryption,

                'from_email' => trim($this->from_email),

                'from_name' => $this->from_name,

                'status' => true,
            ];

            /*
            |--------------------------------------------------------------------------
            | Update password only if entered
            |--------------------------------------------------------------------------
            */

            if (filled($this->password)) {
                $data['password'] = $this->password;
            }

            $smtp->update($data);

            $message = 'SMTP settings updated successfully.';
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE
        |--------------------------------------------------------------------------
        */ else {

            SmtpSettingModel::create([
                'name' => $this->name,

                'host' => trim($this->host),

                'port' => (int) $this->port,

                'username' => trim($this->username),

                'password' => $this->password,

                'encryption' => $this->encryption,

                'from_email' => trim($this->from_email),

                'from_name' => $this->from_name,

                'status' => true,
            ]);

            $message = 'SMTP settings created successfully.';
        }

        /*
        |--------------------------------------------------------------------------
        | Clear password field
        |--------------------------------------------------------------------------
        */

        $this->password = '';

        $this->dispatch(
            'success',
            message: $message
        );
    }

    /**
     * Render.
     */
    public function render()
    {
        return view('livewire.admin.site-setting.smtp-setting')
            ->layout('layouts.admin');
    }
}
