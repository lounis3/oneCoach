<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadors', function (Blueprint $table) {
            $table->id();
            $table->string('cod_ficha', 255)->unique();
            $table->string('nombre', 20);
            $table->string('apellidos', 40);
            $table->integer('edad',);
            $table->integer('dorsal');
            $table->string('posicion', 20);
            $table->string('pie_dominante', 20);
            $table->integer('altura');
            $table->decimal('peso');
            $table->date('est_contrato');
            $table->integer('salario');
            $table->foreignId('equipo')->references('id')->on('equipos')->cascadeOnDelete();
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
        Schema::dropIfExists('jugadors');
    }
}
