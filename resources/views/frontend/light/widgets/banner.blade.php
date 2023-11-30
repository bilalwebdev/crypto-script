@php
    $banner = Config::builder('banner');
@endphp
 
<!-- banner section start -->
<section class="sp_banner" style="background-image: url('{{ Config::getFile('banner', $banner->content->image_two ?? '') }}');">

    <div class="sp_banner_el">
        <img src="{{ Config::getFile('banner', $banner->content->image_one) }}" alt="banner image">
    </div>

    <div class="container">
        <div class="row gy-5 justify-content-lg-between justify-content-center align-items-center">
            <div class="col-lg-7 text-lg-start text-center">
                <h2 class="sp_banner_title wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                <?= Config::colorText(optional($banner)->content->title, optional($banner)->content->color_text_for_title) ?>
                </h2>

                <p class="sp_banner_description">{{ Config::trans($banner->content->description)}}</p>
                
                <div class="mt-sm-5 mt-4 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.7s">
                    <a href="{{ $banner->content->button_text_link ?? '' }}" class="btn sp_theme_btn me-3 mb-2"><i class="fas fa-rocket me-2"></i> {{ Config::trans($banner->content->button_text)}}</a>

                    <a href="{{ $banner->content->button_two_text_link ?? '' }}" class="btn sp_light_border_btn mb-2">{{ Config::trans($banner->content->button_two_text)}} <i class="las la-arrow-right ms-2 rotate-arrow"></i></a>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-7">
                <div class="sp_banner_thumb wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.9s">
                    <img src="{{ Config::getFile('banner', $banner->content->image_three) }}" alt="banner image">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->