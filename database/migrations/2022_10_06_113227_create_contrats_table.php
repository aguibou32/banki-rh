<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->date("debut");
            $table->date("fin");
            $table->time("heure_debut");
            $table->time("heure_fin");
            $table->double("horraire");
            $table->double("salaire_de_base")->nullable();
            $table->double("logement")->nullable();
            $table->double("transport")->nullable();
            $table->unsignedInteger("responsable_id");
            $table->text("fonctions");
            $table->unsignedInteger("signe_par_id");

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
        Schema::dropIfExists('contrats');
    }
}
