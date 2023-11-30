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


                    <form method="post" action="" enctype="multipart/form-data" class="repeater">
                        @csrf

                        <div class="row appear">

                            <?= Builder::render(request()->name, [], 'element')['html'] ?>

                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary float-right">{{ __('Create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection


@push('external-script')
    <script src="{{ Config::jsLib('backend', 'repeater.js') }}"></script>
@endpush

@push('style')
    <style>
        td img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #b4b7ee;
        }

        .form-textarea {
            min-height: 220px;
        }
    </style>
@endpush

@push('script')
    <script>
        $(function() {
            'use strict'

            $('.repeater').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if (confirm(
                            'Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                isFirstItemUndeletable: true
            })

            $('.summernote').summernote({
                height: 250,
            });


            $('.datepicker').datepicker();


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
            })


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


            $('.delete').on('click', function() {
                const modal = $('#deleteModal');

                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show')
            })



        })
    </script>
@endpush
