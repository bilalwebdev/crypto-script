@php
    $content = Config::builder('footer');
    
    $links = Config::builder('links', true);

    $socials = Config::builder('socials', true);

    $element = Config::builder('brand', true);
@endphp


<div class="sp_brand_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sp_brand_slider">
                    @foreach ($element as $brand)
                        <div class="sp_brand_slide">
                            <div class="sp_brand_item">
                                <img src="{{ Config::getFile('brand', $brand->content->image_one) }}" alt="brand image">
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div><!-- sp_brand_wrapper end -->

<!-- footer section start -->
<footer class="footer-section">
    <div class="sp_footer_menu_area">
        <div class="back-to-top">
            <div class="back-to-top-inner">
                <a href="#"><i class="las la-arrow-up"></i></a>
            </div>
        </div>

        <div class="container">
            <div class="row gy-4 justify-content-between">
                <div class="col-lg-4 pe-xl-5">
                    <div class="sp_footer_item">
                        <a href="{{ route('home') }}" class="site-logo"><img src="{{ Config::getFile('footer', $content->content->image_one) }}" alt="logo"></a>
                        <p class="mt-4">{{ Config::trans($content->content->footer_short_details) }}</p>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="sp_footer_item">
                        <h5 class="sp_footer_item_title">{{ __('Company') }}</h5>

                        <ul class="sp_footer_menu">
                            @foreach (Config::pages() as $page)
                                <li><a href="{{ route('pages', $page->slug) }}">{{ __($page->name) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="sp_footer_item">
                        <h5 class="sp_footer_item_title">{{ __('Links') }}</h5>
                        <ul class="sp_footer_menu">
                            @foreach ($links as $item)
                                <li><a href="{{ route('links', [$item->id, Str::slug($item->content->page_title)]) }}">{{ Config::trans($item->content->page_title) }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="sp_footer_item">
                        <h5 class="sp_footer_item_title">{{ __('Newsletter') }}</h5>
                        <form class="sp_subscription_form" id="subscribe" method="POST">
                            @csrf
                            <input type="email" name="email" class="form-control subscribe-email"
                                placeholder="Email Address">
                            <button type="submit" class="subs-btn"><i class="far fa-paper-plane"></i></button>
                        </form>
                        <h5 class="mt-4 text-white">{{ __('Social Links') }}</h5>
                        <ul class="sp_social_links mt-2">
                            @foreach ($socials as $social)
                                <li><a href="{{ $social->content->link }}"><i class="{{ $social->content->icon }}"></i></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- footer-top end -->
    <div class="sp_copy_right_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>{{ Config::config()->copyright }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer section end -->
