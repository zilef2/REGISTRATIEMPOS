<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateReprocesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reprocesos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo');
            $table->timestamps();
        });

        Schema::create('centrotrabajo_reproceso', function (Blueprint $table) {
            $table->id();
            // $table->integer('Acti_dispo_repro')->nullable();
            $table->unsignedBigInteger('reproceso_id');
            $table->foreign('reproceso_id')
                ->references('id')
                ->on('reprocesos')
                ->onDelete('restrict'); //restrict | set null
            $table->unsignedBigInteger('centrotrabajo_id');
            $table->foreign('centrotrabajo_id')
                ->references('id')
                ->on('centrotrabajos')
                ->onDelete('restrict'); //restrict | set null  
            $table->timestamps();
        });



        Schema::table('reportes', function (Blueprint $table) {
            $table->foreign('actividad_id')
                ->references('id')
                ->on('actividads')
                ->onDelete('restrict'); //cascade| restrict | set null
            $table->foreign('centrotrabajo_id')
                ->references('id')
                ->on('centrotrabajos')
                ->onDelete('restrict'); //cascade| restrict | set null
            $table->foreign('disponibilidad_id')
                ->references('id')
                ->on('disponibilidads')
                ->onDelete('restrict'); //cascade| restrict | set null


            // $table->foreign('material_id')
            //     ->references('id')
            //     ->on('materials')
            //     ->onDelete('restrict'); 


            $table->foreign('operario_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict'); //cascade| restrict | set null
            // $table->foreign('ordentrabajo_id')
            //     ->references('id')
            //     ->on('ordentrabajos')
            //     ->onDelete('restrict'); //cascade| restrict | set null


            // $table->foreign('pieza_id')
            //     ->references('id')
            //     ->on('piezas')
            //     ->onDelete('restrict'); 
            
            
            $table->foreign('reproceso_id')
                ->references('id')
                ->on('reprocesos')
                ->onDelete('restrict'); //cascade| restrict | set null
            //restrict or cascade
        });
    }

    public function down()
    {
        Schema::dropIfExists('reprocesos');
        Schema::dropIfExists('centrotrabajo_reproceso');
        Schema::dropIfExists('reportes');
    }
}
