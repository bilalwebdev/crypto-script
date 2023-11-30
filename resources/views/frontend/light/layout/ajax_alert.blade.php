if (response.success) {

    @if (Config::config()->alert === 'izi')
        iziToast.success({
            position: 'topRight',
            message: "{{$message}}",
        });
    @elseif (Config::config()->alert === 'toast')
        toastr.success("{{$message}}", {
            positionClass: "toast-top-right"

        })
    @else
        Swal.fire({
            icon: 'success',
            title: "{{$message}}"
        })
    @endif

    return
}


@if (Config::config()->alert === 'izi')
    iziToast.error({
        position: 'topRight',
        message: "{{$message_error}}",
    });
@elseif (Config::config()->alert === 'toast')
    toastr.error("{{$message_error}}", {
        positionClass: "toast-top-right"

    })
@else
    Swal.fire({
        icon: 'error',
        title: "{{$message_error}}"
    })
@endif