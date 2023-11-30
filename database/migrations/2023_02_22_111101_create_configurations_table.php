<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('appname')->nullable();
            $table->string('theme')->nullable();
            $table->string('currency')->nullable();
            $table->integer('pagination')->default(10);
            $table->integer('number_format')->default(2);
            $table->string('alert')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->boolean('reg_enabled')->default(true);
            $table->text('fonts')->nullable();
            $table->boolean('is_email_verification_on')->default(false);
            $table->boolean('is_sms_verification_on')->default(false);
            $table->string('preloader_image')->nullable();
            $table->boolean('preloader_status')->default(true);
            $table->boolean('analytics_status')->default(false);
            $table->string('analytics_key')->nullable();
            $table->boolean('allow_modal')->default(true);
            $table->string('button_text')->nullable();
            $table->string('cookie_text')->nullable();
            $table->boolean('allow_recaptcha')->default(false);
            $table->string('recaptcha_key')->nullable();
            $table->string('recaptcha_secret')->nullable();

            $table->boolean('tdio_allow')->default(true);
            $table->string('tdio_url')->nullable();
            $table->string('seo_tags')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('color')->nullable();
            $table->decimal('signup_bonus',28,8)->default(0);
            $table->integer('withdraw_limit')->nullable();
            $table->text('kyc')->nullable();
            $table->boolean('is_allow_kyc')->nullable();
            $table->integer('transfer_limit')->nullable();
            $table->decimal('transfer_charge',28,8)->default(0)->nullable();
            $table->string('transfer_type')->nullable();
            $table->decimal('transfer_min_amount',28,8)->default(0)->nullable();
            $table->decimal('transfer_max_amount',28,8)->default(0)->nullable();
            $table->boolean('allow_facebook')->default(false);
            $table->boolean('allow_google')->default(false);
            $table->dateTime('cron')->nullable();
            $table->string('copyright')->nullable();

            $table->text('email_method')->nullable();
            $table->text('email_sent_from')->nullable();
            $table->text('email_config')->nullable();

            $table->integer('decimal_precision')->default(2);
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
        Schema::dropIfExists('configurations');
    }
}
