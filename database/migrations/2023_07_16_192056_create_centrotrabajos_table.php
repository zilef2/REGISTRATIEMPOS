<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCentrotrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrotrabajos', function (Blueprint $table) {
            $table->id();
			$table->string('nombre');
			$table->string('codigo');
            $table->timestamps();
        });

        
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('centrotrabajo_id')->nullable();
            $table->foreign('centrotrabajo_id')
                ->references('id')
                ->on('centrotrabajos')
                ->onDelete('restrict'); //restrict | set null
        });
        
        Schema::create('actividad_centrotrabajo', function (Blueprint $table) {
            $table->id();
			$table->integer('Acti_dispo_repro')->nullable();
            $table->unsignedBigInteger('actividad_id');
            $table->foreign('actividad_id')
                ->references('id')
                ->on('actividads')
                ->onDelete('restrict'); //restrict | set null 
            $table->unsignedBigInteger('centrotrabajo_id');
            $table->foreign('centrotrabajo_id')
                ->references('id')
                ->on('centrotrabajos')
                ->onDelete('restrict'); //restrict | set null  
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
        Schema::dropIfExists('centrotrabajos');
        Schema::dropIfExists('actividad_centrotrabajo');
    }
}
