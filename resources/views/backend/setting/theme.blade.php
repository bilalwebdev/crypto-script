@extends('backend.layout.master')

@section('element')
<div class="row">

    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>{{ __('Theme') }}</th>
                                <th>{{ __('Color Settings') }}</th>
                                <th>{{ __('Previw') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h5>

                                        {{ __('Default Theme') }}
                                    </h5>
                                    <p>
                                        <a data-route="{{ route('admin.manage.theme.update', 'default') }}" class="@if (Config::config()->theme != 'default') btn btn-outline-danger btn-sm active-btn @endif  @if (Config::config()->theme == 'default') text-success @else text-danger @endif font-weight-bolder">
                                            @if (Config::config()->theme == 'default')
                                            {{ __('Activated') }}
                                            @else
                                            {{ __('Active') }}
                                            @endif
                                        </a>
                                    </p>
                                </td>
                                <td>
                                    <div id="cp1" class="input-group flex-nowrap" title="Using input value">
                                        <span class="input-group-append">
                                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                        </span>
                                        <input type="text" name="primary_color" class="form-control input-lg min-w-120" value="{{ Config::config()->color['default'] ?? '#9c0ac1' }}" />

                                        <button class="btn btn-primary color" data-url="{{ route('admin.manage.theme.color', 'default') }}" data-color="#6A35D4">{{__('Submit')}}</button>
                                    </div>
                                </td>
                                <td>
                                    <button data-href="https://signalmax.springsoftit.com/" class="btn btn-primary btn-sm prev">
                                        {{ __('Preview') }}
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>

                                        {{ __('Light Theme') }}
                                    </h5>
                                    <p>
                                        <a data-route="{{ route('admin.manage.theme.update', 'light') }}" class="@if (Config::config()->theme != 'light') btn btn-outline-danger btn-sm active-btn @endif  @if (Config::config()->theme == 'light') text-success @else text-danger @endif font-weight-bolder">
                                            @if (Config::config()->theme == 'light')
                                            {{ __('Activated') }}
                                            @else
                                            {{ __('Active') }}
                                            @endif
                                        </a>
                                    </p>
                                </td>
                                <td>
                                    <div id="cp2" class="input-group flex-nowrap" title="Using input value">
                                        <span class="input-group-append">
                                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                        </span>
                                        <input type="text" name="primary_color" class="form-control input-lg min-w-120" value="{{ Config::config()->color['light'] ?? '#9c0ac1' }}" />

                                        <button class="btn btn-primary color" data-url="{{ route('admin.manage.theme.color', 'light') }}" data-color="#6A35D4">{{__('Submit')}}</button>
                                    </div>
                                </td>
                                <td>
                                    <button data-href="https://signalmax.springsoftit.com/" class="btn btn-primary btn-sm prev">
                                        {{ __('Preview') }}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="activeTheme" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Active Template') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        {{ __('Are you sure to active this template ?') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Active') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="prev" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal--w" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Template Preview') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <iframe src="" frameborder="0" id="iframe"></iframe>
            </div>

        </div>

    </div>
</div>
@endsection

@push('script')
<style>
    .modal-dialog {
        max-width: 96% !important;
    }

    #iframe {
        width: 100%;
        height: 100vh;
    }


    .sp-replacer {
        padding: 0;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: 5px 0 0 5px;
        border-right: none;
    }

    select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 9px);
    }

    .sp-preview {
        width: 100px;
        height: 46px;
        border: 0;
    }

    .sp-preview-inner {
        width: 110px;
    }

    .sp-dd {
        display: none;
    }
</style>
@endpush
@push('external-style')
<link rel="stylesheet" href="{{ Config::cssLib('backend', 'bootstrap-colorpicker.min.css') }}">
@endpush

@push('external-script')
<script src="{{ Config::jsLib('backend', 'bootstrap-colorpicker.min.js') }}"></script>
@endpush

@push('script')
<script>
    $(function() {
        'use strict'
        $('#cp1').colorpicker();

        $('#cp1').on('colorpickerChange', function(event) {

            let color = event.color.toString();

            $('#cp1 .color').attr('data-color', color)

        });


        $('#cp2').colorpicker();

        $('#cp2').on('colorpickerChange', function(event) {

            let color = event.color.toString();

            $('#cp2 .color').attr('data-color', color)


        });

        $(document).on('click', '.color', function() {
            $.ajax({
                url: $(this).data('url'),
                data: {
                    color: $(this).data('color'),
                    "_token": "{{ csrf_token() }}"
                },
                method: "POST",
                success: function(response) {
                    if (response.success) {

                        @if(Config::config()->alert == 'izi')
                        iziToast.success({
                            position: 'topRight',
                            message: "Color Changed Successfully",
                        });
                        @elseif(Config::config()->alert == 'toast')
                        toastr.success("Color Changed Successfully", {
                            positionClass: "toast-top-right"

                        })
                        @else
                        Swal.fire({
                            icon: 'success',
                            title: "Color Changed Successfully"
                        })
                        @endif

                        return
                    }


                    @if(Config::config()->alert == 'izi')
                    iziToast.error({
                        position: 'topRight',
                        message: "Something went wrong",
                    });
                    @elseif(Config::config()->alert == 'toast')
                    toastr.error("Something went wrong", {
                        positionClass: "toast-top-right"

                    })
                    @else
                    Swal.fire({
                        icon: 'error',
                        title: "Something went wrong"
                    })
                    @endif
                },
                complete: function() {
                    window.location.href = '{{url()->current()}}'
                }
            })
        })

        $('.active-btn').on('click', function() {
            const modal = $('#activeTheme');

            modal.find('form').attr('action', $(this).data('route'))

            modal.modal('show')
        })


        $('.prev').on('click', function() {
            const modal = $('#prev');

            modal.find('iframe').attr('src', $(this).data('href'))

            modal.modal('show')
        })
    })
</script>
@endpush