@extends(Config::theme() . 'layout.master')

@section('content')
    @foreach ($page->widgets as $section)
       <?= Section::render($section->sections) ?>
    @endforeach
@endsection
