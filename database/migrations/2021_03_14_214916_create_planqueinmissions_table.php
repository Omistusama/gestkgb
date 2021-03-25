<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanqueinmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planqueinmissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('planques_id');
            $table->foreign('planques_id')
                ->references('id')
                ->on('planques')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('missions_id');
            $table->foreign('missions_id')
                ->references('id')
                ->on('missions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planqueinmissions');
    }
}
