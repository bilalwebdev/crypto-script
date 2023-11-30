<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('gateway_id');
            $table->string('trx')->unique();
            $table->decimal('amount',28,8)->default(0);
            $table->decimal('rate',28,8)->default(0);
            $table->decimal('charge',28,8)->default(0);
            $table->decimal('total',28,8)->default(0);
            $table->integer('status')->comment('1 => approved,2 => pending,3 => rejected');
            $table->integer('type')->default(1)->comment('0=>manual , 1 => autometic');
            $table->text('payment_proof')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}
