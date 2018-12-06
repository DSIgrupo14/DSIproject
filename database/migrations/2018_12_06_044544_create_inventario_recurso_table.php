<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioRecursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_recurso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recurso_id')->unsigned();
            $table->integer('inventario_id')->unsigned();
            $table->integer('cantidad');

            $table->foreign('recurso_id')->references('id')->on('recursos');
            $table->foreign('inventario_id')->references('id')->on('inventarios');

            $table->index(['recurso_id', 'inventario_id', 'cantidad']);

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
        Schema::dropIfExists('inventario_recurso');
    }
}
