 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>{{ $title ?? 'Dashboard' }}</title>
     <!-- Favicon -->
     <link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/png" />

     <!-- CSS -->
     <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
     <link rel="stylesheet" href="{{ asset('style.css') }}">
     <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
     <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
     <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
     <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.css') }}">
     <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
     <style>
         #toast-container>div {
             opacity: 1;
             border-radius: 10px;
             font-size: 14px;
             box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
         }
     </style>
     @livewireStyles
 </head>

 <body class="dashboard ">
     <div class="full_container">
         <div class="inner_container">
             <!-- Sidebar -->
             <nav id="sidebar">
                 <div class="sidebar_blog_1">
                     <div class="sidebar-header">
                         <div class="logo_section">
                             <a href="/">
                                 <img class="logo_icon img-responsive" src="{{ asset('images/logo/logo_icon.png') }}"
                                     alt="#">
                             </a>
                         </div>
                     </div>
                     <div class="sidebar_user_info">
                         <div class="user_profle_side">
                             <div class="user_img">
                                 <img class="img-responsive" src="{{ asset('images/layout_img/user_img.jpg') }}"
                                     alt="#">
                             </div>
                             <div class="user_info">
                                 <h6 style="text-transform: capitalize;">{{ auth()->user()->name ?? 'Imran' }}</h6>
                                 <p><span class="online_animation"></span> Online</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="sidebar_blog_2">
                     <h4>General</h4>
                     {{-- @livewire('layouts.menu') --}}
                 </div>
             </nav>
             <!-- End Sidebar -->

             <!-- Content -->
             <div id="content">
                 <!-- Topbar -->
                 <div class="topbar">
                     <nav class="navbar navbar-expand-lg navbar-light">
                         <div class="full">
                             <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                                     class="fa fa-bars"></i></button>
                             <div class="logo_section">
                                 <a href="/"><img class="img-responsive" src="images/logo/logo.png"
                                         alt="#" /></a>
                             </div>
                             <div class="right_topbar">
                                 <div class="icon_info">
                                     <ul>
                                         <li><a href="#"><i class="fa fa-bell-o"></i><span
                                                     class="badge">2</span></a></li>
                                         <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                         <li><a href="#"><i class="fa fa-envelope-o"></i><span
                                                     class="badge">3</span></a></li>
                                     </ul>
                                     <ul class="user_profile_dd">
                                         <li>
                                             <a class="dropdown-toggle" data-toggle="dropdown"><img
                                                     class="img-responsive rounded-circle"
                                                     src="images/layout_img/user_img.jpg" alt="#" /><span
                                                     class="name_user">imran</span></a>
                                             <div class="dropdown-menu">
                                                 <a class="dropdown-item" href="/profile">My Profile</a>
                                                 <a class="dropdown-item" href="?logout=success"><span>Log Out</span> <i
                                                         class="fa fa-sign-out"></i></a>
                                             </div>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </nav>
                 </div>
                 <!-- End Topbar -->

                 <!-- Page Content -->
                 <main class="container-fluid">
                     {{ $slot }}
                 </main>
                 <!-- Footer -->
                 <footer class="container-fluid">
                     <div class="footer">
                         <p>© {{ date('Y') }} Designed by MD IMRAN</p>
                     </div>
                 </footer>
             </div>
             <!-- End Content -->
         </div>
     </div>
     <!-- JS -->
     <script src="{{ asset('js/jquery.min.js') }}"></script>
     <script src="{{ asset('js/popper.min.js') }}"></script>
     <script src="{{ asset('js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
     <script>
         new PerfectScrollbar('#sidebar');
     </script>
     <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
     <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.7/datatables.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

     <script src="{{ asset('js/custom.js') }}"></script>

     {{-- TOASTR JS --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

     <script>
         document.addEventListener('livewire:init', () => {

             Livewire.on('toast', (data) => {

                 toastr.options = {
                     closeButton: true,
                     progressBar: true,
                     positionClass: "toast-top-right",
                     timeOut: 5000,
                 };

                 toastr[data.type](data.message);

             });

         });
     </script>

     @livewireScripts
     @stack('scripts')


 </body>

 </html>
