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
        Schema::create('user_virtual_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(1);
            $table->integer('card_number')->comment("16 digit card Number");
            $table->integer('expiry_month');
            $table->integer('expiry_year');
            $table->integer('cvc');
            $table->string('status')->default('ACTIVE');
            $table->decimal('credit',16,2)->default(0);
            $table->decimal('debit',16,2)->default(0);
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
        Schema::dropIfExists('user_virtual_cards');
    }
};
