<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->longText('description');
            $table->longText('nomdecode');
            $table->string('pays');
            $table->longText('agents');
            $table->longText('cibles');
            $table->longText('contacts');
            $table->longText('planque');
            $table->string('type');
            $table->string('statut');
            $table->longText('specialite');
            $table->string('datedebut');
            $table->string('datefin');
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
        Schema::dropIfExists('missions');
    }
}
