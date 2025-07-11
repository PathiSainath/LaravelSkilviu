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
        Schema::create('_user_master', function (Blueprint $table) {
            $table->id(); // auto-incrementing primary key (user_id)
            $table->string('user_role'); // e.g., admin, candidate, etc.
            $table->string('username')->unique(); // unique username
            $table->string('password'); // hashed password
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_user_master');
    }
};
