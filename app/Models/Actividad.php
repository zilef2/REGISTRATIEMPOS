<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Actividad extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
    ];

    //centrotrabajo_id
    public function centroTrabajos(): BelongsToMany { return $this->BelongsToMany(centroTrabajo::class); }
    // public function ActividadTipo($centroid,$ADR) {
    //     return 
    //     DB::table('actividad_centrotrabajo')->insert([
    //         'Acti_dispo_repro' => $ADR,
    //         'actividad_id' => $this->id,
    //         'centrotrabajo_id' => $centroid,
    //     ]);
    // }
}
