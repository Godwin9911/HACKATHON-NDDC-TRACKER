<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->default('noimage.jpg');
            $table->string('verifycode');
            $table->enum('user_type', array('admin','contractor','reviewer','community_member'));
            $table->enum('role', array(0,1,2)); //0 => The Project Issuer(Admin) //1 => The Contractors Members //2 The Reviewers Members //3 The Community Members
            $table->enum('2_factor_enabled', array('no', 'yes'));
            $table->string('google_id');
            $table->enum('accept_terms', array('yes')); 
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
