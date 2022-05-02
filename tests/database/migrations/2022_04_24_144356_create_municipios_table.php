<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->increments('internalid');
            $table->char('cp', 5);
            $table->string('carrer', 100)->nullable();
            $table->string('poblacio', 100);
            $table->char('provinciasid', 2);
            $table->string('provincia', 100)->nullable();
            
            $table->foreign('provinciasid', 'fk_provinciasid_municipios_provincias')->references('provinciasid')->on('provincias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios');
    }
}
