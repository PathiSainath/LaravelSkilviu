<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessTrackerTable extends Migration
{
    public function up()
    {
        Schema::create('process_tracker', function (Blueprint $table) {
            $table->id('tracker_id');
            $table->unsignedBigInteger('candidate_id');
            $table->string('screening', 50)->nullable();
            $table->string('hr_interview', 50)->nullable();
            $table->string('client_cv_review', 50)->nullable();
            $table->string('client_interview', 50)->nullable();
            $table->string('offer_letter', 50)->nullable();
            $table->timestamps();

            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('process_tracker');
    }
}
