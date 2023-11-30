<section class="team-section sp_pt_120 sp_pb_120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="sp_theme_top  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                    <div class="sp_theme_top_caption"><i class="fas fa-bolt"></i> {{ Config::trans($content->section_header) }}</div>
                    <h2 class="sp_theme_top_title"><?= Config::colorText(optional($content)->title, optional($content)->color_text_for_title) ?></h2>
                </div>
            </div>
        </div>

        <div class="sp_team_slider">
            @foreach ($element as $item)
                <div class="sp_team_slide">
                    <div class="sp_team_item">
                        <div class="sp_team_thumb">
                            <img src="{{ Config::getFile('team', $item->content->image_one) }}" alt="image">
                        </div>
                        <div class="sp_team_content">
                            <h4 class="name">{{ (optional($item->content)->member_name) }}</h4>
                            <p class="sp_site_color">{{ optional($item->content)->designation }}</p>
                            <ul>
                                <li><a href="{{ optional($item->content)->facebook_url }}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{ optional($item->content)->twitter_url }}"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="{{ optional($item->content)->linkedin_url }}"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                                <li><a href="{{ optional($item->content)->instagram_url }}"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
<!-- team section end -->