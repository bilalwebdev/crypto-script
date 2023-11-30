<section class="testimonial-section sp_pt_120 sp_pb_120">
    <div class="right-shape-1"></div>
    <div class="right-shape-2"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="sp_theme_top  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                    <div class="sp_theme_top_caption"><i class="fas fa-bolt"></i> {{ Config::trans($content->section_header) }}</div>
                    <h2 class="sp_theme_top_title">
                        <?= Config::colorText(optional($content)->title, optional($content)->color_text_for_title) ?></span></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="sp_testimonial_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="sp_testimonial_item">
                        <div class="sp_testimonial_thumb_area">

                            <div class="sp_testimonial_thumb_slider">
                                @foreach ($element as $item)
                                    <div class="sp_testimonial_thumb_slide">
                                        <div class="sp_testimonial_thumb">
                                            <img src="{{ Config::getFile('testimonial', $item->content->image_one) }}" alt="image">
                                        </div>
                                    </div>
                                @endforeach
                            </div><!-- testimonial-thumb-slider end -->

                            <button type="button" class="testi-prev"><i class="las la-angle-left"></i></button>
                            <button type="button" class="testi-next"><i class="las la-angle-right"></i></button>

                            <div class="shape-circle">
                                <span class="dot-1"></span>
                                <span class="dot-2"></span>
                                <span class="dot-3"></span>
                            </div>
                        </div>
                        <div class="sp_testimonial_content_area">
                            <div class="sp_testimonial_content_slider">
                                @foreach ($element as $item)
                                    <div class="sp_testimonial_content">
                                        <div
                                            class="d-flex flex-wrap align-items-end justify-content-md-start justify-content-center">
                                            <h4 class="name me-3">{{ $item->content->client_name }}</h4>
                                            <span class="sp_site_color">{{ $item->content->designation }}</span>
                                        </div>
                                        <p class="mt-3">
                                            {{ Config::trans($item->content->description) }}
                                        </p>
                                    </div>
                                @endforeach

                            </div><!-- testimonial-content-slider end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- testimonial section end -->
