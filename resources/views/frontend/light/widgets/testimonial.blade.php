<section class="testimonial-section sp_pt_120 sp_pb_120" style="background-image: url('{{ Config::getFile('testimonial', $content->image_two) }}');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
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
                <div class="col-xl-12">
                    <div class="sp_testimonial_slider">
                        @foreach ($element as $item)
                        <div class="sp_testimonial_slide">
                            <div class="sp_testimonial_item">
                                <i class="las la-quote-right sp_testimonial_icon"></i>
                                <div class="sp_testimonial_top">
                                    <div class="sp_testimonial_thumb">
                                        <img src="{{ Config::getFile('testimonial', $item->content->image_one) }}" alt="image">
                                    </div>
                                    <div class="sp_testimonial_top_content">
                                        <h4 class="name me-3 text-white">{{ $item->content->client_name }}</h4>
                                        <span class="sp_site_color">{{ $item->content->designation }}</span>
                                    </div>
                                </div>
                                <p class="mt-3">
                                    {{ Config::trans($item->content->description) }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- testimonial section end -->
