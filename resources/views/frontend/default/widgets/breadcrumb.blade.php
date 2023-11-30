<section class="sp_page_banner">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="title text-white">{{__($title ?? '')}}</h2>
                <ul class="sp_page_breadcrumb justify-content-center mt-2">
                    <li><a href="{{route('home')}}">{{__('Home')}}</a></li>
                    <li>{{__($title ?? '')}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
