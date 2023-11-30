<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->decimal('price', 28,8);
            $table->integer('duration');
            $table->string('plan_type');
            $table->string('price_type');
            $table->text('feature')->nullable();
            $table->boolean('whatsapp');
            $table->boolean('telegram');
            $table->boolean('email');
            $table->boolean('sms');
            $table->boolean('dashboard');
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
        Schema::dropIfExists('plans');
    }
}
