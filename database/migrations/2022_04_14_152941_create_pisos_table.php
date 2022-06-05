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
            $table->string('descripcion')->default("Descripción del piso");
            $table->tinyInteger('num_habitaciones')->default(1);
            $table->tinyInteger('num_aseos')->default(1);
            $table->integer('m2')->default(0);
            $table->enum('sexo', ['mujer','hombre','mixto'])->default("mixto");
            $table->enum('fumadores',[0, 1, 2])->default(2);
            $table->enum('animales',[0, 1, 2])->default(2);
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
