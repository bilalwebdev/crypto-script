<?php

namespace App\Helpers\Helper;

use App\Mail\BulkMail;
use App\Mail\TemplateMail;
use App\Models\Admin;
use App\Models\Configuration;
use App\Models\Content;
use App\Models\FrontendMedia;
use App\Models\Language;
use App\Models\Page;
use App\Models\PlanSubscription;
use App\Models\Referral;
use App\Models\ReferralCommission;
use App\Models\Template;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use App\Notifications\DepositNotification;
use App\Notifications\PlanSubscriptionNotification;
use App\Utility\Config;
use Image;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use InvalidArgumentException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Throwable;

class Helper
{

    const APP_VERSION = '4.0';

    public static function isInstalled()
    {
        if (!file_exists(storage_path('installed'))) {
            return true;
        }

        return false;
    }


    public static function languageSelection($code)
    {
        $default = Language::where('status', 0)->first()->code;

        if (session()->has('locale')) {
            if (session('locale') == $code) {
                return 'selected';
            }
        } else {
            if ($code == $default) {
                return 'selected';
            }
        }
    }

    public static function config()
    {
        return Configuration::first();
    }

    public static function imagePath($folder, $default = false)
    {
        $general = Helper::config();

        if ($default) {
            return 'asset/images/' . $folder;
        }

        return 'asset/frontend/' . $general->theme . '/images/' . $folder;
    }

    public static function fetchImage($folder, $filename, $default = false)
    {
        $general = Helper::config();
        if ($default == true) {
            if (file_exists(Helper::imagePath($folder, $default) . '/' . $filename) && $filename != null) {
                return asset('asset/images/' . $folder . '/' . $filename);
            }
            return asset('asset/images/placeholder.png');
        }
        if (file_exists(Helper::imagePath($folder) . '/' . $filename) && $filename != null) {
            return asset('asset/frontend/' . $general->theme . '/images/' . $folder . '/' . $filename);
        }
        return asset('asset/images/placeholder.png');
    }

    public static function cssLib($folder, $filename)
    {
        $template = self::config()->theme;

        if ($folder == 'backend') {
            return asset("asset/{$folder}/css/{$filename}");
        }

        return asset("asset/{$folder}/{$template}/css/{$filename}");
    }

    public static function jsLib($folder, $filename)
    {
        $template = self::config()->theme;

        if ($folder == 'backend') {
            return asset("asset/{$folder}/js/{$filename}");
        }

        return asset("asset/{$folder}/{$template}/js/{$filename}");
    }

    public static function verificationCode($length)
    {
        if ($length == 0) {
            return 0;
        }

        $min = pow(10, $length - 1);
        $max = 0;
        while ($length > 0 && $length--) {
            $max = ($max * 10) + 9;
        }
        return random_int($min, $max);
    }

    public static function fireMail($data, $template)
    {
        $html = $template->template;

        $general = self::config();



        foreach ($data as $key => $value) {
            $html = str_replace("%" . $key . "%", $value, $html);
        }

        if (self::config()->email_method == 'php') {
            $headers = "From: $general->appname <$general->email_sent_from> \r\n";
            $headers .= "Reply-To: $general->appname <$general->email_sent_from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
            @mail($data['email'], $template->subject, $html, $headers);
        } else {
            try {

                Mail::to($data['email'])->send(
                    new TemplateMail($template->subject, $html)
                );
            } catch (Throwable $exception) {

                return ['type' => 'invalid', 'message' => 'Invalid Email Configuration'];
            }
        }
    }

    public static function commonMail($data)
    {


        $general = self::config();

        if (!isset($data['email'])) {
            $data['email'] = $general->email_sent_from;
        }

        if (self::config()->email_method == 'php') {
            $headers = "From: $general->appname <$general->email_sent_from> \r\n";
            $headers .= "Reply-To: $general->appname <$general->email_sent_from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
            @mail($data['email'], $data['subject'], $data['message'], $headers);
        } else {
            try {

                Mail::to($data['email'])->send(
                    new BulkMail($data['subject'], $data['message'])
                );
            } catch (Throwable $exception) {
                Log::error($exception);

                return ['type' => 'error', 'message' => 'Invalid Email Configuration'];
            }
        }
    }
    public static function pagination()
    {
        return self::config()->pagination;
    }

    public static function formatter($number)
    {
        $config = self::config()->decimal_precision;

        return number_format($number, $config) . ' ' . self::config()->currency;
    }


    public static function formatOnlyNumber($number)
    {
        $config = self::config()->decimal_precision;

        return number_format($number, $config);
    }

    public static function languages()
    {
        return Language::latest()->get();
    }

    public static function pages()
    {
        return Page::where('status', 1)->where('name', '!=', 'home')->get();
    }

    public static function notifications()
    {
        return auth()->guard('admin')->user()->unreadNotifications()->latest()->get();
    }

    public static function sidebarData()
    {
        $data['deactiveUser'] = User::where('status', 0)->count();
        $data['emailUnverified'] = User::where('is_email_verified', 0)->count();
        $data['smsUnverified'] = User::where('is_sms_verified', 0)->count();
        $data['kycUnverified'] = User::whereIn('is_kyc_verified', [0, 2])->count();
        $data['kyc_req'] = User::where('is_kyc_verified', 2)->where('kyc_information', '!=', null)->count();

        $data['pendingTicket'] = Ticket::where('status', 2)->count();

        $data['pendingWithdraw'] = Withdraw::where('status', 0)->count();

        return $data;
    }

    public static function theme()
    {
        return 'frontend.' . Configuration::first()->theme . '.';
    }


    public static function makeDir($path)
    {
        if (file_exists($path)) return true;
        return mkdir($path, 0775, true);
    }

    public static function removeFile($path)
    {
        return file_exists($path) && is_file($path) ? unlink($path) : false;
    }



    public static function frontendFormatter($key)
    {
        return ucwords(str_replace('_', ' ', $key));
    }


    public static function filePath($folder_name, $default = false)
    {
        $general = self::config();

        if ($default) {
            return 'asset/images/' . $folder_name;
        }

        return 'asset/frontend/' . $general->theme . '/images/' . $folder_name;
    }


    public static function saveImage($image, $directory, $removeFile = '')
    {

        $path = self::makeDir($directory);



        if (!empty($removeFile)) {
            self::removeFile($directory . '/' . $removeFile);
        }

        $filename = uniqid() . time() . '.' . $image->getClientOriginalExtension();

        if ($image->getClientOriginalExtension() == 'gif') {
            copy($image->getRealPath(), $directory . '/' . $filename);
        } else {

            $image = Image::make($image);

            $image->save($directory . '/' . $filename);
        }

        return $filename;
    }


    public static function getFile($folder_name, $filename, $default = false)
    {

        $general = self::config();

        if ($default == true) {
            if (file_exists(self::filePath($folder_name, $default) . '/' . $filename) && $filename != null) {

                return asset('asset/images/' . $folder_name . '/' . $filename);
            }
        }

        if (file_exists(self::filePath($folder_name) . '/' . $filename) && $filename != null) {
            return asset('asset/frontend/' . $general->theme . '/images/' . $folder_name . '/' . $filename);
        }

        return asset('asset/images/placeholder.png');
    }

    public static function sectionConfig()
    {
        return Config::sectionsSelectable();
    }

    public static function activeMenu($route)
    {
        if (is_array($route)) {
            if (in_array(url()->current(), $route)) {
                return 'active';
            }
        }
        if ($route == url()->current()) {
            return 'active';
        }
    }

    public static function builder($section, $collection = false)
    {

        if ($collection) {
            return Content::where('type', 'iteratable')->where('theme', self::config()->theme)->where('name', $section)->get();
        }

        return Content::where('type', 'non_iteratable')->where('theme', self::config()->theme)->where('name', $section)->first();
    }

    public static function media($section, $key,  $type = false, $id = null)
    {
        if ($type) {
            $media = FrontendMedia::where('content_id', $id)->where('section_name', $section)->where('type', 'iteratable')->first();

            if ($media) {
                return self::getFile($section, optional($media->media)->$key);
            } else {
                return self::getFile($section, '');
            }
        }


        $media = FrontendMedia::where('section_name', $section)->where('type', 'non_iteratable')->first();


        return self::getFile($section, optional($media->media)->$key);
    }

    public static function colorText($haystack, $needle)
    {
        $replace = "<span>{$needle}</span>";

        return str_replace($needle, $replace, $haystack);
    }


    public static function setEnv(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }


    public static function singleMenu($routeName)
    {
        $class = 'active';

        if (request()->routeIs($routeName)) {
            return $class;
        }
        return '';
    }

    public static function paymentSuccess($deposit, $fee_amount, $transaction)
    {
        $general = Configuration::first();

        $admin = Admin::where('type', 'super')->first();

        $user = auth()->user();

        if (session('type') == 'deposit') {
            $user->balance = $user->balance + $deposit->amount;

            $user->save();

            $admin->notify(new DepositNotification($deposit, 'online', 'deposit'));
        }

        $deposit->status = 1;

        $deposit->save();

        $data = [
            'plan_id' => $deposit->plan_id,
            'user_id' => $user->id,
        ];


        if (!(session('type') == 'deposit')) {

            $subscription = self::subscription($data, $deposit);
            $admin->notify(new PlanSubscriptionNotification($subscription));
            self::referMoney(auth()->id(), $deposit->user->refferedBy, 'invest', $deposit->amount);
        }

        Transaction::create([
            'trx' => $deposit->trx,
            'amount' => $deposit->amount,
            'details' => 'Payment Successfull',
            'charge' => $fee_amount,
            'type' => '+',
            'user_id' => auth()->id()
        ]);

        $template = Template::where('name', 'payment_successfull')->where('status', 1)->first();

        if ($template) {

            self::fireMail([
                'username' => $deposit->user->username,
                'app_name' => $general->appname,
                'email' => $deposit->user->email,
                'plan' => $deposit->plan->name ?? 'Deposit',
                'trx' => $transaction,
                'amount' => $deposit->amount,
                'currency' => $general->currency,
            ], $template);
        }
    }

    private static function subscription($data, $deposit)
    {
        $subscription = auth()->user()->subscriptions;

        if ($subscription) {
            DB::table('plan_subscriptions')->where('user_id', auth()->id())->update(['is_current' => 0]);
        }

        $id = PlanSubscription::create([
            'plan_id' => $data['plan_id'],
            'user_id' => $data['user_id'],
            'is_current' => 1,
            'plan_expired_at' => $deposit->plan_expired_at
        ]);

        return $id;
    }


    public static function referMoney($from, $to, $refferal_type, $amount)
    {

        $user_id = $from;

        $level = Referral::where('status', 1)->where('type', $refferal_type)->first();

        dd($refferal_type);

        $counter = $level ? count($level->level) : 0;

        $general = Configuration::first();

        for ($i = 0; $i < $counter; $i++) {

            if ($to) {

                if ($refferal_type == 'interest') {
                    $commission = $level->commission[$i];
                } else {
                    $commission = ($level->commission[$i] * $amount) / 100;
                }



                $to->balance = $to->balance + $commission;

                $to->save();

                Transaction::create([
                    'trx' => Str::upper(Str::random(16)),
                    'user_id' => $to->id,
                    'amount' => $commission,
                    'charge' => 0,
                    'details' => 'Refferal Commission from level ' . ($i + 1) . ' user',
                    'type' => '+'
                ]);

                ReferralCommission::create([
                    'commission_to' => $to->id,
                    'commission_from' => $user_id,
                    'amount' => $commission,
                    'purpouse' => $refferal_type === 'invest' ? 'Return invest commission' : 'Return Interest Commission'

                ]);


                $template = Template::where('name', 'refer_commission')->where('status', 1)->first();




                if ($template) {
                    self::fireMail([
                        'username' => $to->username,
                        'email' => $to->email,
                        'app_name' => $general->appname,
                        'refer_user' => User::find($from)->username,
                        'amount' => $commission,
                        'currency' => $general->currency,
                    ], $template);
                }

                $from = $to->id;
                $to = $to->refferedBy;
            }
        }
    }

    public static function navbarMenus()
    {
        $dropdowns = Page::where('name', '!=', 'home')->where('is_dropdown', true)->where('status', 1)->orderBy('order', 'ASC')->get();

        $nonDropdowns = Page::where('name', '!=', 'home')->where('is_dropdown', false)->where('status', 1)->orderBy('order', 'ASC')->get();
        $home = route('home');
        $dropdownsBuilder = '';
        $nonDropdownsBuilder = "<li class='nav-item'>
        <a class='nav-link' href='" . $home . "'>" . __('Home') . "</a>
    </li>";
        $html = '';


        foreach ($nonDropdowns as $page) {
            $route = route('pages', $page->slug);
            $nonDropdownsBuilder .= "
                <li class='nav-item'>
                                <a class='nav-link' href='" . $route . "'>" . __($page->name) . "</a>
                            </li>
                ";
        }

        if ($nonDropdowns->count() > 0) {
            $html .= $nonDropdownsBuilder;
        }



        foreach ($dropdowns as $drop) {
            $route = route('pages', $drop->slug);
            $dropdownsBuilder .= "<li><a class='dropdown-item' href='" . $route . "'>" . __($drop->name) . "</a></li>";
        }

        if ($dropdowns->count() > 0) {
            $html .= " <li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                            data-bs-toggle='dropdown' aria-expanded='false'>
                            " . __('Pages') . "
                        </a>
                        <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                            " . $dropdownsBuilder . "
                        </ul>
                </li>";
        }



        return $html;
    }


    public static function trans($key)
    {
        $jsonFile = session('locale') ?? 'en';

        $jsonArray = json_decode(file_get_contents(resource_path('lang/sections/' . $jsonFile . '.json')), true) ?? [];


        $key = preg_replace('/\s+/S', " ", $key);

        $key = ucfirst(strtolower(trim($key)));

        if (!array_key_exists($key, $jsonArray)) {

            $jsonArray[$key] = $key;

            file_put_contents(resource_path('lang/sections/' . $jsonFile . '.json'), json_encode($jsonArray));
        }

        return $jsonArray[$key];
    }


    const STANDARD_RATE = 8.0; // $ per lot
    const PREMIUM_VIP_RATE = 4.5; // $ per lot
    const DIRECT_IB_COMMISSION = 0.6; // 60%
    const SUB_IB_COMMISSION = 0.4; // 40%

    public function calculateCommission($tradingVolume, $accountType, $isDirectIB, $isSubIB)
    {
        $commissionRate = $this->getCommissionRate($accountType);

        $commission = $tradingVolume * $commissionRate;

        if ($isDirectIB) {
            $commission *= self::DIRECT_IB_COMMISSION;
        } elseif ($isSubIB) {
            $commission *= self::SUB_IB_COMMISSION;
        }

        return $commission;
    }

    private function getCommissionRate($accountType)
    {
        switch ($accountType) {
            case 'standard':
                return self::STANDARD_RATE;
            case 'premium':
            case 'vip':
                return self::PREMIUM_VIP_RATE;
                // Add more cases if there are other account types
            default:
                throw new InvalidArgumentException('Invalid account type');
        }
    }
}
