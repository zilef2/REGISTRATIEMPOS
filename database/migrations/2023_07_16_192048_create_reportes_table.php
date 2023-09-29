<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
			$table->string('codigo')->default('NA');
            $table->date('fecha');
            $table->time('hora_inicial')->nullable();
            $table->time('hora_final')->nullable();

            
            $table->unsignedBigInteger('actividad_id')->nullable();
            $table->unsignedBigInteger('centrotrabajo_id')->nullable();
            $table->unsignedBigInteger('material_id')->nullable();
            // $table->unsignedBigInteger('ordentrabajo_id')->nullable();
            $table->string('ordentrabajo_id')->nullable();
            $table->unsignedBigInteger('operario_id')->nullable();

            $table->unsignedBigInteger('pieza_id')->nullable();
            $table->integer('cantidad')->nullable();
            
            $table->unsignedBigInteger('disponibilidad_id')->nullable();
            $table->unsignedBigInteger('reproceso_id')->nullable();

			$table->integer('tipoFinalizacion')->default(1);
			$table->integer('tipoReporte')->default(1);


			$table->string('nombreTablero')->nullable();
			$table->string('OTItem')->nullable();
			$table->string('TiempoEstimado')->nullable();

            //relationsships in create_reprocesos_table
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
