<section class="overview-section sp_separator_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sp_overview_wrapper">
                    <div class="row gy-5">
                        @foreach ($element as $item)
                            <div class="col-lg-3 col-6">
                                <div class="sp_overview_item">
                                    <div class="sp_overview_icon">
                                        <i class="{{ $item->content->icon }}"></i>
                                    </div>
                                    <div class="sp_overview_content">
                                        <p class="sp_overview_caption">{{ Config::trans($item->content->title) }}</p> 
                                        <div class="d-flex flex-wrap align-items-center justify-content-center">
                                            <h4 class="sp_overview_amount odometer me-1"
                                                data-odometer-final="{{ filter_var($item->content->counter, FILTER_SANITIZE_NUMBER_INT) }}">
                                            </h4>
                                            <h4 class="sp_overview_amount">
                                                {{ preg_replace('/[^a-zA-Z]+/', '', $item->content->counter) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- overview section end -->
