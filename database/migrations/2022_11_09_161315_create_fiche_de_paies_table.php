<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicheDePaiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_de_paies', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->double("montant");
            $table->text("description");
            $table->date("date");
            $table->longText("fichier")->nullable();
            $table->string("employee_confirmation")->default("non confirmé")->nullable;

            $table->unsignedBigInteger("account_id")->nullable();
            $table->double("account_number")->nullable();

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
        Schema::dropIfExists('fiche_de_paies');
    }
}
