<?php
    $singleElement = Config::builder('contact');
    $socials = Config::builder('socials', true);
?>

<header class="sp_header">
    <div class="sp_header_info_bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-10 header-top-left">
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/" rel="noopener"
                                target="_blank"><span class="blue-text">Markets today</span></a> by TradingView</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                            {
                                "symbols": [{
                                        "proName": "FOREXCOM:SPXUSD",
                                        "title": "S&P 500"
                                    },
                                    {
                                        "proName": "FOREXCOM:NSXUSD",
                                        "title": "US 100"
                                    },
                                    {
                                        "proName": "FX_IDC:EURUSD",
                                        "title": "EUR/USD"
                                    },
                                    {
                                        "proName": "BITSTAMP:BTCUSD",
                                        "title": "Bitcoin"
                                    },
                                    {
                                        "proName": "BITSTAMP:ETHUSD",
                                        "title": "Ethereum"
                                    }
                                ],
                                "showSymbolLogo": true,
                                "colorTheme": "dark",
                                "isTransparent": true,
                                "displayMode": "adaptive",
                                "locale": "en"
                            }
                        </script>
                    </div>
                    <!-- TradingView Widget END -->
                </div>

                <div class="col-lg-2 header-top-right">
                    <div class="d-flex justify-content-end">
                        <select class="custom-select-form selectric ms-3 rounded changeLang nav-link scrollto"
                            aria-label="Default select example">
                            <?php $__currentLoopData = Config::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($language->code); ?>"
                                    <?php echo e(Config::languageSelection($language->code)); ?>>
                                    <?php echo e(__(ucwords($language->name))); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- header-top end -->

    <div class="sp_header_main">
        <div class="container">
            <nav class="navbar navbar-expand-xl p-0 align-items-center">
                <a class="site-logo site-title" href="<?php echo e(route('home')); ?>">
                    <img src="<?php echo e(Config::getFile('logo', Config::config()->logo, true)); ?>" alt="logo">
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="menu-toggle"></span>
                </button>
                <div class="collapse navbar-collapse mt-lg-0 mt-3" id="mainNavbar">
                    <ul class="nav navbar-nav sp_site_menu ms-auto">
                        <?= Config::navbarMenus() ?>
                    </ul>

                    <select class="custom-select-form  rounded changeLang nav-link mb-3 d-xl-none">
                        <?php $__currentLoopData = Config::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($language->code); ?>" <?php echo e(Config::languageSelection($language->code)); ?>>
                                <?php echo e(__(ucwords($language->name))); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <div class="navbar-action">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('user.dashboard')); ?>" class="btn sp_theme_btn btn-sm"><?php echo e(__('Dashboard')); ?>

                                <i class="las la-long-arrow-alt-right ms-2"></i></a>
                        <?php else: ?>
                            <a href="<?php echo e(route('user.login')); ?>" class="me-3 text-p"><?php echo e(__('Sign In')); ?></a>
                            <a href="<?php echo e(route('user.register')); ?>" class="btn sp_theme_btn btn-sm"><?php echo e(__('Sign up')); ?> <i
                                    class="las la-long-arrow-alt-right ms-2"></i></a>
                        <?php endif; ?>

                    </div>
                </div>
            </nav>
        </div>
    </div><!-- header-bottom end -->
</header>
<!-- header-section end  -->
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/layout/header.blade.php ENDPATH**/ ?>