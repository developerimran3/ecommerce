<?php

namespace App\Livewire\Admin\SiteSetting;

use App\Models\CourierSetting as CourierSettingModel;
use Livewire\Component;

class CourierSetting extends Component
{

    public $courierId = null;
    public $courier_name;
    public $base_url;
    public $api_url;
    public $api_key;
    public $secret_key;
    public $username;
    public $password;
    public $account_id;
    public $store_id;
    public $sandbox = false;
    public $status = true;


    protected function rules()
    {
        return [
            'courier_name' => [
                'required',
                'string',
                'max:100',
                'unique:courier_settings,courier_name,' . $this->courierId,
            ],

            'base_url' => [
                'nullable',
                'url',
                'max:500',
            ],

            'api_url' => [
                'nullable',
                'url',
                'max:500',
            ],

            'api_key' => [
                'nullable',
                'string',
                'max:500',
            ],

            'secret_key' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'username' => [
                'nullable',
                'string',
                'max:255',
            ],

            'password' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'account_id' => [
                'nullable',
                'string',
                'max:255',
            ],

            'store_id' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sandbox' => [
                'boolean',
            ],

            'status' => [
                'boolean',
            ],
        ];
    }

    public function create()
    {
        $this->resetForm();
        $this->dispatch('open-modal');
    }



    //Save Courier
    public function save()
    {

        abort_unless(
            auth()->user()->hasPermission('couriers.create'),
            403
        );

        $this->validate();

        //UPDATE
        if ($this->courierId) {
            $courier = CourierSettingModel::findOrFail(
                $this->courierId
            );
            $courier->update([
                'courier_name' => $this->courier_name,
                'base_url' => $this->base_url,
                'api_url' => $this->api_url,
                'api_key' => $this->api_key,
                'secret_key' => $this->secret_key,
                'username' => $this->username,
                'password' => $this->password,
                'account_id' => $this->account_id,
                'store_id' => $this->store_id,
                'sandbox' => $this->sandbox,
                'status' => $this->status,
            ]);
            $this->dispatch('close-modal');
            $message = 'Courier updated successfully.';
        }
        // | CREATE

        else {
            CourierSettingModel::create([
                'courier_name' => $this->courier_name,
                'base_url' => $this->base_url,
                'api_url' => $this->api_url,
                'api_key' => $this->api_key,
                'secret_key' => $this->secret_key,
                'username' => $this->username,
                'password' => $this->password,
                'account_id' => $this->account_id,
                'store_id' => $this->store_id,
                'sandbox' => $this->sandbox,
                'status' => $this->status,
            ]);

            $this->dispatch('close-modal');
            $message = 'Courier created successfully.';
        }
        $this->resetForm();
        $this->dispatch(
            'success',
            message: $message
        );
    }

    //Open Edit 
    public function edit($id)
    {
        abort_unless(
            auth()->user()->hasPermission('couriers.edit'),
            403
        );

        $courier = CourierSettingModel::findOrFail($id);
        $this->courierId = $courier->id;
        $this->courier_name = $courier->courier_name;
        $this->base_url = $courier->base_url;
        $this->api_url = $courier->api_url;
        $this->api_key = $courier->api_key;
        $this->secret_key = $courier->secret_key;
        $this->username = $courier->username;
        $this->password = $courier->password;
        $this->account_id = $courier->account_id;
        $this->store_id = $courier->store_id;
        $this->sandbox = $courier->sandbox;
        $this->status = $courier->status;
        $this->dispatch('open-modal');
    }


    // Delete Courier

    public function delete($id)
    {
        abort_unless(
            auth()->user()->hasPermission('couriers.delete'),
            403
        );

        $courier = CourierSettingModel::findOrFail($id);
        $courier->delete();
        $this->dispatch(
            'success',
            message: 'Courier deleted successfully.'
        );
    }


    public function toggleStatus($id)
    {
        abort_unless(
            auth()->user()->hasPermission('couriers.status'),
            403
        );

        $courier = CourierSettingModel::findOrFail($id);
        $courier->update([
            'status' => !$courier->status,
        ]);
        $this->dispatch(
            'success',
            message: 'courier status updated.'
        );
    }

    // Reset Form
    public function resetForm()
    {
        $this->courierId = null;
        $this->courier_name = '';
        $this->base_url = '';
        $this->api_url = '';
        $this->api_key = '';
        $this->secret_key = '';
        $this->username = '';
        $this->password = '';
        $this->account_id = '';
        $this->store_id = '';
        $this->sandbox = false;
        $this->status = true;
    }
    //Render
    public function render()
    {
        $couriers = CourierSettingModel::latest()->get();
        return view(
            'livewire.admin.site-setting.courier-setting',
            compact('couriers')
        )->layout('layouts.admin');
    }
}
