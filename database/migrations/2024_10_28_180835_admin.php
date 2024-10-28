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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->boolean('status')->default(0)->comment('1 for active, 0 for inactive');
            $table->boolean('email_verification')->default(0);
            $table->string('verification_code')->nullable();
            $table->timestamps();
        });
        
        Schema::create('admin_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('designation')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('alt_phone_number')->nullable();
            $table->string('referral_code')->nullable();
            $table->timestamps();
        });
        
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
        Schema::dropIfExists('admin_details');
        Schema::dropIfExists('admin_permission');
    }
};
