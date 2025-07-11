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
        Schema::create('clientforms', function (Blueprint $table) {
            $table->id(); // This creates an unsigned BIGINT called `id` and makes it the primary key
            $table->string('company_name', 100)->nullable(false);
            $table->string('website', 255)->nullable();
            $table->string('email', 100)->nullable(false);
            $table->string('phone', 20)->nullable(false);
            $table->string('location', 100)->nullable(false);
            $table->string('company_logo', 255)->nullable();
            $table->string('gst_number', 50)->nullable(false);
            $table->string('sla_document', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('contact_name', 100)->nullable(false);
            $table->string('designation', 100)->nullable(false);
            $table->string('contact_email', 100)->nullable(false);
            $table->string('contact_phone', 20)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientforms');
    }
};
