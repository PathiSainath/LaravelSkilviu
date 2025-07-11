<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id('candidate_id');
            $table->unsignedBigInteger('job_id');
            $table->string('candidate_name', 100);
            $table->string('email', 100);
            $table->string('mobile_number', 20);
            $table->string('current_company', 100)->nullable();
            $table->decimal('years_experience', 3, 1)->nullable();
            $table->decimal('relevant_experience', 3, 1)->nullable();
            $table->string('current_ctc', 20)->nullable();
            $table->string('expected_ctc', 20)->nullable();
            $table->string('notice_period', 50)->nullable();
            $table->string('current_location', 100);
            $table->string('preferred_location', 100)->nullable();
            $table->date('available_for_interview')->nullable();
            $table->string('resume_path', 255);
            $table->text('remarks')->nullable();
            $table->string('preferred_company', 100)->nullable();
            $table->timestamps();

            $table->foreign('job_id')->references('job_id')->on('recruitment')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
}
