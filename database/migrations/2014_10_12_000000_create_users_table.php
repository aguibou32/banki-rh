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
            $table->id();
            $table->string('matricule')->unique();
            $table->string('id_number')->unique();
            $table->string('genre');
            $table->string('nationality');
            $table->string('name');
            $table->string('surname');
            $table->date('dob')->format('d/m/Y');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('addresse');
            $table->string('pays');
            $table->string('type_employé');
            $table->string('role');
            $table->text('description');
            $table->date('date_du_debut')->format('d/m/Y');
            $table->string('profile_picture')->default("user.png");
            $table->string("file1")->nullable();
            $table->string("file1_name")->nullable();
            $table->string("file2")->nullable();
            $table->string("file2_name")->nullable();
            $table->string("file3")->nullable();
            $table->string("file3_name")->nullable();
            $table->string("file4")->nullable();
            $table->string("file4_name")->nullable();
            $table->string("file5")->nullable();
            $table->string("file5_name")->nullable();
            $table->string("file6")->nullable();
            $table->string("file6_name")->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('status')->default(1);
            $table->rememberToken();

            $table->foreignId('service_id')->nullable()->onstrained();
            $table->timestamp('last_seen')->nullable();

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
}
