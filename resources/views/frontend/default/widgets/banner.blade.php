@php
    $banner = Config::builder('banner');
@endphp
 
<!-- banner section start -->
<section class="sp_banner">
    <div class="sp_banner_bottom_shape">
        <img src="{{ Config::getFile('banner', $banner->content->image_two ?? '') }}" alt="shape">
    </div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <h2 class="sp_banner_title wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                    <?= Config::trans($banner->content->title) ?>
                </h2>
                <ul class="sp_check_list mt-4 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.5s">
                    @foreach ($banner->content->repeater as $item)
                        <li><?= Config::trans($item->repeater) ?> </li>
                    @endforeach
                </ul>
                <a href="{{ $banner->content->button_text_link ?? '' }}" class="btn sp_theme_btn mt-5 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.7s">{{ Config::trans($banner->content->button_text)}}</a>
            </div>
            <div class="col-lg-5">
                <div class="sp_banner_thumb wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.9s">
                    <img src="{{ Config::getFile('banner', $banner->content->image_one) }}" class="sp_banner_img"
                        alt="banner image">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->
