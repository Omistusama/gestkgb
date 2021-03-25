<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiblesinmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciblesinmissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('cibles_id');
            $table->foreign('cibles_id')
                ->references('id')
                ->on('cibles')
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
        Schema::dropIfExists('ciblesinmissions');
    }
}
