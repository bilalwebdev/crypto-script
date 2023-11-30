@extends(Config::theme() . 'layout.master')

@section('content')
    <section class="sp_pt_120 sp_pb_120">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <h3 class="title mb-4">{{ Config::trans($blog->content->blog_title) }}</h3>
                    <div class="blog-details-img">
                        <img src="{{ Config::getFile('blog', $blog->content->image_one) }}" alt="image">
                    </div>
                    <div class="blog-details-content">
                        <ul class="sp_blog_meta mb-2 mt-3">
                            <li><i class="far fa-user-circle"></i> {{__('by Admin')}}</li>
                            <li><i class="far fa-clock"></i> {{$blog->created_at->format('d F, Y')}}</li>
                        </ul>

                        <p>
                            <?php echo optional($blog->content)->description; ?>
                        </p>
                    </div>

                    <div class="sp_social_links my-4">
                        <?= $shareComponent ?>
                    </div>
                </div>
            </div>

            <div class="my-4">
                <h4>{{ __('Related Post') }}</h4>
            </div>

            <div class="recent-post-slider">
                @forelse ($recentblog as $item)
                    <div class="slide-item">
                        <div class="sp_blog_list_post blog-list-post-two">
                            <div class="sp_blog_list_post_thumb">
                                <img src="{{ Config::getFile('blog', $item->content->image_one) }}" alt="image">
                            </div>
                            <div class="sp_blog_list_post_content">
                                <ul class="sp_blog_meta mb-2">
                                    <li><i class="far fa-user-circle"></i> {{ __('by Admin') }}</li>
                                    <li><i class="far fa-clock"></i> {{ $item->created_at->format('d m, Y') }}</li>
                                </ul>
                                <h4 class="sp_blog_title"><a href="{{ route('blog.details', [$item->id, Str::slug($item->content->blog_title)]) }}">{{ Config::trans($item->content->blog_title) }}</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
@endsection
