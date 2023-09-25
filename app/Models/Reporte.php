<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reporte extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        // 'codigo',
        'fecha',
        'hora_inicial',
        'hora_final',
        'actividad_id',
        'centrotrabajo_id',
        // 'material_id',
        'ordentrabajo_id',
        
        'pieza_id',
        'cantidad',
        
        'disponibilidad_id',
        'reproceso_id',

        'operario_id',
        
        // 'calendario_id',
        //19 sept2023
        'tipoFinalizacion', //BOUNDED 1: primera del dia | 2:intermedia | 3:Ultima del dia
    ];

    // public function reportes() { return $this->hasMany('App\Models\Reporte'); }

    public function actividad(): BelongsTo { return $this->BelongsTo(Actividad::class); }
    public function centrotrabajo(): BelongsTo { return $this->BelongsTo(Centrotrabajo::class,'centrotrabajo_id'); }
    // public function material(): BelongsTo { return $this->BelongsTo(Material::class, 'material_id'); }
    public function ordentrabajo(): BelongsTo { return $this->BelongsTo(Ordentrabajo::class); }
    public function operario(): BelongsTo { return $this->BelongsTo(User::class, 'operario_id'); }

    public function pieza(): BelongsTo { return $this->BelongsTo(Pieza::class); }
    
    public function disponibilidad(): BelongsTo { return $this->BelongsTo(Disponibilidad::class,'disponibilidad_id'); }
    public function reproceso(): BelongsTo { return $this->BelongsTo(Reproceso::class); }
    


}
