@extends(Config::theme() . 'layout.master')

@section('content')
    @if ($page->widgets)
        @foreach ($page->widgets as $section)
            <?= Section::render($section->sections) ?>
        @endforeach
    @endif
@endsection
