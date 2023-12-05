<form action="<?php echo e(route('admin.general.basic')); ?>" method="post">
    <?php echo csrf_field(); ?>

    <input type="hidden" name="type" value="others">
    <div class="card">
        <div class="card-header">
            <h4 class="m-0"><?php echo e(__('Copyright')); ?></h4>
        </div>
        <div class="card-body">
            <div class="row">


                <div class="mb-4 col-md-12">
                    <label for=""><?php echo e(__('Copyright')); ?></label>
                    <input type="text" name="copyright" class="form-control"
                        value="<?php echo e($general->copyright); ?>">
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="m-0"><?php echo e(__('Custom Font Settings')); ?></h4>
        </div>
        <div class="card-body">
            <div class="row">


                <div class="mb-4 col-md-6">
                    <label for=""><?php echo e(__('Heading Fonts url')); ?></label>
                    <input type="text" name="fonts[heading_font_url]" class="form-control"
                        value="<?php echo e($general->fonts->heading_font_url); ?>">
                </div>

                <div class="mb-4 col-md-6">
                    <label for=""><?php echo e(__('Heading Font Family')); ?></label>
                    <input type="text" name="fonts[heading_font_family]" class="form-control"
                        value="<?php echo e($general->fonts->heading_font_family); ?>">
                </div>


                <div class="mb-4 col-md-6">
                    <label for=""><?php echo e(__('Paragraph Fonts url')); ?></label>
                    <input type="text" name="fonts[paragraph_font_url]" class="form-control"
                        value="<?php echo e($general->fonts->paragraph_font_url); ?>">
                </div>

                <div class="mb-4 col-md-6">
                    <label for=""><?php echo e(__('Paragraph Font Family')); ?></label>
                    <input type="text" name="fonts[paragraph_font_family]" class="form-control"
                        value="<?php echo e($general->fonts->paragraph_font_family); ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="m-0"><?php echo e(__('Seo Settings')); ?></h4>
        </div>
        <div class="card-body">
            <div class="row">


                <div class="mb-4 col-md-12">
                    <label for=""><?php echo e(__('Seo Meta Tag')); ?></label>
                    <select name="seo_tags[]" class="form-control js-example-tokenizer" multiple>
                        <?php if($general->seo_tags != null): ?>
                            <?php $__currentLoopData = $general->seo_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tag); ?>" selected><?php echo e($tag); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>


                <div class="mb-4 col-md-12">
                    <label for=""><?php echo e(__('Seo Description')); ?></label>
                    <textarea name="seo_description" id="" cols="30" rows="10" class="form-control"><?php echo e(__($general->seo_description)); ?></textarea>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h4><?php echo e(__('Cookie Settings')); ?></h4>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="mb-4 col-md-8">
                    <label for=""><?php echo e(__('Cookie Button Text')); ?></label>
                    <input type="text" name="button_text" class="form-control" value="<?php echo e($general->button_text); ?>">
                </div>

                <div class="mb-4 col-md-4">
                    <label for=""><?php echo e(__('Allow Cookie Modal')); ?></label>
                    <input type="checkbox" name="allow_modal" <?php echo e($general->allow_modal == 1 ? 'checked' : ''); ?>

                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="43px">
                </div>

                <div class="mb-4 col-md-12">
                    <label for=""><?php echo e(__('Cookie Details')); ?></label>
                    <textarea name="cookie_text" cols="30" rows="10" class="form-control"><?php echo e(__($general->cookie_text)); ?></textarea>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="mb-4 col-md-12">
            <button type="submit" class="btn btn-primary float-right"> <i class="fas fa-sync-alt mr-2"></i>
                <?php echo e(__('Update Others Settings')); ?></button>
        </div>
    </div>

</form>
<?php /**PATH E:\personal\crypto-script\resources\views/backend/setting/others.blade.php ENDPATH**/ ?>