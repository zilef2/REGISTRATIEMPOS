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
    public function up()
    {
        Schema::create('reprocesos', function (Blueprint $table) {
            $table->id();
			$table->string('codigo');
            $table->timestamps();
        });



        Schema::table('reportes', function (Blueprint $table) {
            $table->foreign('actividad_id')
                            ->references('id')
                            ->on('actividads')
                            ->onDelete('cascade');
            $table->foreign('centrotrabajo_id')
                            ->references('id')
                            ->on('centrotrabajos')
                            ->onDelete('cascade');
            $table->foreign('disponibilidad_id')
                            ->references('id')
                            ->on('disponibilidads')
                            ->onDelete('cascade');
            $table->foreign('material_id')
                            ->references('id')
                            ->on('materials')
                            ->onDelete('cascade');
            $table->foreign('operario_id')
                            ->references('id')
                            ->on('users')
                            ->onDelete('cascade');
            $table->foreign('ordentrabajo_id')
                            ->references('id')
                            ->on('ordentrabajos')
                            ->onDelete('cascade');
            // $table->foreign('calendario_id')
            //                 ->references('id')
            //                 ->on('calendarios')
            //                 ->onDelete('cascade');
            $table->foreign('pieza_id')
                            ->references('id')
                            ->on('piezas')
                            ->onDelete('cascade');
            $table->foreign('reproceso_id')
                            ->references('id')
                            ->on('reprocesos')
                            ->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reprocesos');
    }
}
