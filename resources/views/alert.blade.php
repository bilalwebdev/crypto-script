<script>
    'use strict'

    @if (session()->has('error'))
        @if (Config::config()->alert === 'sweet')
            Swal.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            })
        @elseif (Config::config()->alert === 'toast')
            toastr.error("{{ session('error') }}", {
                positionClass: "toast-top-right"
            })
        @else
            iziToast.error({
                position: 'topRight',
                message: "{{ session('error') }}",
            });
        @endif
    @endif


    @if (session()->has('success'))

        @if (Config::config()->alert === 'sweet')
            Swal.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            })
        @elseif (Config::config()->alert === 'toast')
            toastr.success("{{ session('success') }}", {
                positionClass: "toast-top-right"

            })
        @else
            iziToast.success({
                position: 'topRight',
                message: "{{ session('success') }}",
            });
        @endif
    @endif


    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @if (Config::config()->alert === 'sweet')
                Swal.fire({
                    icon: 'error',
                    title: "{{ $error }}"
                })
            @elseif (Config::config()->alert === 'toast')
                toastr.error("{{ $error }}", {
                    positionClass: "toast-top-right"

                })
            @else
                iziToast.error({
                    position: 'topRight',
                    message: "{{ $error }}",
                });
            @endif
        @endforeach
    @endif
</script>
