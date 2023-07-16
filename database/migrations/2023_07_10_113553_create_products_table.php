<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->default(null)->nullable();
            $table->text('description');
            $table->unsignedBigInteger('user_id')->default(null)->nullable();
            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users');


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
