<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrenadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrenadors', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 9)->unique();
            $table->string('nombre', 20);
            $table->string('apellidos', 40);
            $table->string('puesto', 20);
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
        Schema::dropIfExists('entrenadors');
    }
}
