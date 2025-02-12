<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->string('splash');
            $table->enum('type', ['Breaking', 'Regular', 'Headline']);
            $table->string('meta', 256);
            $table->string('division');
            $table->string('district');
            $table->string('subdistrict');
            $table->string('category_1');
            $table->string('category_2')->nullable();
            $table->string('category_3')->nullable();
            $table->string('headline');
            $table->string('subtitle')->nullable();
            $table->text('content');
            $table->timestamp('date');
            $table->foreign('reporter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamp('published_at')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
};