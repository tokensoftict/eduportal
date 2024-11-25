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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string("transactionId")->unique();
            $table->morphs("transactionable");
            $table->nullableMorphs('paymentable');
            $table->decimal('amount');
            $table->string("currency");
            $table->date('date');
            $table->string("country");
            $table->string("email");
            $table->string("phoneNumber");
            $table->string("name");
            $table->string("session");
            $table->string("semester");
            $table->enum("gateway",['PAYSTACK']);
            $table->boolean("status")->default(0);
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
        Schema::dropIfExists('transactions');
    }
};
