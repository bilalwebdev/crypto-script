<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->text('address')->nullable();
            $table->string('password');
            $table->decimal('balance',28,8);
            $table->string('image')->nullable();

            $table->boolean('is_email_verified')->default(false);
            $table->boolean('is_sms_verified')->default(false);
            $table->boolean('is_kyc_verified')->default(false);

            $table->string('email_verification_code')->nullable();
            $table->string('sms_verification_code')->nullable();

            $table->dateTime('login_at');


            $table->text('mt5_login')->nullable();
            $table->text('kyc_information')->nullable();

            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();

            $table->boolean('status');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
