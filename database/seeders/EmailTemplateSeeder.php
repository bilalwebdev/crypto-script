<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('templates')->insert([
            
            [
                'name' => 'password_reset',
                'subject' => 'verification'
            ],
            [
                'name' => 'payment_successfull',
                'subject' => 'verification'
            ],
            [
                'name' => 'payment_received',
                'subject' => 'verification'
            ],
            [
                'name' => 'verify_email',
                'subject' => 'verification'
            ],
            [
                'name' => 'payment_confirmed',
                'subject' => 'verification'
            ],
            [
                'name' => 'payment_rejected',
                'subject' => 'verification'
            ],
            [
                'name' => 'withdraw_accepted',
                'subject' => 'verification'
            ],
            [
                'name' => 'withdraw_rejected',
                'subject' => 'verification'
            ]
        ]);
    }
}
