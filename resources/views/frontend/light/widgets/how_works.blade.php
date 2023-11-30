
<section class="work-section sp_pt_120 sp_pb_120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="sp_theme_top  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                    <div class="sp_theme_top_caption"><i class="fas fa-bolt"></i> {{ Config::trans($content->section_header) }}</div>
                    <h2 class="sp_theme_top_title"><?= Config::colorText(optional($content)->title, optional($content)->color_text_for_title) ?></span>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row gy-5 justify-content-center">
            @foreach ($element as $item)
                <div class="col-xl-4 col-md-6">
                    <div class="sp_work_item">
                        <div class="sp_work_number">
                            {{$loop->iteration}}
                        </div>
                        <div class="sp_work_content">
                            <img src="{{ Config::getFile('how_works', $item->content->image_one) }}" alt="image">
                            <h4 class="title">{{Config::trans($item->content->title)}}</h4>
                            <p class="mt-2">{{Config::trans($item->content->description)}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- how work section end -->