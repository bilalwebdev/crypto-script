

<?php $__env->startSection('element'); ?>
<div class="row">

    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Theme')); ?></th>
                                <th><?php echo e(__('Color Settings')); ?></th>
                                <th><?php echo e(__('Previw')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h5>

                                        <?php echo e(__('Default Theme')); ?>

                                    </h5>
                                    <p>
                                        <a data-route="<?php echo e(route('admin.manage.theme.update', 'default')); ?>" class="<?php if(Config::config()->theme != 'default'): ?> btn btn-outline-danger btn-sm active-btn <?php endif; ?>  <?php if(Config::config()->theme == 'default'): ?> text-success <?php else: ?> text-danger <?php endif; ?> font-weight-bolder">
                                            <?php if(Config::config()->theme == 'default'): ?>
                                            <?php echo e(__('Activated')); ?>

                                            <?php else: ?>
                                            <?php echo e(__('Active')); ?>

                                            <?php endif; ?>
                                        </a>
                                    </p>
                                </td>
                                <td>
                                    <div id="cp1" class="input-group flex-nowrap" title="Using input value">
                                        <span class="input-group-append">
                                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                        </span>
                                        <input type="text" name="primary_color" class="form-control input-lg min-w-120" value="<?php echo e(Config::config()->color['default'] ?? '#9c0ac1'); ?>" />

                                        <button class="btn btn-primary color" data-url="<?php echo e(route('admin.manage.theme.color', 'default')); ?>" data-color="#6A35D4"><?php echo e(__('Submit')); ?></button>
                                    </div>
                                </td>
                                <td>
                                    <button data-href="https://signalmax.springsoftit.com/" class="btn btn-primary btn-sm prev">
                                        <?php echo e(__('Preview')); ?>

                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>

                                        <?php echo e(__('Light Theme')); ?>

                                    </h5>
                                    <p>
                                        <a data-route="<?php echo e(route('admin.manage.theme.update', 'light')); ?>" class="<?php if(Config::config()->theme != 'light'): ?> btn btn-outline-danger btn-sm active-btn <?php endif; ?>  <?php if(Config::config()->theme == 'light'): ?> text-success <?php else: ?> text-danger <?php endif; ?> font-weight-bolder">
                                            <?php if(Config::config()->theme == 'light'): ?>
                                            <?php echo e(__('Activated')); ?>

                                            <?php else: ?>
                                            <?php echo e(__('Active')); ?>

                                            <?php endif; ?>
                                        </a>
                                    </p>
                                </td>
                                <td>
                                    <div id="cp2" class="input-group flex-nowrap" title="Using input value">
                                        <span class="input-group-append">
                                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                        </span>
                                        <input type="text" name="primary_color" class="form-control input-lg min-w-120" value="<?php echo e(Config::config()->color['light'] ?? '#9c0ac1'); ?>" />

                                        <button class="btn btn-primary color" data-url="<?php echo e(route('admin.manage.theme.color', 'light')); ?>" data-color="#6A35D4"><?php echo e(__('Submit')); ?></button>
                                    </div>
                                </td>
                                <td>
                                    <button data-href="https://signalmax.springsoftit.com/" class="btn btn-primary btn-sm prev">
                                        <?php echo e(__('Preview')); ?>

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
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Active Template')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?php echo e(__('Are you sure to active this template ?')); ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Active')); ?></button>
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
                <h5 class="modal-title"><?php echo e(__('Template Preview')); ?></h5>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->startPush('external-style'); ?>
<link rel="stylesheet" href="<?php echo e(Config::cssLib('backend', 'bootstrap-colorpicker.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('external-script'); ?>
<script src="<?php echo e(Config::jsLib('backend', 'bootstrap-colorpicker.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
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
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
                method: "POST",
                success: function(response) {
                    if (response.success) {

                        <?php if(Config::config()->alert == 'izi'): ?>
                        iziToast.success({
                            position: 'topRight',
                            message: "Color Changed Successfully",
                        });
                        <?php elseif(Config::config()->alert == 'toast'): ?>
                        toastr.success("Color Changed Successfully", {
                            positionClass: "toast-top-right"

                        })
                        <?php else: ?>
                        Swal.fire({
                            icon: 'success',
                            title: "Color Changed Successfully"
                        })
                        <?php endif; ?>

                        return
                    }


                    <?php if(Config::config()->alert == 'izi'): ?>
                    iziToast.error({
                        position: 'topRight',
                        message: "Something went wrong",
                    });
                    <?php elseif(Config::config()->alert == 'toast'): ?>
                    toastr.error("Something went wrong", {
                        positionClass: "toast-top-right"

                    })
                    <?php else: ?>
                    Swal.fire({
                        icon: 'error',
                        title: "Something went wrong"
                    })
                    <?php endif; ?>
                },
                complete: function() {
                    window.location.href = '<?php echo e(url()->current()); ?>'
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/setting/theme.blade.php ENDPATH**/ ?>