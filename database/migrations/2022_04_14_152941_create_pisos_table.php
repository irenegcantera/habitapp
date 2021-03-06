<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pisos', function (Blueprint $table) {
            $table->id();
	        $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('titulo')->default('Piso en alquiler');
            $table->string('descripcion')->nullable();
            $table->tinyInteger('num_habitaciones')->nullable();
            $table->tinyInteger('num_aseos')->nullable();
            $table->integer('m2')->nullable();
            $table->enum('sexo', ['mujer','hombre','mixto'])->nullable();
            $table->boolean('fumadores')->nullable();
            $table->boolean('animales')->nullable();
            $table->double('precio')->default(0);
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
        Schema::dropIfExists('pisos');
    }
};
