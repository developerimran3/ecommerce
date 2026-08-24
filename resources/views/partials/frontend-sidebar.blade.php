 <!-- Sidebar -->
 <div class="col-md-4">
     <div class="account-card profile-card">
         <div class="profile-header">
             <div class="avatar">
                 @if (Auth::user()->image)
                     <img src="{{ asset('storage/' . Auth::user()->image) }}">
                 @else
                     <i class="fa fa-user"></i>
                 @endif
             </div>
             <h4> {{ ucwords(auth()->user()->name) }} </h4>
             <p> {{ auth()->user()->email }} </p>
         </div>
         <ul class="account-menu">

             <li class="{{ request()->routeIs('account') ? 'active' : '' }}">
                 <a href="{{ route('account') }}" wire:navigate>
                     <i class="fa fa-dashboard"></i>
                     Dashboard
                 </a>
             </li>

             <li class="{{ request()->routeIs('my.orders') ? 'active' : '' }}">
                 <a href="{{ route('my.orders') }}" wire:navigate>
                     <i class="fa fa-shopping-bag"></i>
                     My Orders
                 </a>
             </li>

             <li class="{{ request()->routeIs('customer.profile') ? 'active' : '' }}">
                 <a href="{{ route('customer.profile') }}" wire:navigate>
                     <i class="fa fa-user"></i>
                     Profile
                 </a>
             </li>

             <li class="{{ request()->routeIs('customer.password') ? 'active' : '' }}">
                 <a href="{{ route('customer.password') }}" wire:navigate>
                     <i class="fa fa-lock"></i>
                     Change Password
                 </a>
             </li>

             <li>
                 <a href="{{ route('customer.logout') }}" wire:navigate class="logout-btn">
                     <i class="fa fa-sign-out"></i>
                     Logout
                 </a>
             </li>

         </ul>
     </div>
 </div>
