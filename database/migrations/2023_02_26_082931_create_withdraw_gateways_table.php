<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('min_withdraw_amount',28,8);
            $table->decimal('max_withdraw_amount',28,8);
            $table->decimal('charge',28,8);
            $table->string('type');
            $table->text('instruction')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraw_gateways');
    }
}
