<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReunionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reunions', function (Blueprint $table) {
            $table->id();
            $table->string("titre");
            $table->text("contenu");
            $table->longText("fichier")->nullable();
            $table->timestamps();
        });

        Schema::create('reunion_user', function (Blueprint $table) {
            $table->id();
            $table->integer('reunion_id');
            $table->integer('user_id');
            $table->unique(['reunion_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reunions');
        Schema::dropIfExists('reunion_user');
    }
}
