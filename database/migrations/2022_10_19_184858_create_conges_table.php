<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conges', function (Blueprint $table) {

            $table->id();
            $table->string("motif");
            $table->text("details");
            $table->date("du_date");
            $table->date("au_date");
            $table->string("status")->default("en attente");
            $table->string("type")->default("non payé");
            $table->string("montant")->default("0");
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
        Schema::dropIfExists('conges');
    }
}
