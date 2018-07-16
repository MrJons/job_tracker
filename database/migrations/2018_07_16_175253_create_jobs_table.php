<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('company_name');
            $table->string('company_url');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->tinyInteger('role_interest');
            $table->string('application_stage');
            $table->date('last_interaction');
            $table->text('extra_notes');
            $table->timestamps();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('jobs');
    }
}
