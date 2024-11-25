<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->unique();
            $table->timestamp('phone_verified_at')->nullable();

            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('state_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('gender_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('religion_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('local_govt_id')->nullable()->constrained()->nullOnDelete();

            $table->string('place_of_birth')->nullable();
            $table->string('contact_address')->nullable();
            $table->date('dob')->nullable();
            $table->string('disability', 10)->nullable();
            $table->string('nature_disability')->nullable();
            $table->string('nin', 12)->nullable();
            $table->string('blood_group', 100)->nullable();


            $table->string('guardian_name', 200)->nullable();
            $table->string('guardian_address', 400)->nullable();
            $table->string('guardian_phone', 15)->nullable();
            $table->string('guardian_email', 50)->nullable();
            $table->string('guardian_relationship', 50)->nullable();

            $table->string('kin_name', 200)->nullable();
            $table->string('kin_address', 400)->nullable();
            $table->string('kin_phone_no', 15)->nullable();
            $table->string('kin_email', 50)->nullable();
            $table->string('kin_relationship', 50)->nullable();

            $table->integer('no_of_sittings')->default(1);
            $table->json('first_sitting_grade')->nullable();
            $table->json('second_sitting_grade')->nullable();
            $table->json('document_uploaded')->nullable();

            $table->boolean('status')->default(0);
            $table->integer('application_fee_transaction_id')->nullable();
            $table->integer('acceptance_fee_transaction_id')->nullable();

            $table->rememberToken();
            $table->foreignId('course_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
