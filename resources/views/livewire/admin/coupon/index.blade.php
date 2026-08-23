<div>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1"> Coupons </h4>
                <p class="text-muted mb-0"> Manage discount coupons </p>
            </div>
            <button wire:click="create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Coupon </button>
        </div>
        {{-- Search --}}
        <div class="card mb-3">
            <div class="card-body">
                <input type="text" class="form-control" placeholder="Search coupon..." wire:model.live="search">
            </div>
        </div>

        {{-- Table --}}
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Discount</th>
                                <th>Minimum</th>
                                <th>Validity</th>
                                <th>Usage</th>
                                <th>Status</th>
                                <th width="130"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $coupon)
                                <tr>
                                    <td> {{ $coupons->firstItem() + $loop->index }} </td>
                                    <td> <strong> {{ $coupon->code }} </strong> </td>
                                    <td>
                                        @if ($coupon->type === 'fixed')
                                            Fixed
                                        @else
                                            Percentage
                                        @endif
                                    </td>
                                    <td>
                                        @if ($coupon->type === 'fixed')
                                            ৳ {{ number_format($coupon->value, 2) }}
                                        @else
                                            {{ number_format($coupon->value, 2) }}%
                                        @endif
                                    </td>
                                    <td> ৳ {{ number_format($coupon->minimum_amount, 2) }} </td>
                                    <td>
                                        {{ $coupon->start_date->format('d M Y') }}
                                        <br>
                                        <small class="text-muted"> to
                                            {{ $coupon->end_date->format('d M Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        {{ $coupon->used }}
                                        /
                                        {{ $coupon->limit ?? '∞' }}
                                    </td>
                                    <td>
                                        @if ($coupon->status)
                                            <span class="badge badge-success"> Active </span>
                                        @else
                                            <span class="badge badge-secondary"> Inactive </span>
                                        @endif
                                    </td>
                                    <td>
                                        <button wire:click="edit({{ $coupon->id }})" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="toggleStatus({{ $coupon->id }})"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-power-off"></i>
                                        </button>

                                        <button wire:click="delete({{ $coupon->id }})"
                                            wire:confirm="Are you sure you want to delete this coupon?"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        No coupons found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3">
            {{ $coupons->links() }}
        </div>
    </div>

    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="couponModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $couponId ? 'Edit Coupon' : 'Add Coupon' }}
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        {{-- Code --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Coupon Code </label>
                                <input type="text" class="form-control" wire:model="code" placeholder="SUMMER100">
                                @error('code')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                        </div>
                        {{-- Type --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Discount Type </label>
                                <select class="form-control" wire:model="type">
                                    <option value="fixed"> Fixed Amount </option>
                                    <option value="percent"> Percentage </option>
                                </select>
                            </div>
                        </div>
                        {{-- Value --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Discount Value </label>
                                <input type="number" step="0.01" class="form-control" wire:model="value">
                                @error('value')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                        </div>
                        {{-- Minimum --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Minimum Order Amount </label>
                                <input type="number" step="0.01" class="form-control" wire:model="minimum_amount">
                            </div>
                        </div>
                        {{-- Start Date --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Start Date </label>
                                <input type="date" class="form-control" wire:model="start_date">
                            </div>
                        </div>
                        {{-- End Date --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> End Date </label>
                                <input type="date" class="form-control" wire:model="end_date">
                            </div>
                        </div>
                        {{-- Limit --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Usage Limit </label>
                                <input type="number" class="form-control" wire:model="limit"
                                    placeholder="Leave empty for unlimited">
                            </div>
                        </div>
                        {{-- Status --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Status </label>
                                <select class="form-control" wire:model="status">
                                    <option value="1"> Active </option>
                                    <option value="0"> Inactive </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>

                    @if ($couponId)
                        <button wire:click="update" class="btn btn-primary"> Update Coupon </button>
                    @else
                        <button wire:click="store" class="btn btn-primary"> Save Coupon </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
