<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
            'appname' => 'springAdmin',
            'theme' => 'default',
            'currency' => 'usd',
            'pagination' => 10,
            'number_format' => 2,
            'alert' => 'izi',
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'reg_enabled' => true,
            'fonts' => [
                'heading_font_url' => 'https://fonts.googleapis.com/css2?family=Roboto&display=swap',
                'heading_font_family' => "'Roboto','sans-serif'",
                'paragraph_font_url' => 'https://fonts.googleapis.com/css2?family=Roboto&display=swap',
                'paragraph_font_family' => "'Roboto','sans-serif'"
            ],

            'is_email_verification_on' => false,
            'is_sms_verification_on' => false,
            'preloader_status' => false,
            'analytics_status' => false,
            'allow_modal' => true,
            'button_text' => "Lorem, ipsum.",
            'cookie_text' => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus, autem.",
            'allow_recaptcha' => false,            

            'tdio_allow' => false,

            'seo_description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci delectus deleniti temporibus quas veritatis eaque quae iste excepturi natus unde magnam nostrum, officiis tenetur ipsam ratione accusamus nulla esse ab, cumque maxime fugiat modi. Unde dolore nisi nostrum, accusamus eum perferendis distinctio molestiae quam possimus cupiditate, velit ut consequatur eius?"

        ]);
    }
}
