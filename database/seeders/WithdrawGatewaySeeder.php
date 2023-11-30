<?php

namespace Database\Seeders;

use App\Models\WithdrawGateway;
use Illuminate\Database\Seeder;

class WithdrawGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WithdrawGateway::create([
            'name' => 'Bank',
            'min_withdraw_amount' => 5,
            'max_withdraw_amount' => 500,
            'charge' => 1,
            'type' => 'fixed',
            'status' => true
        ]);
    }
}
