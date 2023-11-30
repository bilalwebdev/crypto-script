<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('gateway_id');
            $table->string('trx')->unique();
            $table->decimal('amount',28,8);
            $table->decimal('rate',28,8);
            $table->decimal('charge',28,8);
            $table->decimal('total',28,8);
            $table->integer('status')->comment('1=>approved, 2=>pending, 3=>rejected');
            $table->integer('type');
            $table->text('proof')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamp('plan_expired_at')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
