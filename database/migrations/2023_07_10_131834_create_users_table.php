<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable()->default(null);
            $table->string('password')->nullable()->default(null);
            $table->string('phone_number')->unique()->nullable()->default(null);
            $table->string('verification_code')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_admin')->default(false)->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
