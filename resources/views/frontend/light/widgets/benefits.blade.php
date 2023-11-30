@php
    
    $chunks = $element->chunk(3);

    $left = isset($chunks[0]) ? $chunks[0] : [];

    $right = isset($chunks[1]) ? $chunks[1] : [];

@endphp

<section class="benefit-section sp_pt_120 sp_pb_120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="sp_theme_top  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                    <div class="sp_theme_top_caption"><i class="fas fa-bolt"></i> {{ Config::trans($content->section_header) }}</div>
                    <h2 class="sp_theme_top_title">
                        <?= Config::trans($content->title) ?>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row gy-4 align-items-center">
            <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
                @foreach ($left as $item)
                    <div class="sp_benefit_item">
                        <div class="sp_benefit_icon">
                            <img src="{{ Config::getFile('benefits', $item->content->image_one) }}" alt="image">
                        </div>
                        <div class="sp_benefit_content">
                            <h4 class="title">{{ Config::trans($item->content->title)}}</h4>
                            <p class="mt-2">{{ Config::trans($item->content->description)}}</p>
                        </div>
                    </div><!-- sp_benefit_item end -->
                @endforeach
            </div>
            <div class="col-lg-4 d-xl-block d-none">
                <div class="sp_benefit_thumb paroller" data-paroller-factor="0.2" data-paroller-factor-xs="0.0"
                    data-paroller-factor-sm="0.0" data-paroller-factor-md="0.0" data-paroller-factor-md="0.0"
                    data-paroller-factor-lg="0.0" data-paroller-type="foreground" data-paroller-direction="vertical">
                    <img src="{{ Config::getFile('benefits', $content->image_one) }}" alt="image">
                </div>
            </div>
            <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.9s">
                @foreach ($right as $item)
                    <div class="sp_benefit_item">
                        <div class="sp_benefit_icon">
                            <img src="{{ Config::getFile('benefits', $item->content->image_one) }}" alt="image">
                        </div>
                        <div class="sp_benefit_content">
                            <h4 class="title">{{ Config::trans($item->content->title)}}</h4>
                            <p class="mt-2">{{ Config::trans($item->content->description)}}</p>
                        </div>
                    </div><!-- sp_benefit_item end -->
                @endforeach

            </div>
        </div>
    </div>
</section>
<!-- benefit section end -->
