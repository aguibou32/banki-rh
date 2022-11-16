<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->longText("description");
            $table->double("retrait")->nullable();
            $table->double("depot")->nullable();
            $table->double("balance")->nullable();
            $table->longText("fichier")->nullable();

            $table->unsignedBigInteger("account_id");
            $table->foreign('account_id')
                ->references('id')->on('accounts')
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
        Schema::dropIfExists('transactions');
    }
}