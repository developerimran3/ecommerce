<div class="my-account-page">
    <div class="container py-5">
        <div class="row">
            {{-- Sidebar --}}
            @include('partials.frontend-sidebar')
            {{-- Profile Content --}}
            <div class="col-md-8">
                <div class="account-card">
                    <div class="profile-title">
                        <h4> My Profile </h4>
                        <p> Update your account information </p>
                    </div>

                    <form wire:submit.prevent="updateProfile">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Full Name </label>
                                    <input type="text" class="form-control text-capitalize" wire:model="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Email Address </label>
                                    <input type="email" class="form-control" wire:model="email" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Phone Number </label>
                                    <input type="text" class="form-control" wire:model="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input type="file" class="form-control" wire:model="image">
                                    @error('image')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Address
                                    </label>
                                    <textarea class="form-control ext-capitalize" wire:model="address" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <button class="profile-save-btn">
                            <i class="fa fa-save"></i>
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
