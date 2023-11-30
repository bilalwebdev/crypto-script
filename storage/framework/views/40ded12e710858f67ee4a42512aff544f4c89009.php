

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header">
                    <h5><?php echo e(__('Two Factor Authentication')); ?></h5>
                </div>
                <div class="card-body">
                    <p><?php echo e(__('Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.')); ?>

                    </p>

                    <?php if($user->loginSecurity == null): ?>
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('user.generate2faSecret')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <button type="submit" class="btn sp_theme_btn">
                                    <?php echo e(__('Generate Secret Key to Enable 2FA')); ?>

                                </button>
                            </div>
                        </form>
                    <?php elseif(!$user->loginSecurity->google2fa_enable): ?>
                        <?php echo e(__(' 1. Scan this QR code with your Google Authenticator App.')); ?><br />

                        <img src="<?= $google2fa_url ?>">

                        <br /><br />
                        2. <?php echo e(__('Enter the pin from Google Authenticator app')); ?>:<br /><br />
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('user.enable2fa')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group<?php echo e($errors->has('verify-code') ? ' has-error' : ''); ?>">
                                <label for="secret" class="control-label"><?php echo e(__('Authenticator Code')); ?></label>
                                <input id="secret" type="password" class="form-control col-md-12 mb-3" name="secret"
                                    required>
                                <?php if($errors->has('verify-code')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('verify-code')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn sp_theme_btn">
                                <?php echo e(__('Enable 2FA')); ?>

                            </button>
                        </form>
                    <?php elseif($user->loginSecurity->google2fa_enable): ?>
                        <p><?php echo e(__('If you are looking to disable Two Factor Authentication. Please confirm your password and Click Disable 2FA Button')); ?>.
                        </p>
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('user.disable2fa')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group<?php echo e($errors->has('current-password') ? ' has-error' : ''); ?>">
                                <label for="change-password" class="control-label"><?php echo e(__('Current Password')); ?></label>
                                <input id="current-password" type="password" class="form-control col-md-12 mb-4"
                                    name="current-password" required>
                                <?php if($errors->has('current-password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('current-password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn sp_theme_btn"><?php echo e(__('Disable 2FA')); ?></button>
                        </form>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/user/2fa_settings.blade.php ENDPATH**/ ?>