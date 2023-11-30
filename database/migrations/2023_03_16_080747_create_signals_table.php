<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('time_frame_id');
            $table->unsignedBigInteger('currency_pair_id');
            $table->unsignedBigInteger('market_id');
            $table->decimal('open_price',28,8);
            $table->decimal('sl',28,8);
            $table->decimal('tp',28,8);

            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('direction');
            $table->boolean('is_published');

            $table->timestamp('published_date');


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
        Schema::dropIfExists('signals');
    }
}
