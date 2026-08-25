{{-- Table --}}
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="table-card p-4 bg-light">
            <!-- Filter Area -->
            <div class="row">
                {{-- Search --}}
                <div class="col-md-10 mb-3">
                </div>
                <div class="col-md-2 mb-3">
                    <input type="text" class="form-control" placeholder="🔍 Search coupon..." wire:model.live="search">
                </div>
            </div>
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="category-img-wrapper">
                                            @if ($customer->image)
                                                <img src="{{ asset('storage/' . $customer->image) }}"
                                                    class="category-img">
                                            @else
                                                <div class="category-placeholder">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-capitalize">
                                    {{ $customer->name }}
                                </td>
                                <td>
                                    <span class="text-muted">{{ $customer->email }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $customer->phone ?? 'N/A' }}</span>
                                </td>

                                <td>
                                    <span class=" badge-primary p-1 px-2">{{ $customer->role }}</span>
                                </td>
                                <td>
                                    @if ($customer->status)
                                        <span class="badge-success"> Active </span>
                                    @else
                                        <span class="badge-inactive"> Inactive </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $customer->created_at->format('d M Y') }}
                                </td>
                                <td>
                                    @if (auth()->user()->hasPermission('customers.view'))
                                        <a href="{{ route('admin.customer.view', $customer->id) }}"
                                            class="btn btn-sm btn-info" title="View Customer">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif

                                    @if (auth()->user()->hasPermission('customers.delete'))
                                        <button wire:click="delete({{ $customer->id }})"
                                            wire:confirm="Are you sure you want to delete this user?"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                    @if (auth()->user()->hasPermission('customers.delete'))
                                        <button wire:click="toggleStatus({{ $customer->id }})"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-power-off"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
