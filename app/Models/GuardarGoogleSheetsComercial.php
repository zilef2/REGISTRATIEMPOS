<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardarGoogleSheetsComercial extends Model
{
    use HasFactory;

    protected $fillable = [
        'HayTiemposEstimados', //default = 0, significa que la tabla no ningun valor de tiempo
        'Grupo', //se suele poner la fecha
        'user_id', 

        'Nombre_tablero',
        'Item',
        'avance',
        'Tiempo_estimado_Ing_mec',
        'Tiempo_estimado_Ing_elec',
        'Tiempo_estimado_corte',
        'Tiempo_estimado_doblez',
        'Tiempo_estimado_soldadura',
        'Tiempo_estimado_pulida',
        'Tiempo_estimado_ensamble',
        'Tiempo_estimado_cableado',
        'Tiempo_estimado_cobre',
    ];
}
