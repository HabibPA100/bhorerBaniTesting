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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->string('splash')->nullable();
            $table->enum('type', ['Breaking', 'Regular', 'Headline']);
            $table->string('meta', 256)->nullable();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('category_1')->nullable();
            $table->string('category_2')->nullable();
            $table->string('category_3')->nullable();
            $table->string('headline');
            $table->string('subtitle')->nullable();
            $table->text('content');
            $table->timestamp('date')->nullable();
            $table->foreignId('reporter_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamp('published_at')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
