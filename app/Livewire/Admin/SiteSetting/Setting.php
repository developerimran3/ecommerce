<?php

namespace App\Livewire\Admin\SiteSetting;

use App\Models\Setting as SiteSetting;
use Illuminate\Support\Facades\Storage;

use Livewire\WithFileUploads;
use Livewire\Component;

class Setting extends Component
{

    use WithFileUploads;
    public $setting;
    public $title;
    public $sub_title;
    public $white_logo;
    public $dark_logo;
    public $favicon;
    public $oldWhiteLogo;
    public $oldDarkLogo;
    public $oldFavicon;
    public $phone;
    public $email;
    public $address;

    /** * Load existing settings */

    public function mount()
    {
        $this->setting = SiteSetting::first();

        if ($this->setting) {
            $this->title = $this->setting->title;
            $this->sub_title = $this->setting->sub_title;
            $this->phone = $this->setting->phone;
            $this->email = $this->setting->email;
            $this->address = $this->setting->address;
            $this->oldWhiteLogo = $this->setting->white_logo;
            $this->oldDarkLogo = $this->setting->dark_logo;
            $this->oldFavicon = $this->setting->favicon;
        }
    }
    /** * Validation */
    protected function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'sub_title' => ['nullable', 'string', 'max:255'],
            'white_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:5120',],
            'dark_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:5120',],
            'favicon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,ico', 'max:2048',],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
        ];
    }


    public function save()
    {
        $this->validate();
        /* || Find existing setting |*/
        $setting = SiteSetting::first();
        /* || Upload White Logo |*/
        $whiteLogoPath = $setting?->white_logo;
        if ($this->white_logo) {
            if ($whiteLogoPath && Storage::disk('public')->exists($whiteLogoPath)) {
                Storage::disk('public')->delete($whiteLogoPath);
            }
            $whiteLogoPath = $this->white_logo->store('settings', 'public');
        } /* || Upload Dark Logo |*/

        $darkLogoPath = $setting?->dark_logo;
        if ($this->dark_logo) {
            if ($darkLogoPath && Storage::disk('public')->exists($darkLogoPath)) {
                Storage::disk('public')->delete($darkLogoPath);
            }
            $darkLogoPath = $this->dark_logo->store('settings', 'public');
        } /* || Upload Favicon |*/
        $faviconPath = $setting?->favicon;
        if ($this->favicon) {
            if ($faviconPath && Storage::disk('public')->exists($faviconPath)) {
                Storage::disk('public')->delete($faviconPath);
            }
            $faviconPath = $this->favicon->store('settings', 'public');
        } /* || Data |*/
        $data = [
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'white_logo' => $whiteLogoPath,
            'dark_logo' => $darkLogoPath,
            'favicon' => $faviconPath,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ];
        /* || Create ONLY ONCE / Update Existing |*/
        if ($setting) {
            $setting->update($data);
        } else {
            $setting = SiteSetting::create($data);
        }
        /* || Update local state |*/
        $this->setting = $setting;
        $this->oldWhiteLogo = $setting->white_logo;
        $this->oldDarkLogo = $setting->dark_logo;
        $this->oldFavicon = $setting->favicon;
        $this->white_logo = null;
        $this->dark_logo = null;
        $this->favicon = null;
        $this->dispatch('success', message: 'Site settings saved successfully.');
    }

    public function render()
    {
        return view('livewire.admin.site-setting.setting')
            ->layout('layouts.admin');
    }
}
