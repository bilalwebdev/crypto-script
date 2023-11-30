<?php

namespace App\Utility;


class Config
{

    public static function sections()
    {
        return [
            'banner',
            'about',
            'trade',
            'how_works',
            'plans',
            'why_choose_us',
            'overview',
            'benefits',
            'testimonial',
            'referral',
            'team',
            'brand',
            'blog',
            'contact',
            'footer',
            'socials',
            'links',
            'auth'
        ];
    }

    public static function sectionsSelectable()
    {
        return [
            'about',
            'benefits',
            'trade',
            'blog',
            'contact',
            'how_works',
            'overview',
            'plans',
            'referral',
            'team',
            'testimonial',
            'why_choose_us'
        ];
    }
}
