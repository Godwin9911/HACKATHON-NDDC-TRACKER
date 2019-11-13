<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('PROJECT_TYPE')->nullable();
            $table->string('LOCATION')->nullable();
            $table->string('LGA')->nullable();
            $table->string('PROJECT_DESCRIPTION')->nullable();
            $table->string('BUDGET_COST')->nullable();
            $table->string('COMMITMENT')->nullable();
            $table->enum('STATUS', array('Not-Completed','In-Progress','Completed'))->nullable();
            $table->string('project_image')->nullable();
            $table->string('AMOUNT_APPROVED_2016')->nullable();
            $table->string('AMOUNT_APPROVED_2017')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
