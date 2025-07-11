<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentTable extends Migration
{
    public function up(): void
    {
        Schema::create('recruitment', function (Blueprint $table) {
            $table->id('job_id');
            $table->unsignedBigInteger('client_id');
            $table->string('client_name', 100);
            $table->string('job_title', 100);
            $table->integer('min_experience')->nullable();
            $table->integer('max_experience')->nullable();
            $table->string('preferred_company', 100)->nullable();
            $table->string('type_of_industry', 100);
            $table->string('notice_period', 50);
            $table->string('benefit', 100);
            $table->string('budget', 50);
            $table->string('package', 50);
            $table->text('qualification');
            $table->text('skills_required');
            $table->string('job_location', 100);
            $table->string('timings', 100)->nullable();
            $table->integer('no_of_positions');
            $table->integer('working_days')->nullable();
            $table->string('diversity_preference', 50)->nullable();
            $table->string('hiring_type', 50);
            $table->string('work_mode', 50);
            $table->text('interview_process')->nullable();
            $table->text('key_responsibilities');
            $table->text('job_description');
            $table->string('jd_document_path', 255)->nullable();
            $table->timestamps();

            // 🔁 Adjust table name below if it's not 'clients'
            $table->foreign('client_id')->references('id')->on('clientforms')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recruitment');
    }
}
