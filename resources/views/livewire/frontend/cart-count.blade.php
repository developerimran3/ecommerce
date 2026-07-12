<a href="{{ route('cart') }}" wire:navigate class="btn btn-outline-primary position-relative">

    <i class="fa fa-shopping-cart"></i>

    Cart

    @if ($count > 0)
        <span class="badge badge-danger position-absolute"
            style="
                    top: -8px;
                    right: -8px;
                    min-width: 22px;
                    border-radius: 50%;
              ">

            {{ $count }}

        </span>
    @endif

</a>
