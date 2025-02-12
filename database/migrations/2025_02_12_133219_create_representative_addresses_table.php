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
        Schema::create('representative_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('representative_id')->constrained('representatives');
            $table->string('permanent_district');
            $table->string('permanent_sub_district');
            $table->string('permanent_municipality');
            $table->string('permanent_ward');
            $table->string('permanent_post_code');
            $table->string('permanent_village_locality');
            $table->string('permanent_house_road_number');

            $table->string('current_district');
            $table->string('current_sub_district');
            $table->string('current_municipality');
            $table->string('current_ward');
            $table->string('current_post_code');
            $table->string('current_village_locality');
            $table->string('current_house_road_number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representative_addresses');
    }
};
