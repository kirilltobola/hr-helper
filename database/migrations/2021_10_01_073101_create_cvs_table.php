<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('skills')->nullable(false);
            $table->text('cv')->nullable(false);
            $table->text('experience')->nullable(false);
            $table->smallInteger('position')->unsigned()->index()->nullable();
            $table->smallInteger('programming_level')->unsigned()->index()->nullable();
            $table->date('date')->nullable(false);
            $table->smallInteger('status')->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('position')
                ->references('id')
                ->on('positions')
                ->onDelete('set null');

            $table->foreign('programming_level')
                ->references('id')
                ->on('programming_levels')
                ->onDelete('set null');

            $table->foreign('status')
                ->references('id')
                ->on('statuses')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cvs');
    }
}
