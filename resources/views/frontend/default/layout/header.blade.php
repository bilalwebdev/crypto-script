@php
    $singleElement = Config::builder('contact');
    $socials = Config::builder('socials', true);
@endphp


<header class="sp_header">
    <div class="sp_header_info_bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 header-top-left">
                    <ul class="hc-list justify-content-lg-start justify-content-center">
                        <li><a href="mailto:{{ $singleElement->content->email ?? '' }}"><i class="fas fa-envelope"></i>
                                {{ $singleElement->content->email ?? '' }}</a></li>
                        <li><a href="tel:{{ $singleElement->content->phone ?? '' }}"><i class="fas fa-phone-alt"></i>
                                {{ $singleElement->content->phone ?? '' }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 header-top-right d-lg-block d-none">
                    <ul class="hc-list justify-content-lg-end justify-content-center">
                        <li>
                            <ul class="social-icons">
                                @foreach ($socials as $social)
                                    <li><a href="{{ $social->content->link }}"><i
                                                class="{{ $social->content->icon }}"></i></a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <select class="custom-select-form selectric ms-3 rounded changeLang nav-link scrollto"
                                aria-label="Default select example">
                                @foreach (Config::languages() as $language)
                                    <option value="{{ $language->code }}"
                                        {{ Config::languageSelection($language->code) }}>
                                        {{ __(ucwords($language->name)) }}
                                    </option>
                                @endforeach
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- header-top end -->

    <div class="sp_header_main">
        <div class="container">
            <nav class="navbar navbar-expand-xl p-0 align-items-center">
                <a class="site-logo site-title" href="{{ route('home') }}">
                    <img src="{{ Config::getFile('logo', Config::config()->logo, true) }}" alt="logo">
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="menu-toggle"></span>
                </button>
                <div class="collapse navbar-collapse mt-lg-0 mt-3" id="mainNavbar">
                    <ul class="nav navbar-nav sp_site_menu ms-auto">
                        <?= Config::navbarMenus() ?>
                    </ul>

                    <select class="custom-select-form  rounded changeLang nav-link mb-3 d-xl-none">
                        @foreach (Config::languages() as $language)
                            <option value="{{ $language->code }}" {{ Config::languageSelection($language->code) }}>
                                {{ __(ucwords($language->name)) }}
                            </option>
                        @endforeach
                    </select>

                    <div class="navbar-action">
                        @auth
                            <a href="{{ route('user.dashboard') }}" class="btn sp_theme_btn btn-sm">{{ __('Dashboard') }}
                                <i class="las la-long-arrow-alt-right ms-2"></i></a>
                        @else
                            <a href="{{ route('user.login') }}" class="me-3 text-p">{{ __('Sign In') }}</a>
                            <a href="{{ route('user.register') }}" class="btn sp_theme_btn btn-sm">{{ __('Sign up') }} <i
                                    class="las la-long-arrow-alt-right ms-2"></i></a>
                        @endauth

                    </div>
                </div>
            </nav>
        </div>
    </div><!-- header-bottom end -->
</header>
<!-- header-section end  -->
