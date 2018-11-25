<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnoValorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_valor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumno_id')->unsigned();
            $table->integer('valor_id')->unsigned();
            $table->integer('grado_id')->unsigned();
            $table->char('trimestre', 1);
            $table->string('nota', 2)->nullable();

            $table->foreign('alumno_id')->references('id')->on('alumnos');
            $table->foreign('valor_id')->references('id')->on('valores');
            $table->foreign('grado_id')->references('id')->on('grados');

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
        Schema::dropIfExists('alumno_valor');
    }
}
