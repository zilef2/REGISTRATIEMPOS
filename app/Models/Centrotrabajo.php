<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Centrotrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
    ];

    public function Actividads(): BelongsToMany { return $this->BelongsToMany(Actividad::class); }
   
}
