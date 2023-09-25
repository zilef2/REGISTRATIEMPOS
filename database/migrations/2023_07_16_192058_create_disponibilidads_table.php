<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateDisponibilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidads', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo');
            $table->timestamps();

        });
        Schema::create('centrotrabajo_disponibilidad', function (Blueprint $table) {
            $table->id();
            // $table->integer('Acti_dispo_repro')->nullable();
            $table->unsignedBigInteger('disponibilidad_id');
            $table->foreign('disponibilidad_id')
                ->references('id')
                ->on('disponibilidads')
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
        Schema::dropIfExists('disponibilidads');
    }
}
