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
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->foreignId('avatar_id')->constrained('avatars', 'id');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('userbadges', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users', 'id');
        });

        Schema::table('userquizzes', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users', 'id');
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


