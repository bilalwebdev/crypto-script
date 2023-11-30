<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class GatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gateways')->insert([
            [
                'name' => 'stripe',
            ],[
                'name' => 'paypal'
            ],[
                'name' => 'vougepay'
            ],[
                'name' => 'razorpay'
            ],[
                'name' => 'coinpayments'
            ],[
                'name' => 'mollie'
            ],[
                'name' => 'nowpayments'
            ],[
                'name' => 'flutterwave'
            ],[
                'name' => 'paystack'
            ],[
                'name' => 'paghiper'
            ],[
                'name' => 'gourl_BTC'
            ],[
                'name' => 'perfectmoney'
            ],[
                'name' => 'mercadopago'
            ],[
                'name' => 'paytm'
            ]
        ]);
    }
}
