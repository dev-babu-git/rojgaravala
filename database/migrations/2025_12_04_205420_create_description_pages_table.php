<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up()
    {
        Schema::create('description_pages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            // In your SQL, subcategory_id is varchar, so keeping same
            $table->string('subcategory_id');

            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->string('eligibility')->nullable();
            $table->string('state')->nullable();
            $table->string('jobbrand')->nullable();
            $table->string('image')->nullable();

            $table->tinyInteger('status')->default(1);

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->timestamps();

            // Foreign Keys
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('description_pages');
    }
};
