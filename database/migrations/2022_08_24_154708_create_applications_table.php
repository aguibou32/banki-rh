<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prénom");
            $table->date("date_de_naissance");
            $table->string("email");
            $table->string("phone");
            $table->string("addresse");
            $table->text("motivation");
            $table->longText("cv");
            $table->longText("autre_documents")->nullable();
            $table->unsignedBigInteger("offre_emplois_id")  
            ->references('id')->on('offre_emplois')->onDelete('cascade');
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
        Schema::dropIfExists('applications');
    }
}
