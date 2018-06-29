<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nivel_id')->unsigned();
            $table->integer('anio_id')->unsigned();
            $table->integer('docente_id')->unsigned();
            $table->string('codigo', 10)->unique();
            $table->char('seccion', 1)->nullable();
            $table->boolean('estado');

            $table->foreign('nivel_id')->references('id')->on('niveles');
            $table->foreign('anio_id')->references('id')->on('anios');
            $table->foreign('docente_id')->references('id')->on('docentes');

            $table->index(['nivel_id', 'anio_id', 'seccion']);

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
        Schema::dropIfExists('grados');
    }
}
