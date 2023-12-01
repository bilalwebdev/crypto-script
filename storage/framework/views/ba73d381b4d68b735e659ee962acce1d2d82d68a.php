<form action="<?php echo e(route('admin.general.basic')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="type" value="api">

    
    <div class="card">
        <div class="card-header">
            <h4 class="m-0"><?php echo e(__('Cryptocompare Api')); ?></h4>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="mb-4 col-md-12">
                    <label for=""><?php echo e(__('Api Key')); ?></label>
                    <input type="text" name="api_key" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : Config::config()->crypto_api); ?>">
                </div>
            </div>
        </div>
    </div>

    

    <div class="card">
        <div class="card-header">

            <h4 class="m-0"><?php echo e(__('Facebook Auth')); ?></h4>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="mb-4 col-md-5">
                    <label for=""><?php echo e(__('App ID')); ?></label>
                    <input type="text" name="app_id" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : env('FACEBOOK_APP_ID')); ?>">
                </div>

                <div class="mb-4 col-md-5">
                    <label for=""><?php echo e(__('App Secret')); ?></label>
                    <input type="text" name="app_secret" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : env('FACEBOOK_SECRET')); ?>">
                </div>

                <div class="mb-4 col-md-2">
                    <label for=""><?php echo e(__('Allow Facebook Login')); ?></label>
                    <input type="checkbox" name="allow_facebook" <?php echo e(Config::config()->allow_facebook ? 'checked' : ''); ?>

                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">

            <h4 class="m-0"><?php echo e(__('Google Auth')); ?></h4>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="mb-4 col-md-5">
                    <label for=""><?php echo e(__('App ID')); ?></label>
                    <input type="text" name="google_app_id" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : env('GOOGLE_APP_ID')); ?>">
                </div>

                <div class="mb-4 col-md-5">
                    <label for=""><?php echo e(__('App Secret')); ?></label>
                    <input type="text" name="google_app_secret" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : env('GOOGLE_SECRET')); ?>">
                </div>

                <div class="mb-4 col-md-2">
                    <label for=""><?php echo e(__('Allow google Login')); ?></label>
                    <input type="checkbox" name="allow_google" <?php echo e(Config::config()->allow_google ? 'checked' : ''); ?>

                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0"><?php echo e(__('Telegram Bot')); ?></h4>
            <p class="m-0">
                <button class="btn btn-primary btn-sm ins"> <i class="fa fa-eye"></i> <?php echo e(__('Instruction')); ?></button>
            </p>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="mb-4 col-md-5">
                    <label for=""><?php echo e(__('Telegram Bot Url')); ?></label>
                    <input type="text" name="bot_url" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : Config::config()->bot_url); ?>">
                </div>

                <div class="mb-4 col-md-5">
                    <label for=""><?php echo e(__('Telegram Bot Token')); ?></label>
                    <input type="text" name="telegram_token" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : Config::config()->telegram_token); ?>">
                </div>

                <div class="mb-4 col-md-2">
                    <label for=""><?php echo e(__('Allow Telegram')); ?></label>
                    <input type="checkbox" name="allow_telegram"
                        <?php echo e(Config::config()->allow_telegram ? 'checked' : ''); ?> data-toggle="toggle" data-on="Active"
                        data-off="Disabled" data-onstyle="success" data-offstyle="danger" data-width="100%"
                        data-height="43px">
                </div>
            </div>
        </div>
    </div>




    <div class="card">
        <div class="card-header">

            <h4 class="m-0"><?php echo e(__('Ultramsg Settings')); ?> <a href="https://ultramsg.com/"
                    style="text-decoration: underline">(Whatsapp api)</a></h4>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="mb-4 col-md-5">
                    <label for=""><?php echo e(__('Ultramsg ID')); ?></label>
                    <input type="text" name="ultra_id" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : env('ULTRA_ID')); ?>">
                </div>

                <div class="mb-4 col-md-5">
                    <label for=""><?php echo e(__('Ultramsg TOKEN')); ?></label>
                    <input type="text" name="ultra_token" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : env('ULTRA_TOKEN')); ?>">
                </div>

                <div class="mb-4 col-md-2">
                    <label for=""><?php echo e(__('Allow Ultramsg')); ?></label>
                    <input type="checkbox" name="allow_ultra" <?php echo e(env('ALLOW_ULTRA') == 'on' ? 'checked' : ''); ?>

                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4><?php echo e(__('Google reCaptcha v3')); ?></h4>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="mb-4 col-md-5">
                    <label for=""><?php echo e(__('Recaptcha Key')); ?></label>
                    <input type="text" name="recaptcha_key" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : Config::config()->recaptcha_key); ?>">
                </div>

                <div class="mb-4 col-md-5">
                    <label for=""><?php echo e(__('Recaptcha Secret')); ?></label>
                    <input type="text" name="recaptcha_secret" class="form-control"
                        value="<?php echo e(env('DEMO') ? '------' : Config::config()->recaptcha_secret); ?>">
                </div>

                <div class="mb-4 col-md-2">
                    <label for=""><?php echo e(__('Allow Recaptcha')); ?></label>
                    <input type="checkbox" name="allow_recaptcha"
                        <?php echo e(Config::config()->allow_recaptcha ? 'checked' : ''); ?> data-toggle="toggle"
                        data-on="Active" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                        data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4><?php echo e(__('Tidio Settings')); ?></h4>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="mb-4 col-md-10">
                    <label for=""><?php echo e(__('Tidio url')); ?></label>
                    <input type="text" name="tidio_url" class="form-control" placeholder="Tidio url"
                        value="<?php echo e(env('DEMO') ? '------' : Config::config()->tdio_url); ?>">
                </div>

                <div class="mb-4 col-md-2">
                    <label for=""><?php echo e(__('Allow tidio')); ?></label>
                    <input type="checkbox" name="tdio_allow" <?php echo e(Config::config()->tdio_allow ? 'checked' : ''); ?>

                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4><?php echo e(__('Google Analytics Settings')); ?></h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="mb-4 col-md-10 mb-3">
                    <label><?php echo e(__('Analytics Id')); ?></label>
                    <input type="text" name="analytics_key" class="form-control form_control"
                        placeholder="Analytics Id"
                        value="<?php echo e(env('DEMO') ? '------' : Config::config()->analytics_key); ?>">
                </div>

                <div class="mb-4 col-md-2">
                    <label for=""><?php echo e(__('Allow Analytics')); ?></label>
                    <input type="checkbox" name="analytics_status"
                        <?php echo e(Config::config()->analytics_status ? 'checked' : ''); ?> data-toggle="toggle"
                        data-on="Active" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                        data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4><?php echo e(__('Nexmo Settings')); ?></h4>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="mb-4 col-md-8">
                    <label for=""><?php echo e(__('Nexmo Key')); ?></label>
                    <input type="text" name="sms_username" class="form-control" placeholder="Sms API KEY"
                        value="<?php echo e(env('DEMO') ? '------' : env('NEXMO_KEY')); ?>">
                </div>

                <div class="mb-4 col-md-4">
                    <label for=""><?php echo e(__('Nexmo Secret')); ?></label>
                    <input type="text" name="sms_password" class="form-control" placeholder="Sms API Secret"
                        value="<?php echo e(env('DEMO') ? '------' : env('NEXMO_SECRET')); ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt mr-2"></i>
                <?php echo e(__('Update API Settings')); ?></button>
        </div>
    </div>
</form>



<?php /**PATH D:\personal\crypto-script\resources\views/backend/setting/api.blade.php ENDPATH**/ ?>