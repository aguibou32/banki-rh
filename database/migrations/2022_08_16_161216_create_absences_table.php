<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->string("motif");
            $table->text("details");
            $table->time("du_heure");
            $table->time("au_heure");
            $table->string("status")->default("en attente");
            $table->text("raison")->nullable();

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('absences');
    }
}
