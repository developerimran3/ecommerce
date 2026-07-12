<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <a class="navbar-brand" href="#">
        Admin Panel
    </a>

    <div class="ml-auto">

        <div class="dropdown">

            <button class="btn btn-light dropdown-toggle" data-toggle="dropdown">

                {{ auth()->user()->name ?? 'Admin' }}

            </button>

            <div class="dropdown-menu dropdown-menu-right">

                <a href="#" class="dropdown-item">
                    Profile
                </a>

                <a href="#" class="dropdown-item">
                    Logout
                </a>

            </div>

        </div>

    </div>

</nav>
