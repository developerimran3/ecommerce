<?php

namespace App\Livewire\Admin\SiteSetting;

use App\Models\SmtpSetting as SmtpSettingModel;
use Livewire\Component;

class SmtpSetting extends Component
{
    public $name = 'smtp';
    public $host;
    public $port = 587;
    public $username;
    public $password;
    public $encryption = 'tls';
    public $from_email;
    public $from_name;

    public function mount()
    {
        $smtp = SmtpSettingModel::first();

        if ($smtp) {
            $this->name = $smtp->name;
            $this->host = $smtp->host;
            $this->port = $smtp->port;
            $this->username = $smtp->username;
            $this->password = $smtp->password;
            $this->encryption = $smtp->encryption;
            $this->from_email = $smtp->from_email;
            $this->from_name = $smtp->from_name;
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'host' => 'required|string|max:255',
            'port' => 'required|integer|min:1|max:65535',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:500',
            'encryption' => 'nullable|in:tls,ssl',
            'from_email' => 'required|email|max:255',
            'from_name' => 'required|string|max:255',
        ];
    }

    public function save()
    {
        $this->validate();

        $smtp = SmtpSettingModel::first();

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        if ($smtp) {

            $smtp->update([
                'name' => $this->name,
                'host' => $this->host,
                'port' => $this->port,
                'username' => $this->username,
                'password' => $this->password,
                'encryption' => $this->encryption,
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'status' => true,
            ]);

            $message = 'SMTP settings updated successfully.';
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE
        |--------------------------------------------------------------------------
        */ else {

            SmtpSettingModel::create([
                'name' => $this->name,
                'host' => $this->host,
                'port' => $this->port,
                'username' => $this->username,
                'password' => $this->password,
                'encryption' => $this->encryption,
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'status' => true,
            ]);

            $message = 'SMTP settings created successfully.';
        }

        $this->dispatch(
            'success',
            message: $message
        );
    }

    public function render()
    {
        return view('livewire.admin.site-setting.smtp-setting')
            ->layout('layouts.admin');
    }
}
