<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevdepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revdepenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->decimal('montant', 20, 3);
            $table->string('description');
            $table->date('date');
            $table->string('payement');
            $table->string('type');
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
        Schema::dropIfExists('revdepenses');
    }
}
