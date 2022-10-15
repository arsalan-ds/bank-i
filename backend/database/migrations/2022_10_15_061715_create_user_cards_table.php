<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(1);
            $table->integer('user_virtual_card_id')->default(1);
            $table->longText('card_number');
            $table->string('expiry_month_and_year');
            $table->integer('cvc');
            $table->string('color');
            $table->tinyInteger('is_default')->default(0);
            $table->string('status')->default('ACTIVE');
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
        Schema::dropIfExists('user_cards');
    }
};
