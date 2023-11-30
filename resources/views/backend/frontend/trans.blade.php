@extends('backend.layout.master')

@section('element')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-header justify-content-end">
                    <a href="{{ route('admin.frontend.section.manage', request()->name) }}" class="btn btn-primary m-3"> <i
                            class="fas fa-arrow-left"></i> {{ __('Go back') }}</a>
                </div>
                <div class="card-body">

                    @php
                        $counter = Builder::render(request()->name)['image_id'];
                    @endphp

                    <ul class="nav nav-tabs sp_nav_tabs mb-4" id="myTab" role="tablist">
                        @foreach ($languages as $lang)
                            
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }} lang"
                                        id="{{ $lang->code }}-tab" data-toggle="tab" data-target="#{{ $lang->code }}"
                                        type="button" role="tab" aria-controls="{{ $lang->code }}"
                                        aria-selected="true"
                                        data-language="{{ $lang->id }}">{{ $lang->name }}</button>
                                </li>
                           
                        @endforeach
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        @foreach ($languages as $lang)
                           
                                <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="{{ $lang->code }}"
                                    role="tabpanel" aria-labelledby="{{ $lang->code }}-tab">

                                    <form method="post" action="" enctype="multipart/form-data" class="repeater">
                                        @csrf

                                        <input type="hidden" name="language" value="{{ $lang->id }}">
                                        <input type="hidden" name="section" value="{{ request()->name }}">
                                        <input type="hidden" name="parent_id" value="{{ $elementId }}">
                                        <div class="row appear">
                                           
                                            <?= Element::render(request()->name, $childs->where('language_id', $lang->id)->first(), $lang->id)['html'] ?>
                                        </div>
                                        <div class="form-group mt-4">
                                            <button type="submit"
                                                class="btn btn-primary float-right">{{ __('Update') }}</button>
                                        </div>
                                    </form>
                                </div>
                          
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('script')
    <script>
        $(function() {
            'use strict'

            let ids = @json($counter);

            for (let index = 0; index < ids.length; index++) {

                let id = ids[index];

                $.uploadPreview({
                    input_field: "#image-upload-" + id,
                    preview_box: "#image-preview-" + id,
                    label_field: "#image-label-" + id,
                    label_default: "{{ __('Choose File') }}",
                    label_selected: "{{ __('Upload File') }}",
                    no_label: false,
                    success_callback: null
                });

            }


            $('.iconpicker').iconpicker({
                align: 'center', // Only in div tag
                arrowClass: 'btn-danger',
                arrowPrevIconClass: 'fas fa-angle-left',
                arrowNextIconClass: 'fas fa-angle-right',
                cols: 10,
                footer: true,
                header: true,
                icon: 'fas fa-bomb',
                iconset: 'fontawesome5',
                labelHeader: '{0} of {1} pages',
                labelFooter: '{0} - {1} of {2} icons',
                placement: 'bottom', // Only in button tag
                rows: 5,
                search: true,
                searchText: 'Search',
                selectedClass: 'btn-success',
                unselectedClass: ''
            });

            $('.iconpicker').on('change', function(e) {
                $('.icon-value').val(e.icon)
            });



        })
    </script>
@endpush
