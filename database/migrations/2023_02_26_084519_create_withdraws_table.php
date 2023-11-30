<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('withdraw_method_id');
            $table->string('trx')->unique();
            $table->decimal('withdraw_amount',28,8);
            $table->decimal('withdraw_charge',28,8);
            $table->decimal('total',28,8);
            $table->text('proof')->nullable();
            $table->text('reject_reason')->nullable();
            $table->boolean('status')->comment('0=>pending, 1=>approved, 2 => reject');
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
        Schema::dropIfExists('withdraws');
    }
}
