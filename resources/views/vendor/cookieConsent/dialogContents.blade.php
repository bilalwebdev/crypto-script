<div class="cookies-card style-full js-cookie-consent cookie-consent">
    <div class="container">
        <div class="cookies-card-inner bg--default radius--10px">
            <div class="d-flex flex-wrap align-items-center">
                <div class="cookies-card__icon mb-4">
                    <i class="fas fa-cookie-bite text-dark"></i>
                </div>
                <p class="cookies-card__content cookie-consent__message text-white mb-4">{{__(Config::config()->cookie_text)}}</p>
                <div class="cookies-card__btn">
                    <a href="javascript:void(0)" class="cookies-btn js-cookie-consent-agree cookie-consent__agree">{{ __(Config::config()->button_text) }}</a>
                    <a href="javascript:void(0)" class="cookies-btn decline-cookie__consent">{{ __('Decline') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
    <script>
        $(function(){
            'use strict'

            $('.decline-cookie__consent').on('click', function(){
              $('.js-cookie-consent').remove()  
            })
        })
    </script>
@endpush