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
        Schema::create('restaurent', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('contact_number');
            $table->string('username');
            $table->string('restaurent_name');
            $table->string('restaurent_slug');
            $table->string('password');
            $table->boolean('status')->default(0)->comment('1 for active, 0 for inactive');
            $table->boolean('email_verification')->default(0);
            $table->string('verification_code')->nullable();
            $table->timestamps();
        });

        Schema::create('restaurent_deatils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurent_id')->constrained('restaurent')->onDelete('cascade');
            $table->string('address');
            $table->string('address_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });

        Schema::create('restaurent_decoration', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurent_id')->constrained('restaurent')->onDelete('cascade');
            $table->string('background_image')->nullable();
            $table->string('background_video')->nullable();
            $table->string('tagline')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('restaurent_timings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurent')->onDelete('cascade');
            $table->enum('day', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->time('open_time');
            $table->time('close_time');
            $table->timestamps();
        });

        Schema::create('restaurent_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurent')->onDelete('cascade');
            $table->string('user_id');
            $table->string('reviews_description');
            $table->string('rating');
            $table->string('review_images');
            $table->boolean('status')->default(0)->comment('1 for active, 0 for inactive');
            $table->timestamps();
        });

        Schema::create('restaurent_food_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurent')->onDelete('cascade');
            $table->string('user_id');
            $table->string('food_item_id');
            $table->string('reviews_description');
            $table->string('rating');
            $table->string('review_images');
            $table->boolean('status')->default(0)->comment('1 for active, 0 for inactive');
            $table->timestamps();
        });

        Schema::create('restaurent_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurent_id')->constrained('restaurent')->onDelete('cascade');
            $table->string('category_name');
            $table->string('category_slug');
            $table->string('category_image');
            $table->string('category_background_image')->nullable();
            $table->boolean('status')->default(0)->comment('1 for active, 0 for inactive');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        Schema::dropIfExists('restaurent');
        Schema::dropIfExists('restaurent_deatils');
        Schema::dropIfExists('restaurent_decoration');
        Schema::dropIfExists('restaurent_timings');
        Schema::dropIfExists('restaurent_reviews');
        Schema::dropIfExists('restaurent_food_reviews');
        Schema::dropIfExists('restaurent_categories');
    }
};
