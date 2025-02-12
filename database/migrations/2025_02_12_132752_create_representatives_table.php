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
        Schema::create('representatives', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('bangla_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('mobile_number');
            $table->string('whatsapp_number');
            $table->date('dob');
            $table->text('education_qualifications');
            $table->string('national_id');
            $table->string('interested_position');
            $table->string('responsible_place_name');
            $table->boolean('accept_terms_conditions');
            $table->foreignId('role_id')->constrained('roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representatives');
    }
};
