<div class="row align-items-center page-top">
    <div class="col-sm-6">
        <div class="welcome-text">
            <h4 class="mb-0">{{ __($title) }}</h4>
        </div>
    </div>
    <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active"><a href="{{url()->current()}}">{{ __($title) }}</a></li>
        </ol>
    </div>
</div>