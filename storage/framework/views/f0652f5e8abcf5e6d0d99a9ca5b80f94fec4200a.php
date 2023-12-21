

<?php $__env->startSection('content'); ?>
    <form class="sp_account_form mt-4" action="" method="POST">
        <?php echo csrf_field(); ?>
        <label><?php echo e(__('User email')); ?></label>
        <div class="sp_input_icon_field mb-3">
            <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" id="email"
                placeholder="<?php echo e(__('Enter Your Email')); ?>">
            <i class="las la-envelope"></i>
        </div>
        <label><?php echo e(__('Password')); ?></label>
        <div class="sp_input_icon_field mb-3">
            <input type="password" class="form-control" name="password" id="password"
                placeholder="<?php echo e(__('Enter Password')); ?>">
            <i class="las la-lock"></i>
        </div>

        <?php if(Config::config()->allow_recaptcha == 1): ?>
            <div class="col-md-12 my-3">
                <script src="https://www.google.com/recaptcha/api.js"></script>
                <div class="g-recaptcha" data-sitekey="<?php echo e(Config::config()->recaptcha_key); ?>" data-callback="verifyCaptcha">
                </div>
                <div id="g-recaptcha-error"></div>
            </div>
        <?php endif; ?>

        <div class="d-flex flex-wrap justify-content-between">
            <div class="form-check sp_site_checkbox mb-2">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label mb-0" for="flexCheckDefault">
                    <?php echo e(__('Remember Me')); ?>

                </label>
            </div>
            <a href="<?php echo e(route('user.forgot.password')); ?>" class="mb-2 sp_site_color"><?php echo e(__('Forget Password')); ?></a>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn sp_theme_btn w-100"><?php echo e(__('Login')); ?></button>
        </div>

        <div class="or-text">
            <span><?php echo e(__('Or Login With')); ?></span>
        </div>

        <div class="other-login-btns">
            <?php if(Config::config()->allow_facebook): ?>
                <a class="other-login-btn" href="<?php echo e(route('user.facebook.login')); ?>" id="btn-fblogin">
                    <i class="fab fa-facebook-f"></i>
                    <span><?php echo e(__('Login with Facebook')); ?></span>
                </a>
            <?php endif; ?>

            <?php if(Config::config()->allow_google): ?>
                <a class="other-login-btn" href="<?php echo e(route('user.google.login')); ?>" id="btn-fblogin">
                    <i class="fab fa-google"></i>
                    <span><?php echo e(__('Login with Google')); ?></span>
                </a>
            <?php endif; ?>
        </div>

        <p class="mt-4 text-center"> <?php echo e(__('Haven\'t an account')); ?> ? <a href="<?php echo e(route('user.register')); ?>"
                class="sp_site_color"><?php echo e(__('Sign Up')); ?></a></p>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =
                    "<span class='sp_text_danger'><?php echo e(__('Captcha field is required.')); ?></span>";
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/frontend/light/auth/login.blade.php ENDPATH**/ ?>