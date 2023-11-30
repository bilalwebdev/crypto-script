 <!-- Nav header start -->
 <div class="nav-header">
     <a href="{{route('admin.home')}}" class="brand-logo">
         <img class="brand-title" src="{{ Config::fetchImage('logo', Config::config()->logo, true) }}" alt="">
     </a>
     <div class="nav-control">
         <div class="hamburger">
             <span class="line"></span><span class="line"></span><span class="line"></span>
         </div>
     </div>
 </div>
 <!-- Nav header end -->

 <!-- Header start -->
 <div class="header">
     <div class="header-content">
         <nav class="navbar navbar-expand">
             <div class="collapse navbar-collapse justify-content-between">
                 <div class="header-left">
                    <button type="button" class="sidebar-open">
                         <span class="line"></span>
                     </button>
                     <a href="{{ route('admin.home') }}" class="mobile-brand-logo">
                         <img class="brand-title" src="{{ Config::fetchImage('icon', Config::config()->favicon, true) }}" alt="">
                     </a>
                     <div class="header-search d-lg-block d-none">
                        <button type="button" class="header-search-res-btn">
                            <i data-feather="search"></i>
                        </button>
                         <div class="form">
                             <input class="form-control searchNav" type="text" placeholder="Search" aria-label="Search">
                             <ul class="search-item">

                             </ul>
                             <button type="search"><i class="las la-search"></i></button>
                         </div>
                     </div>
                 </div>

                 <ul class="navbar-nav header-right">
                     <li class="nav-item d-md-flex d-none">
                         <a href="{{ route('home') }}"
                             class="btn btn-primary btn-sm" target="_blank">{{ __('Visit Frontend') }}</a>
                     </li>
                     <li class="nav-item header-lang">
                         <select class="form-control selectric changeLang">
                             @foreach (Config::languages() as $top)
                                 <option value="{{ $top->code }}"
                                     {{ Config::languageSelection($top->code)}}>
                                     {{ __(ucwords($top->name)) }}
                                 </option>
                             @endforeach
                         </select>
                     </li>
                     <li class="nav-item dropdown notification_dropdown">
                         <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                             <i data-feather="bell"></i>
                             @if (Config::notifications()->count() > 0)
                                 <div class="pulse-css"></div>
                             @endif
                         </a>
                         <div class="dropdown-menu dropdown-menu-right">
                             <ul class="list-unstyled">
                                 @forelse (Config::notifications() as $notification)
                                     <li class="media dropdown-item">
                                         <span class="success"><i class="las la-envelope"></i></span>
                                         <div class="media-body">
                                             <a href="{{ $notification->data['url'] }}">
                                                 <p>
                                                     {{ $notification->data['message'] }}
                                                 </p>
                                             </a>
                                         </div>
                                         <span class="notify-time">{{ $notification->created_at->format('h:m A') }}</span>
                                     </li>
                                 @empty

                                     <li class="media dropdown-item">

                                         <div class="media-body ">

                                             <p class="text-center">
                                                 {{ __('No Notifications') }}
                                             </p>

                                         </div>

                                     </li>
                                 @endforelse
                             </ul>
                             <a class="all-notification"
                                 href="{{ route('admin.notifications') }}">{{ __('See all notifications') }} <i
                                     class="ti-arrow-right"></i></a>
                         </div>
                     </li>
                     <li class="nav-item dropdown header-profile">
                         <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                             <i data-feather="user"></i>
                         </a>
                         <div class="dropdown-menu dropdown-menu-right">
                             <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                 <i class="las la-user"></i>
                                 <span class="ml-2">{{ __('Profile') }} </span>
                             </a>

                             <a href="{{ route('admin.logout') }}" class="dropdown-item">
                                 <i class="las la-sign-out-alt"></i>
                                 <span class="ml-2">{{ __('Logout') }} </span>
                             </a>
                         </div>
                     </li>
                     <li class="d-lg-none d-flex justify-content-center align-items-center pl-md-0">
                        <div class="header-search">
                            <button type="button" class="header-search-res-btn">
                                <i data-feather="search"></i>
                            </button>
                            <div class="form">
                                <input class="form-control searchNav" type="text" placeholder="Search" aria-label="Search">
                                <ul class="search-item">

                                </ul>
                                <button type="search"><i class="las la-search"></i></button>
                            </div>
                        </div>
                     </li>
                 </ul>
             </div>
         </nav>
     </div>
 </div>
 <!-- Header end -->


<!-- mobile bottom menu start -->
<div class="mobile-bottom-menu">
    <a href="{{ route('admin.notifications') }}">
        <i data-feather="bell"></i>
        <p>{{ __('Notification') }}</p>
    </a>
    <a href="{{ route('admin.profile') }}" class="profile-img">
        <img src="{{ asset('asset/backend/images/' .auth()->guard('admin')->user()->image) }}" alt="image">
    </a>
    <a href="{{ route('home') }}">
        <i data-feather="globe"></i>
        <p>{{ __('Visit Frontend') }}</p>
    </a>
</div>
<!-- mobile bottom menu end -->