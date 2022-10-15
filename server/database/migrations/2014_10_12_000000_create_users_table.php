<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->text('profile_pic')->nullable();
            $table->string('full_name');
            $table->string('mobile_number')->unique()->nullable();
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('teacher');
            $table->boolean('status')->default(false);
            $table->boolean('completed')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
