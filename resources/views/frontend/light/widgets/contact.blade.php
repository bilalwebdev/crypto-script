
<!-- contact section start -->
<section class="sp_pt_120 sp_pb_120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="sp_theme_top  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                    <div class="sp_theme_top_caption"><i class="fas fa-bolt"></i> {{ Config::trans($content->section_header) }}</div>
                    <h2 class="sp_theme_top_title"><?= Config::colorText(optional($content)->title, optional($content)->color_text_for_title) ?></h2>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            <div class="col-md-4">
                <div class="sp_contact_item">
                    <div class="sp_contact_icon">
                        <i class="las la-envelope"></i>
                    </div>
                    <div class="sp_contact_content">
                        <h5 class="title">{{ __('Chat to support') }}</h5>

                        <p class="mt-2"><a href="mailto:{{ optional($content)->email }}">{{ optional($content)->email }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sp_contact_item">
                    <div class="sp_contact_icon">
                        <i class="las la-map-marked-alt"></i>
                    </div>
                    <div class="sp_contact_content">
                        <h5 class="title">{{ __('Visit us') }}</h5>

                        <p class="mt-2">{{ optional($content)->address }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sp_contact_item">
                    <div class="sp_contact_icon">
                        <i class="las la-phone"></i>
                    </div>
                    <div class="sp_contact_content">
                        <h5 class="title">{{ __('Call us') }}</h5>

                        <p class="mt-2"><a href="tel:+{{ optional($content)->phone }}">+{{ optional($content)->phone }}</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-header sp_pt_100 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="sp_theme_top_title">
                        <?= Config::colorText(optional($content)->form_header, optional($content)->color_text_for_form_header) ?></h2>
                </div>
            </div>
        </div>

        <form class="sp_contact_form" method="POST">
            @csrf
            <div class="row justify-content-center gy-4">
                <div class="col-lg-6">
                    <label>{{ __('Your name') }} <code>*</code></label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label>{{ __('Your email') }} <code>*</code></label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="col-lg-12">
                    <label>{{ __('Your subject') }} <code>*</code></label>
                    <input type="text" name="subject" class="form-control">
                </div>
                <div class="col-lg-12">
                    <label>{{ __('Your message') }} <code>*</code></label>
                    <textarea name="message" class="form-control"></textarea>
                </div>
                <div class="col-lg-6">
                    <button type="submit" class="btn sp_theme_btn w-100">{{ __('Send Now') }}</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- contact section end -->
