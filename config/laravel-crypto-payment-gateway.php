<?php

/**
 * GoUrl.io Bitcoin/Altcoin - PHP API for Laravel
 *
 * See: https://gourl.io/api-php.html
 */

use App\Services\Gateway\Gourl;

return [
    /**
     * Box Template
     * 
     * 1. 'compact' (default)
     * 2. 'standard'
     * 3. 'gourl-cryptobox-iframe'
     * 4. 'gourl-cryptobox-bootstrap'
     */
    'box_template' => 'compact',

    /**
     * Hook IPN (Instant payment notification) to the following static class method.
     * In this static class method, you can  add your custom logic and give value to the user once your confirmed payment box status.
     * You can also add payment notification logic. 
     * This can be a static class method defined anywhere in your application.
     * This can also be static method/action defined in controller class but route must not be defined for the action.
     * 
     * The Static Method Definition in your class:
     * @param \Victorybiz\LaravelCryptoPaymentGateway\Models\CryptoPaymentModel $cryptoPaymentModel
     * @param array $payment_details
     * @param string $box_status
     * @return bool
     * public static function ipn($cryptoPaymentModel, $payment_details, $box_status)
     * {
     *  // Add your custom logic here.
     *  return true;
     * }
     * 
     * Example 1: [\Victorybiz\LaravelCryptoPaymentGateway\Http\Controllers\CryptoPaymentController::class, 'ipn']
     * Example 2: [App\Http\Controllers\Payment\PaymentController::class, 'ipn']
     */
    'hook_ipn' => [
        Gourl::class, 'success'
    ],

    /**
     * Default coin
     */
    'default_coin' => 'bitcoin',

    /**
     * Place values from your gourl.io signup page here.
     */
    'paymentbox' => [
        'bitcoin' => [
            'public_key' => env('GOURL_BTC_PUBLIC_KEY', null),
            'private_key' =>env('GOURL_BTC_PRIVATE_KEY', null),
            'currency' => 'BTC',
            'enabled' => true,
        ],
        'bitcoincash' => [
            'public_key' => env('GOURL_BCH_PUBLIC_KEY', null),
            'private_key' => env('GOURL_BCH_PRIVATE_KEY', null),
            'currency' => 'BCH',
            'enabled' => true,
        ],
        'bitcoinsv' => [
            'public_key' => env('GOURL_BSV_PUBLIC_KEY', null),
            'private_key' => env('GOURL_BSV_PRIVATE_KEY', null),
            'currency' => 'BSV',
            'enabled' => true,
        ],
        'litecoin' => [
            'public_key' => env('GOURL_LTC_PUBLIC_KEY', null),
            'private_key' => env('GOURL_LTC_PRIVATE_KEY', null),
            'currency' => 'LTC',
            'enabled' => true,
        ],
        'dash' => [
            'public_key' => env('GOURL_DASH_PUBLIC_KEY', null),
            'private_key' => env('GOURL_DASH_PRIVATE_KEY', null),
            'currency' => 'DASH',
            'enabled' => true,
        ],
        'dogecoin' => [
            'public_key' => env('GOURL_DOGE_PUBLIC_KEY', null),
            'private_key' => env('GOURL_DOGE_PRIVATE_KEY', null),
            'currency' => 'DOGE',
            'enabled' => true,
        ],
        'speedcoin' => [
            'public_key' => env('GOURL_SPD_PUBLIC_KEY', null),
            'private_key' => env('GOURL_SPD_PRIVATE_KEY', null),
            'currency' => 'SPD',
            'enabled' => true,
        ],
        'reddcoin' => [
            'public_key' => env('GOURL_RDD_PUBLIC_KEY', null),
            'private_key' => env('GOURL_RDD_PRIVATE_KEY', null),
            'currency' => 'RDD',
            'enabled' => true,
        ],
        'potcoin' => [
            'public_key' => env('GOURL_POT_PUBLIC_KEY', null),
            'private_key' => env('GOURL_POT_PRIVATE_KEY', null),
            'currency' => 'POT',
            'enabled' => true,
        ],
        'feathercoin' => [
            'public_key' => env('GOURL_FTC_PUBLIC_KEY', null),
            'private_key' => env('GOURL_FTC_PRIVATE_KEY', null),
            'currency' => 'FTC',
            'enabled' => true,
        ],
        'vertcoin' => [
            'public_key' => env('GOURL_VTC_PUBLIC_KEY', null),
            'private_key' => env('GOURL_VTC_PRIVATE_KEY', null),
            'currency' => 'VTC',
            'enabled' => true,
        ],
        'peercoin' => [
            'public_key' => env('GOURL_PPC_PUBLIC_KEY', null),
            'private_key' => env('GOURL_PPC_PRIVATE_KEY', null),
            'currency' => 'PPC',
            'enabled' => true,
        ],
        'monetaryunit' => [
            'public_key' => env('GOURL_MUE_PUBLIC_KEY', null),
            'private_key' => env('GOURL_MUE_PRIVATE_KEY', null),
            'currency' => 'MUE',
            'enabled' => true,
        ],
        'universalcurrency' => [
            'public_key' => env('GOURL_UC_PUBLIC_KEY', null),
            'private_key' => env('GOURL_UC_PRIVATE_KEY', null),
            'currency' => 'UC',
            'enabled' => true,
        ],
    ],

    /**
     * This option is used only if form posted userID field is empty.
     * It will save random userID in cookies, sessions or use user IP address as userID.
     * Available values: COOKIE, SESSION, IPADDRESS
     * Default: COOKIE
     */
    'userFormat' => 'COOKIE',

    /**
     * Period after which the payment becomes obsolete and new cryptobox will be shown; 
     * Allowed values: NOEXPIRY, 1 MINUTE..90 MINUTE, 1 HOUR..90 HOURS, 1 DAY..90 DAYS, 1 WEEK..90 WEEKS, 1 MONTH..90 MONTHS
     * Default: NOEXPIRY
     */
    'period' => 'NOEXPIRY',

    /**
     * Relative logo path
     */
    'logo' => 'vendor/laravel-crypto-payment-gateway/images/your_logo.png',

    /**
     * Show logo on payment page
     */
    'show_logo' => true,

    /**
     * Show language box on payment page
     */
    'show_language_box' => true,
    
    /**
     * Show cancel button on payment page
     */
    'show_cancel_button' => true,

    /**
     * Box template configurable options
     */
    'box_template_options' => [
        'compact' => [
            'submit_btn' => false,
        ],
        'standard' => [
            'submit_btn' => false,
        ],
        'gourl_cryptobox_iframe' => [
            'submit_btn' => true,
            'width' => '540',
            'height' => '230',
            'box_style' => '',
            'message_style' => '',
            'anchor' => '',
            // See display_cryptobox() in https://github.com/cryptoapi/Payment-Gateway/blob/master/lib/cryptobox.class.php for details
        ],
        'gourl_cryptobox_bootstrap' => [
            'custom_text' => null,
            'coin_image_size' => 70,
            'qrcode_size' => 200,
            'result_img_path' => 'default',
            'result_img_size' => 250,
            'method' => 'curl', // curl or ajax
            'debug' => false,
            // See display_cryptobox_bootstrap() in https://github.com/cryptoapi/Payment-Gateway/blob/master/lib/cryptobox.class.php for details
        ],
    ],

    /**
     * GoUrl affiliate key
     */
    'webdev_key' => env('GOURL_WEBDEV_KEY', ''),
];