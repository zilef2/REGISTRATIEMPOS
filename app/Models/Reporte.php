<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'cantidad',
        'fecha',
        'hora_inicial',
        'hora_final',
        'actividad_id',
        'centrotrabajo_id',
        'disponibilidad_id',
        'material_id',
        'operario_id',
        'ordentrabajo_id',
        'calendario_id',
        'pieza_id',
        'reproceso_id',
    ];

    public function reportes() { return $this->hasMany('App\Models\Reporte'); }

    public function actividad(): BelongsTo { return $this->BelongsTo(Actividad::class); }
    public function centrotrabajo(): BelongsTo { return $this->BelongsTo(Centrotrabajo::class,'centrotrabajo_id'); }
    public function disponibilidad(): BelongsTo { return $this->BelongsTo(Disponibilidad::class,'disponibilidad_id'); }
    public function material(): BelongsTo { return $this->BelongsTo(Material::class, 'material_id'); }
    public function operario(): BelongsTo { return $this->BelongsTo(User::class, 'user_id'); }
    public function ordentrabajo(): BelongsTo { return $this->BelongsTo(Ordentrabajo::class); }
    // public function calendario(): BelongsTo { return $this->BelongsTo(calendario::class); }
    public function pieza(): BelongsTo { return $this->BelongsTo(Pieza::class); }
    public function reproceso(): BelongsTo { return $this->BelongsTo(Reproceso::class); }
    

}
