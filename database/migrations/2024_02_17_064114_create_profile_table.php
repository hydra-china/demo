<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('uuid');
            $table->string('avatar')->nullable();
            $table->string('birthday')->nullable();
            $table->integer('gender')->nullable();
            $table->string('job')->nullable();
            $table->integer('salary')->nullable();
            $table->string('in_order_to')->nullable();
            $table->string('address')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('alt_relation')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('account_name')->nullable();
            $table->integer('bank_name')->nullable();

            $table->string('front-card')->nullable();
            $table->string('back-card')->nullable();
            $table->string('verify-photo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
